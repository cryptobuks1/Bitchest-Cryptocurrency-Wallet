@extends('layouts.base_user')


@section('content')

<section class="main_content">
        <section class="header"></section>  
        
        <section class="info">
          <div class="panel panel-default">
            <div class="panel-heading"><h1><img src="{{URL::asset('/images')}}/{{$crypto->logo}}"/>&nbsp;{{$crypto->money_name}}{{$title}}</h1></div>
            <div class="panel-body">
          
            {!! $chart->html() !!}
            
            <div class="row text-center Pt30">
            <a href="{{route('buy.index')}}" class="btn btn-primary ">Acheter</a>
            </div>
            </div>
          </div>
        </section>

        </section>
{!! Charts::scripts() !!}
{!! $chart->script() !!}
@endsection