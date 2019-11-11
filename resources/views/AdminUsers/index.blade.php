@extends('layouts.base_user')


@section('content')

<div class="main_content">
   <section class="header"><i class="fa fa-user-circle-o" aria-hidden="true"></i>
       {{ Auth::user()->name }}  est en ligne 
   </section> 
<div class="info">
        
</div>
</div>
@endsection