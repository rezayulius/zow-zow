<?php

namespace App\Http\Middleware;

use Closure;
use DOMDocument;
use Illuminate\Http\Request;
use League\HTMLToMarkdown\HtmlConverter;
use Symfony\Component\HttpFoundation\Response;

/**
 * Adds a discovery Link header (RFC 8288) to every HTML page, and returns
 * a Markdown rendering of the page when a client explicitly asks for
 * `Accept: text/markdown` (browsers keep getting normal HTML).
 */
class AgentDiscovery
{
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        if (! in_array($request->method(), ['GET', 'HEAD'], true) || ! str_starts_with((string) $response->headers->get('Content-Type'), 'text/html')) {
            return $response;
        }

        $response->headers->set(
            'Link',
            '<'.$request->url().'>; rel="canonical", <'.$request->url().'>; rel="alternate"; type="text/markdown"'
        );

        if (! str_contains($request->header('Accept', ''), 'text/markdown')) {
            return $response;
        }

        $markdown = $this->toMarkdown((string) $response->getContent());

        return response($markdown, $response->getStatusCode())
            ->header('Content-Type', 'text/markdown; charset=utf-8');
    }

    private function toMarkdown(string $html): string
    {
        $dom = new DOMDocument();
        libxml_use_internal_errors(true);
        $dom->loadHTML('<?xml encoding="utf-8"?>'.$html);
        libxml_clear_errors();

        // ponytail: strips by tag only (no readability scoring); revisit if
        // pages start leaking sidebar/widget noise into the markdown output.
        foreach (['script', 'style', 'svg', 'header', 'footer', 'nav', 'noscript'] as $tag) {
            foreach (iterator_to_array($dom->getElementsByTagName($tag)) as $node) {
                $node->parentNode?->removeChild($node);
            }
        }

        $body = $dom->getElementsByTagName('body')->item(0);
        $bodyHtml = $body ? $dom->saveHTML($body) : $html;

        $converter = new HtmlConverter(['strip_tags' => true, 'remove_nodes' => 'button']);
        $markdown = $converter->convert($bodyHtml);

        // Tailwind markup is full of empty layout divs, which the converter
        // turns into whitespace-only lines. Trim trailing space per line so
        // those collapse into true blank lines, then squash the runs.
        $markdown = implode("\n", array_map('rtrim', explode("\n", $markdown)));

        return trim(preg_replace('/\n{3,}/', "\n\n", $markdown));
    }
}
