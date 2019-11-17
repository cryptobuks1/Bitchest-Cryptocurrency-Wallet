@extends('layouts.base_user')


@section('content')

<section class="main_content">
  
  <section class="header">Cours des crypto monnaies</section>  
        
  <section class="info">

  <table class="table table-striped">
      <thead>
      <tr>
      <th>Crypto monnaie</th>
      <th>Cours</th>
      <th>Action</th>

      </tr>
      </thead>
      <tbody>
      @foreach($crypto_history as $crypto)
      <tr>
      <td>
      <img src="{{URL::asset('/images')}}/{{ $crypto->logo }}"/> {{$crypto->money_name}}
      </a>
      </td>
      <td>{{$crypto->rate}}</td>
      <td>
      <a href="{{route('graph', ['crypto_id' => $crypto->id])}}" class="btn btn-default btn-xs"><i class="fa fa-eye" aria-hidden="true"></i>&nbsp;Évolution</a>
      <a href="{{route('buy.index')}}" class="btn btn-primary btn-xs">Acheter</a>
      </td>
      </tr>
      @endforeach
      </tbody>
      </table>

  </section>

</section>

@endsection