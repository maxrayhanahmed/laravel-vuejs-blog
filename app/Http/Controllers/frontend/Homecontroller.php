<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\models\Category;
use App\models\Post;

class Homecontroller extends Controller
{
     /**
     * Show the application site.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('frontend.layouts');
    }

    public function frontActiveCategory ()
    {
        $categories = Category::where('status', 1)->get();
        return response()->json([
           'categories' => $categories
        ], 200);
    }

    public function categoryPost($slug){

        $category = Category::where('slug', $slug)->where('status', 1)->first();
        $cat_id = $category->id;
        $posts = Post::with('category','user')->where('status', 1)->where('category_id', $cat_id)->paginate(4);
        return response()->json([
           'posts' => $posts
        ], 200);

    }

    public function frontPosts()
    {
        $categories = Category::where('status', 1)->get();
        $cat_id = array();
        foreach ($categories as $category) {
            $cat_id[] = $category->id;
        }

         // $posts = Post::orderBy('id', 'DESC')->where('status', 1)->get();
         $posts = Post::with('category','user')->orderBy('id', 'DESC')->where('status', 1)->whereIn('category_id', $cat_id)->paginate(3);

          return response()->json([
           'posts' => $posts
        ], 200);
    }

    public function singlePost($slug)
    {

         $post = Post::with('category','user')->where('slug', $slug)->get();
        return response()->json([
           'post' => $post
        ], 200);
    }


    // public function frontPosts(){
    //     $posts = Post::with('category','user')->get();
    //     return response()->json([
    //        'posts' => $posts
    //     ], 200);
    // }




}
