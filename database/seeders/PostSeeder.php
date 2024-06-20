<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Post::factory(20)
			->has(\App\Models\Commentary::factory(random_int(1, 10)))
			->has(\App\Models\Image::factory(random_int(1, 5)))
			->create();
    }
}
