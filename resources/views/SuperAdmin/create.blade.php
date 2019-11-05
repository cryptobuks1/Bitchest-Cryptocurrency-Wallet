@extends('layouts.base')


@section('content')

<div class="main_content">
        <div class="header">Liste des clients de Bitchest.</div> 

        <div class="info">
        <form action ="/SuperAdmin" method="POST">
@csrf
  <fieldset>
    <legend>Creation d'un Clients</legend>
    <div class="form-group">
      <label for="name">Name</label>
      <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name')}}" aria-describedby="emailHelp" placeholder="Entrer votre Name">
    @error('name')
    <div class="invalid-feedback couleur">
    {{$errors->first('name')}}
    </div>
    @enderror
    </div>

    <div class="form-group">
      <label for="email">Email</label>
      <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{old('email')}}" aria-describedby="emailHelp" placeholder="Entrer votre Email">
    @error('email')
    <div class="invalid-feedback couleur">
    {{$errors->first('email')}}
    </div>
    @enderror
    </div>
    <div class="form-group">
      <label for="password">Mot de Passe</label>
      <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" aria-describedby="emailHelp" placeholder="Entrer un mot de passe">
    @error('password')
    <div class="invalid-feedback couleur">
    {{$errors->first('password')}}
    </div>
    @enderror
    </div>

    <div class="form-group">
      <label for="status">status</label>
      <select class="form-control  @error('status') is-invalid @enderror" id="status" name="status">
      @foreach($user->getstatusOption() as $key => $value)
        <option value="{{$key}}" {{$user->status == $value ? 'selected' : ''}}>{{$value}}</option>
      @endforeach
      </select>
      @error('status')
    <div class="invalid-feedback couleur">
    {{$errors->first('status')}}
    </div>
    @enderror

    </div>
    
    <button type="submit" class="btn btn-primary">Submit</button>
  </fieldset>
</form>
      </div>
    </div>

@endsection