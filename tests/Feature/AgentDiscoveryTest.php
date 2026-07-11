<?php

namespace Tests\Feature;

use Tests\TestCase;

class AgentDiscoveryTest extends TestCase
{
    public function test_html_responses_include_discovery_link_headers(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $link = $response->headers->get('Link');
        $this->assertStringContainsString('rel="canonical"', $link);
        $this->assertStringContainsString('rel="alternate"; type="text/markdown"', $link);
    }

    public function test_markdown_is_returned_when_explicitly_requested(): void
    {
        $response = $this->get('/', ['Accept' => 'text/markdown']);

        $response->assertStatus(200);
        $this->assertStringStartsWith('text/markdown', $response->headers->get('Content-Type'));
        $this->assertStringNotContainsString('<nav', $response->getContent());
        $this->assertStringNotContainsString('<script', $response->getContent());
    }

    public function test_browsers_still_get_plain_html(): void
    {
        $response = $this->get('/', ['Accept' => 'text/html']);

        $response->assertStatus(200);
        $this->assertStringStartsWith('text/html', $response->headers->get('Content-Type'));
    }
}
