@extends('layouts.base_user')


@section('content')

<article class="main_content">
	 
   <section class="header">Mon Portefeuille .</section>
  
   	<section class="info">
        @if(Session::has('flash_message'))
          <div class="alert alert-success">
          {{ Session::get('flash_message') }}
          </div>
        @endif

        <table class="table table-hover">
        <thead>
          <tr>
            <th>Crypto monnaie</th>
            <th>Quantité</th>
            <th>Euro</th>
            <th>Historique</th>
          </tr>
        </thead>
        <tbody>
          @foreach($bought_currencies_list as $currency)
          <tr class="table-success col-md-8">
            <td><a style="text-decoration:none;" href="{{route('wallet_cryptomoney', ['id' => $currency['Cryptocurrency']->id])}}"><img src="{{URL::asset('/images')}}/{{$currency['Cryptocurrency']->logo}}"/>&nbsp;{{$currency['Cryptocurrency']->money_name}}
            </a></td>
            <td>{{number_format($currency['quantity'])}}</td>
            <td>{{number_format($currency['bought'])}}€</td>
            <td>
            <a href="{{route('wallet_cryptomoney', ['id' => $currency['Cryptocurrency']->id])}}">
             <button type="button" class="btn btn-success"><i class="fa fa-eye"></i> Historique
             </button>
            </a>
            </td>
          </tr>
          @endforeach
        </tbody>

      </table> 
      
      </section>

</article>
@endsection