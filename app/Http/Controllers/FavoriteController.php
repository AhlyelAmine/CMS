<?php

namespace App\Http\Controllers;

use App\Favorite;
use App\Post;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   

     
        return view('favorite.index');
    }  
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,Post $post)
    {   
        if(Favorite::where('post_id', $request->post)->where('user_id',$request->user()->id)->exists()){
            return redirect()->back(); 
        }else{
        $post->favorite()->create([
            'post_id' => $request->post,
            'user_id' => $request->user()->id 
        ]);
        return redirect()->back();
        }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
