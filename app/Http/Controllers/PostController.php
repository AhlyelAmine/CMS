<?php

namespace App\Http\Controllers;

use App\Favorite;
use App\Http\Requests\StorePostRequest;
use App\Image;
use App\Post;
use App\Tag;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PostController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   

        $tagsCount=Tag::where('child',0)->count();
     
        return view(
            'posts.index', compact('tagsCount'), [
                'posts' => Post::orderBy('created_at', 'DESC')->with('tags','image')->paginate(8),
                'mostComments' => Post::mostCommented()->take(5)->get(),
                'mostCommentsLastMounth' => Post::mostCommentedThisMounth()->take(5)->get(),
                'tags'=>Tag::where('child',0)->get(),

                         ]);
    }   /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
   public function tag($id)
   {   
       return view(
           'posts.index', [
            'posts' => Post::orderBy('created_at', 'DESC')->with('tags','image')->whereHas('tags', function (Builder $query)use($id) {
                $query->where('tag_id',$id);
            })->paginate(8),
            'mostComments' => Post::mostCommented()->take(5)->get(),
            'mostCommentsLastMounth' => Post::mostCommentedThisMounth()->take(5)->get(),
            'tags'=>Tag::where('child',0)->get(),
        ]);
   }
   



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('manage posts');

        return view('posts.create', [
            'tags'=>Tag::where('child',0)->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePostRequest $request)
    {   
        $this->authorize('manage posts');
        $data=$request->only(['title','content','youtube']);
        $data['slug']=Str::slug($data['title'],'-');
        
        $data['user_id'] = $request->user()->id;
        $post = Post::create($data);
        $post->tags()->sync($request->input('tag'));
        if($request->hasFile('picture')) {
           
            $path = $request->file('picture')->store('posts');
            
            $post->image()->save(Image::make(['path' => $path]));
        }

        $request->session()->flash('status', 'Lesson was created!');
        
        return redirect()->route('posts.show', ['post' => $post->id]);
    
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tagsCount=Tag::where('child',0)->count();

        return view('posts.show', compact('tagsCount'),  [
            'post' => Post::with(['tags','image','comments','comments.user','comments.user.image'])->findOrFail($id),
                'mostComments' => Post::mostCommented()->take(10)->get(),
                'mostCommentsLastMounth' => Post::mostCommented()->whereBetween('created_at', 
                [Carbon::now()->subMonth()->startOfMonth(), Carbon::now()->subMonth()->endOfMonth()]
            )->take(5)->get(),
                'tags'=>Tag::where('child',0)->get(),

        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::findOrFail($id);

        // if(Gate::denies('post.update', $post)) {
        //     abort(403, "You can't edit this post !");
        // }

        $this->authorize("update", $post);
        return view('posts.edit', ['post' => $post,'tags' => Tag::all()]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(StorePostRequest $request,$id)
    {
        $post = Post::findOrFail($id);

        // if(Gate::denies('post.update', $post)) {
        //     abort(403, "You can't edit this post !");
        // }

        $this->authorize("update", $post);

          // Upload Picture for current Post
        //  if($request->hasFile('picture')) {

            //  $path = $request->file('picture')->store('posts');

            //      if($post->image) {
            //        Storage::delete($post->image->path);
         //           $post->image->path = $path;
          //          $post->image->save();
//}
             //     else {
           //           $post->image()->save(Image::make(['path' => $path]));
//}
        //}
         // Upload Picture for current Post
         if($request->hasFile('picture')) {

            $path = $request->file('picture')->store('posts');

                if($post->image) {
                  Storage::delete($post->image->path);
                  $post->image->path = $path;
                  $post->image->save();
                }
                else {
                    $post->image()->save(Image::make(['path' => $path]));
                }
      }

        $validatedData = $request->validated();

        $post->fill($validatedData);
            $post->tags()->sync($request->input('tag'));
        $post->save();


        $request->session()->flash('status', 'Lesson was updated!');

        return redirect()->route('posts.show', ['post' => $post->id]);    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        $post = Post::findOrFail($id);
//$post->delete();
        Post::destroy($id);
        $request->session()->flash('status', 'Lesson was deleted!');
        return redirect()->route('posts.index');
    }
}
