@extends('layouts.base')


@section('content')

<div class="main_content">
        <div class="header">Information personnelle de {{$user->name}}.</div>  
        <div class="info">
       @if(session()->has('modifier'))
       <article class="alert alert-dismissible alert-warning">
       <p class="mb-0">{!! session()->get('modifier')  !!}</p>
       </article>
       @endif
        
        <div class="jumbotron">
        <h4>Nom : {{$user->name}}</h4>
        <p class="lead">Email : {{$user->email}}</p>
        <hr class="my-4">
        <p>Status : {{$user->status}}</p>
        <p class="lead">
         <a href="{{ route('SuperAdmin.index')}}"><button type="button" class="btn btn-success"><i class="fa fa-angle-double-left" aria-hidden="true"></i>
         Back</button></a>
        </p>
      </div>
      </div>
    </div>

@endsection