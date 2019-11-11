@extends('layouts.base')


@section('content')



<article class="main_content">
  <section class="header">Liste des Cypto Monnaies.</section>

  <section class="info">

    <section class="panel panel-default">
      <section class="panel-heading"><h1>{{$title}}</h1></section>

      <section class="panel-body">


        <section class="col-md-12">
          <table class="table table-striped">
            <thead>
              <tr>
                <th>Crypto monnaie</th>
                <th>Cours</th>
              </tr>
            </thead>
            <tbody>
              @foreach($cryptohistory as $crypto_history)
              <tr>
                <td>
                  <img src="{{URL::asset('/images')}}/{{ $crypto_history->logo }}"/>
                  {{ $crypto_history->money_name }}
                </td>
                <td>
                  {{$crypto_history->classes}}
                </td>
              </tr>

              @endforeach
            </tbody>
          </table>
        </section>

      </section>
    </section>

  </section>
</article>

@endsection
