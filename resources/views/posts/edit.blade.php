@extends('layouts')

@section('content')
<div class="container py-3 bg-white">
    <h1 class="d-flex justify-content-center">Update post</h1>
    <form method="POST" 
          action="{{ route('posts.update', ['post' => $post->id]) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        @include('posts._form')
    
<div class="form-group">
    <label>Category</label>
        @forelse($tags as $tag)
        <div class="form-check">
            <input name="tag[]" class="form-check-input" type="checkbox" value="{{$tag->id}}" id="flexCheckChecked"
            @forelse($post->tags as $tgs)
            @if($tgs->name===$tag->name)
            checked=""
            @endif
            @empty
            @endforelse
            >
            <label class="form-check-label" for="tag">
                {{$tag->name}}
            </label>
          </div>
        @empty
        @endforelse
    </select>
  </div>
        <button type="submit" class="btn btn-primary btn-block">Update</button>
    </form>
</div>
@endsection