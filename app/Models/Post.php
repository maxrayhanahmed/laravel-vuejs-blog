<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
//use App\Models\User;

class Post extends Model
{
    use HasFactory;
    public $fillable = ['user_id', 'category_id', 'title', 'content', 'slug', 'thumbnail', 'status'];


    public function category(){
        return $this->belongsTo(Category::class);
    }


    public function user(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

}
