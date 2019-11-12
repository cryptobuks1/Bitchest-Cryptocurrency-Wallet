@extends('layouts.base_user')


@section('content')

<article class="main_content">
	 
   <section class="header">{{$title}}.</section>
  
   	<section class="info col-md-4">

  @foreach($users as $user)

  <form action ="{{ route('buy.create')}}" method="POST">
      @csrf
      @method('PATCH')
      <fieldset>
        
        <section class="form-group">

          <label for="name">Quantite</label>
          <input type="text" class="form-control @error('quantity') is-invalid @enderror" id="quantity" name="quantity" value="{{ old('quantity')}}" aria-describedby="emailHelp">
          @error('quantite')
          <section class="invalid-feedback couleur">
            {{$errors->first('quantity')}}
          </section>
          @enderror
        </section>


        <section class="form-group">

          <label for="status">Crypto monnaie</label>
          <select class="form-control  @error('selectbasic') is-invalid @enderror" id="selectbasic" name="selectbasic">

            @foreach($cryptocurrency as $crypto)
      <option value="{{ $crypto->id }}">{{ $crypto->money_name }}</option>
              @endforeach

          </select>
          @error('selectbasic')
          <section class="invalid-feedback couleur">
            {{$errors->first('selectbasic')}}
          </section>
          @enderror

        </section>

        <button type="submit" class="btn btn-primary">Acheter</button>
      </fieldset>
    </form>
      @endforeach
    </section>

</article>
@endsection