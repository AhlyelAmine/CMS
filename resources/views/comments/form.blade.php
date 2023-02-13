
@auth
  <h5> Add comment </h5>
  <form method="POST" action="{{ route('posts.comments.store', ['post' => $post->id]) }}">
      @csrf
      <div class="form-group row">
        <div class=" col-sm-6">
        <textarea class="form-control  my-3  @error('content') is-invalid @enderror" name="content" id="content" rows="1"></textarea>
      </div>

      <button type="submit" class="btn btn-primary  col-sm-2 my-3 rounded">comment</button>
      </div>
  </form>

@else

 <p> <a href="{{ route('login') }}" class="btn btn-link text-decoration-none">Sign In</a> to comment</p>
 

@endauth