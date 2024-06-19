<?php

namespace Database\Seeders;

use App\Models\Commentary;
use App\Models\Post;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CommentarySeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $posts = Post::all();
        foreach ($posts as $post) {
            Commentary::factory(random_int(1, 5000))->create([
                'post_id' => $post->id
            ]);
        }
    }
}
