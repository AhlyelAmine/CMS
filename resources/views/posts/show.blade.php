@extends('layouts')

@section('content')
<div class="">
<div class="row">
@include('sidebar')
<div class="col-md-6 py-4">
<div style="border-radius: 10px;" class="text-dark list-group-item shadow mb-2 bg-white ">
  <div class="">
     
        <h1 class="d-inline">{{ $post->title }}</h1>
        @if($post->created_at->diffInHours() < 24)
        
          <x-badge type="success">New</x-badge>
         @else
          <x-badge type="dark">Old</x-badge>
         @endif
          <br>
        @foreach($post->tags as $tag)
        <x-badge type="warning"><a class="text-decoration-none text-light" href="/post/{{$tag->id}}">{{$tag->name}}</a></x-badge>
        @endforeach
        @if($post->created_at->diffInHours() < 24)
        <p>Créé {{ $post->created_at->diffForHumans() }}</p>  
        @else
        <p>Créé le {{ $post->created_at->toFormattedDateString()}}</p>
        @endif
        @if($post->image)
        <img src="{{ $post->image->url() }}" class="mt-3 img-fluid rounded" alt="">
       @endif
        <p>{{ $post->content }}</p>
        @if($post->youtube)
        <iframe   id="Iframe"  width="100%" height="500px"
        src="https://www.youtube.com/embed/{{$post->youtube}}" allowfullscreen>
        </iframe>

        @endif
        <p>Added {{ $post->created_at->diffForHumans() }}</p>
        @auth
            @can('update', $post)
              <a href="{{ route('posts.edit', ['post' => $post->id]) }}"
                  class="btn btn-primary btn-sm rounded">
                  Edit
              </a>
            @endcan
            @can('delete', $post)
              <form method="POST" style="display:inline"
                 action="{{ route('posts.destroy', ['post' => $post->id]) }}">
                 @csrf
                 @method('DELETE')

                  <input type="submit" value="Delete!" class="btn btn-sm btn-danger rounded"/>
                </form>
            @endcan
        @endauth
        @if ((new Carbon\Carbon())->diffInMinutes($post->created_at) < 5 )
        @endif

        @include('comments.index')
      </ul>


        @include('comments.form')
     
     
  </div>
</div>
</div>
<div class="col-md-3 d-none d-md-block py-4">
  <div class="stuck">
    <h4 class="px-4">Most Commented Posts</h4>
    <div class="card-body card-body-primary"> 
        @forelse($mostComments as $post)
        <nav class="nav nav-tabs">
            <a class="nav-link @if(Request::path()=="posts/$post->id") active bg-light @endif" href="{{route('posts.show',['post'=> $post])}}"> 
                <li> 
                    <h6 class="card-title">{{$post->title}}</h6>
                    <small class="text-muted d-inline px-3">{{$post->comments_count}} commentaires</small>
                    <small class="text-muted d-inline px-3">{{$post->created_at->diffForHumans()}}</small>
                </li>
            </a>
        </nav>
        @empty
        @endforelse
    </div>
  </div>
  
</div>
</div>
</div>
@endsection('content')
<script>    
    var data = {!! json_encode($tagsCount, JSON_HEX_TAG) !!};
</script>