@extends('layouts')

@section('content')

    <div class="row">
        <div class="col-md-4">
        </div>
        <div class="col-md-8 justify-content-center">

            <img src="{{ $user->image ? $user->image->url() : '' }}" alt=""  width="140" class="user-img rounded-circle mr-2 border shadow m-3">
                @can('update', $user)
                 <a href="{{ route('users.edit', ['user' => $user->id]) }}" class="btn btn-info btn-sm">Edit</a>
                @endcan
            <h3>{{ $user->name }}</h3>
            
        </div>
    </div>
@endsection