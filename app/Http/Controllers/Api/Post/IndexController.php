<?php

namespace App\Http\Controllers\Api\Post;

use App\Http\Controllers\Controller;
use App\Http\Requests\Post\PostIndexRequest;
use App\Http\Resources\Post\PostIndexResource;
use App\Models\Post;
use Illuminate\Http\JsonResponse;

class IndexController extends Controller
{
    public function __invoke(PostIndexRequest $request): JsonResponse
    {
        $data = collect($request->validated());
        $page = $data->get('page', 1);

        $posts = Post::latest()->paginate(10, ['*'], 'page', $page);

        return jsonResponsePagination($posts, PostIndexResource::class, $posts);

    }
}
