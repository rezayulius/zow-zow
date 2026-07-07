<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\News;
use Illuminate\Http\JsonResponse;

class ContentViewController extends Controller
{
    private const MODELS = [
        'article' => Article::class,
        'news' => News::class,
    ];

    public function increment(string $type, int $id): JsonResponse
    {
        if (!isset(self::MODELS[$type])) {
            abort(404);
        }

        $model = self::MODELS[$type]::published()->findOrFail($id);

        $sessionKey = "viewed_{$type}_{$id}";
        if (!session()->has($sessionKey)) {
            $model->incrementViews();
            session()->put($sessionKey, true);
        }

        return response()->json(['views' => $model->fresh()->views]);
    }
}
