<?php


namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;

use App\Http\Requests\ProfileUpdateRequest;
use App\Http\Resources\Post\PostFullResource;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;

class ShowController extends Controller
{
    public function __invoke($post)
    {
        return Inertia::render('Post/Show', [
            'id' => $post
        ]);
    }
}
