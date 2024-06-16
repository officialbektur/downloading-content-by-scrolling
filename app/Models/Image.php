<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    protected $fillable = [
        'src_max',
        'src_average',
    ];

    public function post(): ?\Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->belongsTo(Post::class)->withTimestamps();
    }

    public function getCreatedAtAttribute($value): string
    {
        return Carbon::parse($value)->format('Y-m-d h:i:s');
    }

    public function getUpdatedAtAttribute($value): string
    {
        return Carbon::parse($value)->format('Y-m-d h:i:s');
    }
}
