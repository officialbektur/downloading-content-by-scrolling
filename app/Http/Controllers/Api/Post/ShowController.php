<?php

namespace App\Http\Controllers\Api\Post;

use App\Http\Controllers\Controller;
use App\Http\Requests\Post\PostIndexRequest;
use App\Http\Resources\Post\PostIndexResource;
use App\Http\Resources\Post\PostFullResource;
use App\Models\Post;
use Illuminate\Http\JsonResponse;

class ShowController extends Controller
{
    public function __invoke(Post $post)
    {
        return PostFullResource::make($post)->resolve();
    }
}
