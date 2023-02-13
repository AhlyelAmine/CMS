@extends('layouts')

@section('content')
<div class="">
    <div class="row">
  <div class="col-3"></div>
    <div class="col-md-6 py-4">
      <ul class="list-group">
        
      @forelse ($users as $user)


      <li  style="border-radius: 10px;" class="list-group-item shadow p-3 mb-2 bg-white ">

      <div class="d-flex justify-content-between align-items-center">
        <div class="user d-flex flex-row align-items-center">

          @if($user->image)
          <img src="{{ $user->image->url() }}" width="50" class="user-img rounded-circle mr-2 border shadow m-3">
          @else
          <img src="https://ubisoft-avatars.akamaized.net/7eac7e60-97e3-4968-88da-4b8358f902e8/default_256_256.png" width="50" class="user-img rounded-circle mr-2 border shadow m-3">
          @endif


           <span>
             <small class="font-weight-bold text-primary"><a class="text-decoration-none" href="{{route('users.show',['user'=> $user])}}">{{$user->name}}</a></small> 
            </span>
           </div> 
           <small class="text-muted">créé {{$user->created_at->diffForHumans()}}</small>
    </div>
    <small class="text-muted">{{$user->comments_count}} commentaire</small>



       
         
    </li>
  </ul>
  
  
   @empty
   @endforelse
    </div>
 
    <div class="col-md-3 d-none d-md-block py-4">
      <div class="stuck">
        <h4 class="px-4">Most Active Users</h4>
        <div class="card-body card-body-primary"> 
            @forelse($mostComments as $user)
            @if(!$user->comments_count=='0')
            <nav class="nav nav-tabs">
                <a class="nav-link" href="{{route('users.show',['user'=> $user])}}"> 
                    <li> 
                        <h6 class="card-title">{{$user->name}}</h6>
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