@extends('layouts.base_user')


@section('content')

<section class="main_content">
        <section class="header">Bienvenue Monsieur Diagne vous vous etez connecter en tant que utilisateur simple.</section>  
        
        <section class="info">
@foreach($users as $user)

      
<form action ="/AdminUsers/{{$user->id}}" method="POST">
@csrf
@method('PATCH')

  <fieldset>
    <legend>Editer le profile de : {{$user->name}}</legend>
    <section class="form-group">
      <label for="name">Name</label>
      <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"name="name" value="{{old('name') ?? $user->name}}" aria-describedby="emailHelp" placeholder="Entrer votre Name">
    @error('name')
    <section class="invalid-feedback couleur">
    {{$errors->first('name')}}
    </section>
    @enderror
    </section>

    <section class="form-group">
      <label for="email">Email</label>
      <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{old('email')?? $user->email }}" aria-describedby="emailHelp" placeholder="Entrer votre Email">

    @error('email')
    <section class="invalid-feedback couleur">
    {{$errors->first('email')}}
    </section>
    @enderror
    
    </section>
    <section class="form-group">
      <label for="status">status</label>
      <select class="form-control  @error('status') is-invalid @enderror" id="status" name="status">
      <option value="1"  @if($user->status=="administrateur") selected @endif>administrateur</option>
      <option value="0"  @if($user->status=="client") selected @endif>client</option>
      </select>
      @error('status')
    <section class="invalid-feedback couleur">
    {{$errors->first('status')}}
    </section>
    @enderror

    </section>
    
    <button type="submit" class="btn btn-primary">Save</button>
  </fieldset>
</form>




      @endforeach
</section>
    </section>

@endsection