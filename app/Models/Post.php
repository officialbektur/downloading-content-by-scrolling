<?php

namespace App\Models;

use App\NumberFormattingTrait;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class Post extends Model
{
    use HasFactory, NumberFormattingTrait;

    protected $fillable = [
        'title',
        'content',
    ];


    public function image(): ?Image
    {
        return $this->images()->first();
    }

    public function images(): \Illuminate\Database\Eloquent\Relations\belongsToMany
    {
        return $this->belongsToMany(Image::class, ImagePost::class)->withTimestamps();
    }
    public function imagesCount()
    {
        return $this->images()->count();
    }

    public function commentaries(): \Illuminate\Database\Eloquent\Relations\hasMany
    {
        return $this->hasMany(Commentary::class)->latest();
    }
    public function commentariesCount()
    {
        return $this->commentaries()->count();
    }
    public function rating()
    {
        return $this->commentaries()->avg('rating') ?? 0;
    }
    public function getCreatedAtAttribute($value): string
    {
        return Carbon::parse($value)->format('Y-m-d h:i:s');
    }

    public function getUpdatedAtAttribute($value): string
    {
        return Carbon::parse($value)->format('Y-m-d h:i:s');
    }
    public function getRatingAttribute()
    {
        return floor($this->rating() * 10) / 10;
    }
    public function getCommentariesCountAttribute()
    {
        return $this->formatNumber($this->commentariesCount());
    }
    public function getImagesCountAttribute()
    {
        return $this->imagesCount();
    }
}
