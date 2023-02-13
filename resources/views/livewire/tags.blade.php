@extends('layouts')
@section('content')
<div class="">
    <div class="row">
        <div class="col-3 py-5">
       
          </div>    
          <div class="col-6 py-4">
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
 
  <div class="col-3">
    <div class="container justify-content-center py-5">
      <div>
          <h3>Add new categorie</h3>
          <form method="POST" action="{{ route('tags.store') }}">
              @csrf
              <div class="form-group">
                  <label>Tag name</label>
                  <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"/>
              </div>
      
              <x-errors></x-errors>
              <div class="py-3">
                  <button type="submit" class="btn btn-primary btn-block">Ajouter</button>
              </div>
          
          </form>
      </div>
      <div>
          <h3>Add child to categorie</h3>
          <form method="POST" action="{{ route('tags.store') }}">
              @csrf
  
              <select name="parent" class="form-select" aria-label="Default select example">
                  <option selected>Parent Tags</option>
                  @foreach ($tags as $tag)
                  <option value="{{$tag->id}}">{{$tag->name}}</option>
                  @endforeach
              </select>
              <div class="form-group">
                  <label>Tag name</label>
                  <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"/>
              </div>
      
              <x-errors></x-errors>
              <div class="py-3">
                  <button type="submit" class="btn btn-primary btn-block">Ajouter</button>
              </div>
          
          </form>
      </div>
      
  </div>


  </div>
  </div>
  </div>

  
@endsection