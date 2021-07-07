<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::get();
        //return response()->json([$categories], 200);
        return response()->json([
           'categories' => $categories
        ], 200);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */


    public function store(Request $request)
    {
       $request->validate([
           'name'=> 'required|unique:categories|max:100',
           'status'=> 'required',
       ]);
       $category = new Category();

       $category->name = $request->name;
       $category->slug = slugify($request->name);
       $category->status = $request->status;
       $category->save();



    //    Category::create([
    //        'name' => $request->name,
    //        'slug' => $request->name,
    //        'status' => $request->status
    //    ]);
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
        $category = Category::where('slug', $slug)->first();
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
            //'short_name'=>'required  | unique:payments,short_name,'.$request->paymentId,
            'name'=> 'required|unique:categories,name,'.$request->id,
            'status'=> 'required',
        ]);
        $category = Category::where('slug', $request->slug)->first();

        $category->name = $request->name;
        $category->slug = slugify($request->name);
        $category->status = $request->status;
        $category->save();

        return response()->json([
            1 => "success",
            0 => "error",
        ],200);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::find($id);

        if($category->delete()){
            $success = true;
        }else {
            $success = false;
        }
        return response()->json(['success'=>$success]);


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
            $category = Category::find($id);
            $category->delete();
            $sl++;
        }
        $success = $sl > 0 ? true : false;
      return response()->json(['success'=>$success, 'total'=>$sl]);
    }

    public function changeStatus(Request $request){
        $sl = 0;
        foreach($request->data as $id){
            $category = Category::find($id);
            $category->status = $request->status;
            $category->save();
            $sl++;
        }
        $success = $sl > 0 ? true : false;
        return response()->json(['success'=>$success, 'total'=>$sl]);
    }

    public function activeCategorics(){
        $categories = Category::where('status', 1)->get();
        return response()->json([
           'categories' => $categories
        ], 200);
    }



}
