@extends('layouts.base_user')


@section('content')

<section class="main_content">
        <section class="header">Vente de crypto monnaie</section>  
        
        <section class="info col-md-4">

  @foreach($users as $user)

  <form action ="{{ route('sell')}}" method="POST">
      @csrf
      @method('PATCH')
      <fieldset>
        <legend>Je souhaite vendre : </legend>
        @foreach($bought_currencies_list as $currency)
        <section class="form-group">
          <label class="col-md-4 control-label" for="quantity">Quantité : </label>
          <section class="col-md-5">
          {{number_format($currency['quantity'])}}
          </section>

        </section>
        
        <section class="form-group">

          <label class="col-md-4 control-label" for="selectbasic">Crypto monnaie : </label>
          <div class="col-md-5">
         {{$currency['Cryptocurrency']->money_name}}
          </div>

        </section>
          @endforeach

        <button type="submit" class="btn btn-primary">Acheter</button>
      </fieldset>
    </form>
      @endforeach
    </section>
    </section>

@endsection