@extends('layouts')

@section('content')
<div class="container py-3 bg-white">
  <h1 class="d-flex justify-content-center">Create post</h1>
<form method="POST" action="{{ route('posts.store') }}" enctype="multipart/form-data">
    @csrf
    
    @include('posts._form')
    <div class="form-group">
        <label>Category</label>
            @forelse($tags as $tag)
            <div class="form-check">
                <input name="tag[]" class="form-check-input" type="checkbox" value="{{$tag->id}}" id="flexCheckChecked">
                <label class="form-check-label" for="tag">
                    {{$tag->name}}
                </label>
              </div>
            @empty
            @endforelse
        </select>
      </div>
    <div class="py-3">
     <button type="submit" class="btn btn-primary btn-block">Create</button>
    </div>
</form>
</div>
@endsection
