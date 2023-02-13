<?php

namespace App\Http\Livewire;

use App\Http\Requests\StoreTagRequest;
use App\Tag;
use Livewire\Component;
use Livewire\WithPagination;

class Tags extends Component
{
    use WithPagination;
    public $tags;
    protected $listeners = ['store' => '$refresh'];

    public function addParent(StoreTagRequest $request){
        $data=$request->only('name');
        Tag::create($data);
        $this->emit('store');
    }
    public function addChild(StoreTagRequest $request){
        $tag = new Tag();
        $tag->name = $request->input('name');
        $tag->child = 1;
        $tag->save();

        $parent=Tag::findOrFail($request->input('parent'));
        $tag->parent()->sync($parent);
        $this->emit('store');
    }
    public function render()
    {
        $tags=Tag::withCount('posts')->where('child',0)->with('children')->paginate(4);
        return view('tags.index');
    }
}
