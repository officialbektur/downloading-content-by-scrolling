<?php

namespace App\Http\Controllers\Api\Post;

use App\Http\Controllers\Controller;
use App\Http\Resources\Post\PostFullResource;
use App\Models\Post;

class ShowController extends Controller
{
    public function __invoke(Post $post)
    {
        return PostFullResource::make($post)->resolve();
    }
}
