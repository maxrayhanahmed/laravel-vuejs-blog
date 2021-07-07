<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'slug', 'status'];


   // protected $fillable = ['user_id', 'category_id', 'title', 'content', 'thumbnail', 'status'];

    public function posts(){
        $this->hasMany(Post::class);
    }
}
