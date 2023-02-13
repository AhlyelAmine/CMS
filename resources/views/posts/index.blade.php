@extends('layouts')

@section('content')
<div class="">
  <div class="row">
  @include('sidebar')
 <div class="col-md-6 py-4">
  
  <ul class="list-group ">

 @forelse ($posts as $post)

    <li style="border-radius: 10px;" class="list-group-item shadow p-3 mb-5 bg-white ">
     
         <h3 class="d-inline">
             <a class="text-decoration-none" href="{{ route('posts.show', ['post' => $post->id]) }}">
                 {{ $post->title }}
             </a>
         </h3>
         @if($post->created_at->diffInHours() < 24)
          <x-badge type="success">New</x-badge>
         
         @else
          <x-badge type="dark">Old</x-badge>
         @endif
         <br>
        @foreach($post->tags as $tag)
        <x-badge type="warning"><a class="text-decoration-none text-light" href="/post/{{$tag->id}}">{{$tag->name}}</a></x-badge>
        @endforeach
        <br>
         @if($post->image)
                <img src="{{ $post->image->url() }}" class="mt-3 img-fluid rounded" alt="">
          @endif
          @if($post->created_at->diffInHours() < 24)
          <p><em class="text-dark">Ajouter {{$post->created_at->diffForHumans()}}</em></p>
          @else
          <p><em class="text-dark">Créé le {{$post->created_at->toFormattedDateString()}}</em></p>
          @endif
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
      {{--   @can('store-favorite',$post) --}}
      @if(App\Favorite::where('post_id',  $post->id)->where('user_id',auth()->user()->id)->exists())
      <h4 class="text-dark">remove from favorite</h4>
    {{--   <form method="POST" width="auto" class="d-inline"
          action="{{ route('favorite.destroy', ['favorite' => $favorite->id]) }}">
          @csrf
          @method('DELETE')
          <input type="submit" value="delete" class="btn btn-sm btn-link text-decoration-none"/>
      </form> --}}
      @else
      <form method="POST"  style="display:inline"
      action="{{ route('favorite.store', ['post' => $post->id]) }}">
         @csrf
         <input type="submit" value="add to favorite"class="btn btn-sm btn-primary rounded"/>
     </form>
      @endif
        
{{--         @endcan --}}
     @endauth
    
  </li>
</ul>
 @empty
 <div class="d-flex justify-content-center py-5"><x-badge type="warning">No Lessons posts yet</x-badge></div>
 @endforelse
 {{ $posts->links() }}
  </div>
    <div class="col-md-3 d-none d-md-block py-5">
        <div class="stuck">
            <h4 class="px-4">Most Commented Posts Last Mounth</h4>
            <div class="card-body card-body-primary"> 
                @forelse($mostCommentsLastMounth as $post)
                @if(!$post->comments_count=='0')
                <nav class="nav nav-tabs">
                    <a class="nav-link" href="{{route('posts.show',['post'=> $post])}}"> 
                        <li> 
                            <h6 class="card-title">{{$post->title}}</h6>
                            <small class="text-muted d-inline px-3">{{$post->comments_count}} commentaires</small>
                            <small class="text-muted d-inline px-3">{{$post->created_at->diffForHumans()}}</small>
                        </li>
                    </a>
                </nav>
                @endif
                @empty
                @endforelse
            </div>
            <h4 class="px-4 py-4">Most Commented Posts</h4>
            <div class="card-body card-body-primary"> 
                @forelse($mostComments as $post)
                @if(!$post->comments_count=='0')
                <nav class="nav nav-tabs">
                    <a class="nav-link" href="{{route('posts.show',['post'=> $post])}}"> 
                        <li> 
                            <h6 class="card-title">{{$post->title}}</h6>
                            <small class="text-muted d-inline px-3">{{$post->comments_count}} commentaires</small>
                            <small class="text-muted d-inline px-3">{{$post->created_at->diffForHumans()}}</small>
                        </li>
                    </a>
                </nav>
                @endif
                @empty
                @endforelse
            </div>
        </div>
    </div>
</div>
</div>

@endsection
<script>    
    var data = {!! json_encode($tagsCount, JSON_HEX_TAG) !!};
</script>