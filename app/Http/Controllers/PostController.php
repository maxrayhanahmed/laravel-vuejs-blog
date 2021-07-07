<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\Post;

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
        //return $request;

        $request->validate([
            'title'=> 'required|unique:posts|max:255',
            'category_id'=> 'required',
            'content'=> 'required',
            //'thumbnail'=> 'required',
            'status'=> 'required',
        ]);
         $post = new Post();
         $post->user_id =   auth()->user()->id;
         $post->category_id =   $request->category_id;
         $post->title       =   $request->title;
         $post->slug        =   slugify($request->title);
         $post->content     =   $request->content;
         $post->thumbnail   =   "thumbnail";
         $post->status      =   $request->status;
         //$post->save();
         $success = $post->save() ? true : false;
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
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
