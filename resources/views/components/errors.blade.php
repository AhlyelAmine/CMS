
@if($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
      <li class="text-danger">
           <span role="alert">
            <strong >{{$error}}</strong>
        </span>
    </li>     
        @endforeach
    </ul>
</div>
@endif