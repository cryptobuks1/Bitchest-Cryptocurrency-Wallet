@extends('layouts.base')


@section('content')

<article class="main_content">
  <section class="header">Information personnelle de {{$user->name}}.</section>
  <section class="info">
    @if(session()->has('modifier'))
    <article class="alert alert-dismissible alert-warning">
      <p class="mb-0">{!! session()->get('modifier')  !!}</p>
    </article>
    @endif

    <section class="jumbotron">

      <h4>Nom : {{$user->name}}</h4>
      <p class="lead">Email : {{$user->email}}</p>
      <hr class="my-4">
      <p>Status : {{$user->status ? 'administrateur' : 'client'}}</p>
      <p class="lead">
       <a href="{{ route('SuperAdmin.index')}}">
        <button type="button" class="btn btn-success">
          <i class="fa fa-angle-double-left" aria-hidden="true"></i>
          Back
        </button>
        </a>
      </p>

      </section>

    </section>

  </article>

  @endsection
