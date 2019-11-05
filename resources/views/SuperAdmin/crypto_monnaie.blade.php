@extends('layouts.base')


@section('content')



<div class="main_content">
        <div class="header">Liste des Cypto Monnaies.</div> 
        
        <div class="info">
          
          <div class="panel panel-default">
                    <div class="panel-heading"><h1>{{$title}}</h1></div>

                    <div class="panel-body">


                        <div class="col-md-12">
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
                        </div>

                    </div>
                </div>

      </div>
    </div>

@endsection