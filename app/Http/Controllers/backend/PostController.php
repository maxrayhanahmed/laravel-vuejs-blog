<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\models\Post;
use Image;

use function PHPUnit\Framework\fileExists;

class PostController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $posts = Post::with('category','user')->get();
        return response()->json([
           'posts' => $posts
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         $request->validate([
            'title'=> 'required|unique:posts|max:255',
            'category_id'=> 'required',
            'content'=> 'required',
            'thumbnail'=> 'required',
            'status'=> 'required',
        ]);
         //$request->thumbnail;
        $str = explode(';', $request->thumbnail);

        $str2 = explode('/', $str[0]);
        $extn = end($str2);
        $slug = slugify($request->title);
        $path = 'admin/media/images/post/';
        $thumbnail = $slug.'.'.$extn;

         $post = new Post();
         $post->user_id =   auth()->user()->id;
         $post->category_id =   $request->category_id;
         $post->title       =   $request->title;
         $post->slug        =   $slug;
         $post->content     =   $request->content;
         $post->thumbnail   =   $thumbnail;
         $post->status      =   $request->status;
         $inserted = $post->save();
         if($inserted){
            Image::make($request->thumbnail)->resize(500, 350)->save(public_path($path.$thumbnail));
         }
        $success = $inserted ? true : false;
        return response()->json(['success'=>$success]);


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {

        $category = Post::where('slug', $slug)->first();
        return response()->json($category, 200,);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {


        $request->validate([
            'title'=> 'required|unique:posts,title,'.$request->id,
            'category_id'=> 'required',
            'content'=> 'required',
            'thumbnail'=> 'required',
            'status'=> 'required',
        ]);
        $post = Post::where('slug', $request->slug)->first();

        $slug = slugify($request->title);
        $path = 'admin/media/images/post/';
        if($post->thumbnail == $request->thumbnail && $post->title == $request->title){
            $post->thumbnail   =   $request->thumbnail;
         }elseif ($post->thumbnail == $request->thumbnail && $post->title !== $request->title) {


             $str = explode('.', $request->thumbnail);
             $extn = end($str);
             $thumbnail = $slug.'.'.$extn;

              $post->thumbnail   =   $thumbnail;
              Image::make(public_path($path.$request->thumbnail))->resize(500, 350)->save(public_path($path.$thumbnail));

              $old_thumb = $request->thumbnail;
                if(file_exists($old_thumb)){
                    unlink($path.$old_thumb);
                }

          }else{


           // if(isset($request->thumbnail)){

                $str = explode(';', $request->thumbnail);
                $str2 = explode('/', $str[0]);
                $extn = end($str2);
                $thumbnail = $slug.'.'.$extn;

                $post->thumbnail   =   $thumbnail;
                Image::make($request->thumbnail)->resize(500, 350)->save(public_path($path.$thumbnail));
                $old_thumb = $post->thumbnail;
                    if(file_exists($path.$old_thumb)){
                        unlink($path.$old_thumb);
                    }

          //   }

         }


         $post->user_id =   auth()->user()->id;
         $post->category_id =   $request->category_id;
         $post->title       =   $request->title;
         $post->slug        =   $slug;
         $post->content     =   $request->content;


         $post->status      =   $request->status;
         $updated = $post->save();

       $success = $updated ? true : false;
       return response()->json(['success'=>$success]);

    }


    /**
     * Remove the specified resource from storage.
     *
     * @param unique string  $slug
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        $post = Post::where('slug', $slug)->first();
        $post->delete();
        $path = 'admin/media/images/post/';
            $old_thumb = $post->thumbnail;
            if(file_exists($path.$old_thumb)){
                unlink($path.$old_thumb);
            }
    }

     /**
     * Remove resource from storage.
     *
     * @param  int  $ids
     * @return \Illuminate\Http\Response
     */

    public function removeSelectData(Request $request){
        $sl = 0;
        foreach($request->data as $id){
            $post = Post::find($id);
            $post->delete();
            $path = 'admin/media/images/post/';
            $old_thumb = $post->thumbnail;
            if(file_exists($path.$old_thumb)){
                unlink($path.$old_thumb);
            }
            $sl++;

        }
        $success = $sl > 0 ? true : false;
      return response()->json(['success'=>$success, 'total'=>$sl]);
    }

    public function changeStatus(Request $request){
        $sl = 0;
        foreach($request->data as $id){
            $post = Post::find($id);
            $post->status = $request->status;
            $post->save();
            $sl++;
        }
        $success = $sl > 0 ? true : false;
        return response()->json(['success'=>$success, 'total'=>$sl]);
    }


}
