<?php

namespace App\Http\Resources\Image;

use App\Http\Resources\Post\PostFullResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

/**
 * @mixin \App\Models\Image
 */
class ImageBasicResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'src_max' => $this->src_max,
            'src_average' => $this->src_average,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
