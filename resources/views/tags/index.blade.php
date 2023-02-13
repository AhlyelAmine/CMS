@extends('layouts')
@section('content')
<div class="">
  <div class="row">
   @include('sidebar')
    <div class="col-md-6 py-4">
      <div class="">

        @forelse ($tagss as $tag)

          <div class="">
            <li  style="border-radius: 10px" class="list-group-item shadow p-3 mb-2 bg-white ">
              <h4 class="d-inline text-dark">{{$tag->name}}</h4>   
              @can('delete', $tag)
                <form method="POST" class="d-inline"
                    action="{{ route('tags.destroy', ['tag' => $tag->id]) }}">
                    @csrf
                    @method('DELETE')
                    <input type="submit" value="Delete" class="btn btn-sm btn-link text-decoration-none"/>
                </form>
              @endcan   
              <br>
          {{--<small class="text-muted">En relation avec {{$tag->posts_count}} posts</small>--}}         <ul>
                @forelse ($tag->children as $taggable)
                  <li>
                    <div class="">
                      <h5 class="d-inline text-dark">{{$taggable->name}}</h5>    
                  {{--<small class="text-muted">En relation avec {{$tagg->posts_count}} posts</small>--}}                      
                  @can('delete', $taggable)
                        <form method="POST" class="d-inline"
                            action="{{ route('tags.destroy', ['tag' => $taggable->id]) }}">
                            @csrf
                            @method('DELETE')
                            <input type="submit" value="Delete" class="btn btn-sm btn-link text-decoration-none"/>
                        </form>
                      @endcan
                    </div>
                  </li>
                @empty
                @endforelse
              </ul>   
            </li>
          </div>
        @empty
         <div class="d-flex justify-content-center py-5"><x-badge type="warning">No Tags post yet</x-badge></div>
        @endforelse
        <div class="d-flex justify-content-center">
          {{$tagss->links()}}
        </div>
      </div>
    </div>
    <div class="col-md-3">
      @include('tags.create')
    </div>
  </div>
</div>

  
@endsection