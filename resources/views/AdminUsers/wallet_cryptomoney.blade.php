@extends('layouts.base_user')


@section('content')

<article class="main_content">
	 
   <section class="header">{{$title}}</section>
  
   	<section class="info">
         
                        <div class="col-md-12">
                            <h2>Mes achats</h2>
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Quantité</th>
                                    <th>Cours</th>
                                    <th>Plus value*</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($transactions as $transaction)
                                    <tr>
                                        <td>{{$transaction->buy_date}}</td>
                                        <td>{{$transaction->quantity}}</td>
                                        <td>{{$rate}}</td>
                                        
                                        <td>{{$capital_gain}} €</td>
                                        <td><a href="{{route('sell')}}" class="btn btn-primary btn-xs">Vendre</a></td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <p>Total : <strong>{{$total}} {{$title}}</strong></p>
                            <p class="Pt30">*Plus-value actuelle (gain en cas de vente)</p>

                        </div>
        
      </section>

</article>
@endsection