<?php

namespace App\Http\Livewire\Favorite;

use App\Favorite;
use App\Post;
use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        return view('livewire.favorite.index',[
            'favorite' => Post::orderBy('created_at', 'DESC')->with('tags','image')->paginate(8),
        ]);
    }
}
