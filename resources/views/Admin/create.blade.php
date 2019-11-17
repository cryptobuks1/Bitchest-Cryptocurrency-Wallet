@extends('layouts.base')


@section('content')

<article class="main_content">
  
  <section class="header">Liste des clients de Bitchest.</section>

  <section class="info">

    @if(session()->has('creer'))
    <article class="alert alert-dismissible alert-warning">
      <p class="mb-0">{!! session()->get('creer')  !!}</p>
    </article>
    @endif

    <form action ="/Admin" method="POST">
      @csrf
      <fieldset>
        <legend>Creation d'un Clients</legend>
        <section class="form-group">

          <label for="name">Name</label>
          <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name')}}" aria-describedby="emailHelp" placeholder="Entrer votre Name">
          @error('name')
          <section class="invalid-feedback couleur">
            {{$errors->first('name')}}
          </section>
          @enderror

        </section>

        <section class="form-group">

          <label for="email">Email</label>
          <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{old('email')}}" aria-describedby="emailHelp" placeholder="Entrer votre Email">
          @error('email')
          <section class="invalid-feedback couleur">
            {{$errors->first('email')}}
          </section>
          @enderror

        </section>

        <section class="form-group">

          <label for="password">Mot de Passe</label>
          <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" aria-describedby="emailHelp" placeholder="Entrer un mot de passe">
          @error('password')
          <section class="invalid-feedback couleur">
            {{$errors->first('password')}}
          </section>
          @enderror

        </section>

        <section class="form-group">

          <label for="status">status</label>
          <select class="form-control  @error('status') is-invalid @enderror" id="status" name="status">

            <option value="1">administrateur</option>
            <option value="0">client</option>

          </select>
          @error('status')
          <section class="invalid-feedback couleur">
            {{$errors->first('status')}}
          </section>
          @enderror

        </section>

        <button type="submit" class="btn btn-primary">Submit</button>
      </fieldset>
    </form>
  </section>
</article>

@endsection
