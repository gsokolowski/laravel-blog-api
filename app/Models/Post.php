<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Post extends Model
{
    /** @use HasFactory<\Database\Factories\PostFactory> */
    use HasFactory;

    protected $guarded = []; // protect from mass assignment

    // booted() is a special static method that Laravel automatically calls after the model is booted. It’s part of the model’s lifecycle.
    public static function booted(): void {
        static::saving(function($post) {
            $post->slug = Str::slug($post->title);
        });
    }
}
