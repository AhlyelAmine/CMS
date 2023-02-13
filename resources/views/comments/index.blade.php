<h1 style="font-family: fontSerif" class="text-primary">Comments</h1>
<div class="container py-5 border" style="border-radius: 10px">
  @forelse( $post->comments as $comment)





  
<div class="row">
  <div class="col-1 px-5">
    @if($comment->user->image)
    <img src="{{ $comment->user->image->url() }}" width="50" class="user-img rounded-circle mr-2 border shadow m-3">
    @else
    <img src="https://ubisoft-avatars.akamaized.net/7eac7e60-97e3-4968-88da-4b8358f902e8/default_256_256.png" width="50" class="user-img rounded-circle mr-2 border shadow m-3">
    @endif
  </div>
  <div class="col-auto  px-4" style="max-width: 70%">
  <ul class="list-group">
    <li  style="border-radius: 10px;" class="list-group-item shadow p-3 mb-2 bg-light ">

      <div class="d-flex justify-content-between align-items-center">
        <div class="user d-flex flex-row align-items-center">
            <span>
              <small class="font-weight-bold text-primary">
                <a class="text-decoration-none" href="{{route('users.show',['user'=>$comment->user])}}">
                  {{$comment->user->name }}
                </a>
              </small> 
            </span>
          </div> 
      </div>
      <small class="text-muted" > {{ $comment->content }}</small>     
    </li>
  </ul>
  @auth
  @can('delete', $comment)
      <form method="POST" width="auto" class="d-inline"
          action="{{ route('posts.comments.destroy', ['post'=>$post->id,'comment' => $comment->id]) }}">
          @csrf
          @method('DELETE')
          <input type="submit" value="delete" class="btn btn-sm btn-link text-decoration-none"/>
      </form>
      @endcan
  @endauth

  @if($comment->created_at->diffInHours() < 24)
  <small class="text-muted d-inline px-3">{{$comment->created_at->diffForHumans()}}</small>
  @else
  <small class="text-muted d-inline px-3">le {{$comment->created_at->toFormattedDateString()}}</small>
  @endif

  </div>

</div>

@empty
<p class="text-primary">No comments yet!</p>
@endforelse

</div>