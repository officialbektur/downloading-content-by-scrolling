<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('commentaries', function (Blueprint $table) {
            $table->id();

            $table->foreignIdFor(\App\Models\Post::class);
            $table->string('name', 60);
            $table->tinyInteger('rating')->default(0);
            $table->string('message', 255);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('commentaries');
    }
};
