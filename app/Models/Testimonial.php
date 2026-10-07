<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    protected $fillable = ['name', 'body', 'is_published'];

    protected $casts = [
        'is_published' => 'boolean',
    ];
}
