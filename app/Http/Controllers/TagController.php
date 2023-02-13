<?php

namespace App\Http\Controllers;

use App\Tag;
use Illuminate\Http\Request;
use App\Http\Requests\StoreTagRequest;

class TagController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('manage posts');

        return view('tags.index',[
            'tags'=>Tag::withCount('posts')->where('child',0)->get(),
            'tagss'=>Tag::where('child',0)->with('children')->paginate(4),

        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTagRequest $request)
    {
        
        $this->authorize('manage posts');
    
        if($request->input('parent')){
           
        $tag = new Tag();
        $tag->name = $request->input('name');
        $tag->child = 1;
        $tag->save();

        $parent=Tag::findOrFail($request->input('parent'));
        $tag->parent()->sync($parent);
        
 
        }

        if(!$request->input('parent')){
            $data=$request->only('name');
            Tag::create($data);
        }
       

        $request->session()->flash('status', 'Tags was created!');
        
        return redirect()->back();
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Tag::findOrFail($id);
        Tag::destroy($id);
        return redirect()->route('tags.index');
    }
}
