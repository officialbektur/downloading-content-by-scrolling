<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commentary extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'post_id',
        'rating',
        'message'
    ];

    public function getCreatedAtAttribute($value): string
    {
        return Carbon::parse($value)->format('Y-m-d h:i:s');
    }

    public function getUpdatedAtAttribute($value): string
    {
        return Carbon::parse($value)->format('Y-m-d h:i:s');
    }
}
