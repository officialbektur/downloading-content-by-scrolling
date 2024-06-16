<?php

namespace App\Http\Resources\Post;

use App\Http\Resources\Image\ImageBasicResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin \App\Models\Post
 */
class PostIndexResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        $image = $this->image();

        return [
            'id' => $this->id,
            'title' => $this->title,
            'image' => $image ? ImageBasicResource::make($image)->resolve() : null,
            'images_count' => $this->images_count,
            'commentaries_count' => $this->commentaries_count,
            'rating' => $this->rating,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
