<?php

namespace App\Http\Requests\Post;

use Illuminate\Foundation\Http\FormRequest;

class PostIndexRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'page' => 'integer|min:0',
        ];
    }
}
