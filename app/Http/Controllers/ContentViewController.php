<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\ClinicService;
use App\Models\News;
use Illuminate\Http\JsonResponse;

class ContentViewController extends Controller
{
    private const MODELS = [
        'article' => Article::class,
        'news' => News::class,
        'clinic-service' => ClinicService::class,
    ];

    private const PUBLISHED_SCOPES = [
        'article' => 'published',
        'news' => 'published',
        'clinic-service' => 'active',
    ];

    public function increment(string $type, int $id): JsonResponse
    {
        if (!isset(self::MODELS[$type])) {
            abort(404);
        }

        $scope = self::PUBLISHED_SCOPES[$type];
        $model = self::MODELS[$type]::{$scope}()->findOrFail($id);

        $sessionKey = "viewed_{$type}_{$id}";
        if (!session()->has($sessionKey)) {
            $model->incrementViews();
            session()->put($sessionKey, true);
        }

        return response()->json(['views' => $model->fresh()->views]);
    }
}
