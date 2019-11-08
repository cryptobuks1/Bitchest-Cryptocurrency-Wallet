@extends('layouts.base')


@section('content')

<div class="main_content">
        <div class="header">Liste des clients de Bitchest.</div> 

<div class="info">

<form action ="/SuperAdmin/{{$user->id}}" method="POST">
@csrf
@method('PATCH')

  <fieldset>
    <legend>Editer le profile de : {{$user->name}}</legend>
    <div class="form-group">
      <label for="name">Name</label>
      <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"name="name" value="{{old('name') ?? $user->name}}" aria-describedby="emailHelp" placeholder="Entrer votre Name">
    @error('name')
    <div class="invalid-feedback couleur">
    {{$errors->first('name')}}
    </div>
    @enderror
    </div>

    <div class="form-group">
      <label for="email">Email</label>
      <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{old('email')?? $user->email }}" aria-describedby="emailHelp" placeholder="Entrer votre Email">

    @error('email')
    <div class="invalid-feedback couleur">
    {{$errors->first('email')}}
    </div>
    @enderror
    
    </div>
    <div class="form-group">
      <label for="status">status</label>
      <select class="form-control  @error('status') is-invalid @enderror" id="status" name="status">
      <option value="1"  @if($user->status=="actif") selected @endif>actif</option>
      <option value="0"  @if($user->status=="inctif") selected @endif>inactif</option>
      </select>
      @error('status')
    <div class="invalid-feedback couleur">
    {{$errors->first('status')}}
    </div>
    @enderror

    </div>
    
    <button type="submit" class="btn btn-primary">Save</button>
  </fieldset>
</form>
      </div>
    </div>

@endsection