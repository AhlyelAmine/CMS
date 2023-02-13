@extends('layouts')

@section('content')
<div class="d-flex justify-content-center">
<img src="{{asset('storage/local/cover.jpeg')}}">
<img src="{{asset('storage/local/cover.jpeg')}}">
</div>
<div class="d-flex justify-content-center container">
  <div class="row pt-5">
      <div class="col-xl-8 pt-4">
        <div style="border-radius: 10px;" class="list-group-item mx-3 shadow bg-white">
          <div class="d-flex justify-content-center">
            <h1 class="text-dark">Cours</h1>
          </div>
          <div >
            @forelse ($tags as $tag)
            <div class="d-flex justify-content-center ">
              <div class="d-inline-block" style="width: 80%;">
                <li  style="border-radius: 10px" class="list-group-items shadow p-3 mb-2 bg-white">
                  <h3 class="d-inline text-dark">{{$tag->name}}</h3>
                  <x-badge type="info"><small class="text-light">{{$tag->posts_count}}</small></x-badge>
                </li>
              </div>
            </div>

            @empty
              <div class="d-flex justify-content-center py-5"><x-badge type="warning">No Lessons Post Yet!</x-badge></div>
            @endforelse
          </div>
        </div>
      </div>
      <div class="col-xl-4 pt-4">
        <div>
          <div style="border-radius: 10px;" class="list-group-item mx-3 shadow bg-white">
            <div>
              <div class="d-block">
                <div class="d-flex justify-content-center">                  
                  <img src="https://ubisoft-avatars.akamaized.net/7eac7e60-97e3-4968-88da-4b8358f902e8/default_256_256.png" width="100" class=" user-img rounded-circle mr-2 border shadow m-3">
                </div>
                <div class="d-flex justify-content-center">                  
                  <h4 class="text-dark">Abdelghali AMMAR</h4>
                </div>
                <div class="d-flex justify-content-center align-items-center">                  
                  <p class="mx-2 text-dark">Maths Avec Ammar est une chaine éducative pour comprendre les mathématiques facilement, crée par le professeur docteur Abdelghali AMMAR qui est un enseignant chercheur de mathématiques à l'Université Cadi Ayyad, Maroc.
                    Contact : mathsavecammar@gmail.com .</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
  </div>
 
</div>
   
@endsection
