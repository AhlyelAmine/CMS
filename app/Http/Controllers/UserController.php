<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserRequest;
use App\Image;
use App\User;
use GuzzleHttp\Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
       // $this->authorizeResource(User::class, 'user');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('users.index',[
            'users'=> User::with(['image'])->withCount('comments')->get(),
            'mostComments' => User::mostCommented()->take(10)->get(),
        
        ]);
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('users.show', ['user' => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('users.edit', ['user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request,  User $user)
    {   


    // Upload Picture for current Post
        if($request->hasFile('avatar')) {

            $path = $request->file('avatar')->store('users');

                if($user->image) {
                Storage::delete($user->image->path);
                $user->image->path = $path;
                $user->image->save();
                }
                else {
                    $user->image()->save(Image::make(['path' => $path]));
                }

        }

       $validatedData = $request->validated();
       $user->fill($validatedData);
       $user->save();

       $request->session()->flash('status', 'User Updated !');
       return redirect()->route('users.show', ['user' => $user->id]);
    }
}
