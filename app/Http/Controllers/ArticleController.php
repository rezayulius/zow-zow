<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\View\View;

class ArticleController extends Controller
{
    public function index(): View
    {
        $articles = Article::published()->ordered()->orderByDesc('published_at')->paginate(9);

        return view('articles.index', compact('articles'));
    }

    public function show(Article $article): View
    {
        abort_unless($article->status === 'published', 404);

        $sessionKey = "viewed_article_{$article->id}";
        if (! session()->has($sessionKey)) {
            $article->incrementViews();
            session()->put($sessionKey, true);
        }

        $relatedArticles = Article::published()
            ->where('id', '!=', $article->id)
            ->ordered()
            ->orderByDesc('published_at')
            ->limit(3)
            ->get();

        return view('articles.show', compact('article', 'relatedArticles'));
    }
}
