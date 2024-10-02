<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    // Specify fillable fields to protect against mass assignment vulnerabilities
    protected $fillable = ['title', 'body', 'user_id'];
}
