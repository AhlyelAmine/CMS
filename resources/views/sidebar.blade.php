<div class="col-md-3 d-none d-md-block py-5">
  <div class="stuck">
    <div class="px-4">
      <h4>Categories</h4>
    </div>
      <div class="card-body card-body-primary">
           <nav class="nav nav-tabs">
              <a class="nav-link @if(Request::path()=="posts") active bg-light @endif" href="{{route('posts.index')}}"> <li> <h6 class="card-title">All</h6></li></a>
           </nav>
           <div class="hide-item">{{$j=0}}</div> 

            @forelse($tags as $tag)
            

           <div class="hide-item"></div> 

              <nav id="item-{{ $loop->iteration }}" class="nav nav-tabs" >
                <a   class="nav-link @if(Request::path()=="tag/$tag->id") active bg-light @endif">
                <li> 
                  <h6 class="card-title">{{$tag->name}}</h6>
                </li>
                </a>
              </nav>
              <div class="hide-item" id="item-{{$j=1+$j}}-child">
                @forelse ($tag->children as $taggable)
                  <nav class="nav mx-2">
                    <a class="nav-link">
                      <li>
                      <h6 class="card-title">{{$taggable->name}}</h6>    
                      </li>
                    </a>
                  </nav>
                @empty
                @endforelse
              </div>
            @empty
            @endforelse
          </ul>
        </ul>
      </div>
  </div>
</div>
