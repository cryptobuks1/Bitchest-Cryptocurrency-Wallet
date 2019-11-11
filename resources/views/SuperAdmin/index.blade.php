@extends('layouts.base')


@section('content')

<article class="main_content">
<section class="header"><i class="fa fa-user-circle-o" aria-hidden="true"></i>
 {{ Auth::user()->name }}  est en ligne 
</section> 
        
        <section class="info">
        @if(session()->has('supprimer'))
       <article class="alert alert-dismissible alert-warning">
       <p class="mb-0">{!! session()->get('supprimer')  !!}</p>
       </article>
       @endif

        <a href="/SuperAdmin/create">
          <button type="button" class="btn btn-success my-3">Creer un nouveau Client
          </button>
        </a>

        <table class="table table-hover">
        <thead>
          <tr>
            <th scope="col">Nom</th>
            <th scope="col">Status</th>
            <th scope="col">Infos Utilisateur</th>
            <th scope="col">Modifier</th>
            <th scope="col">Supprimer</th>
          </tr>
        </thead>
        <tbody>
          @foreach($users as $user)
          <tr class="table-success col-md-8">
            <td>{{$user->name}}</td>
            <td>{{$user->status ? 'adminstrateur' : 'client'}}</td>
            <td><a href="/SuperAdmin/{{$user->id}}"><button type="button" class="btn btn-success btn-sm "><i class="fa fa-low-vision" aria-hidden="true"></i>
            Informatins</button></a></td>
            <td><a href="/SuperAdmin/{{$user->id}}/edit"><button type="button" class="btn btn-warning btn-sm "><i class="fa fa-upload" aria-hidden="true"></i>
            Modifier</button></a></td>
            <td><form class="form_action" action="/SuperAdmin/{{$user->id}}" method="POST">
              @csrf
              @method('DELETE')
             <button type="submit" onclick="return confirm('Etes vous sure de vouloir supprimer ce client ');" class="btn btn-danger btn-sm my-3"><i class="fa fa-trash-o" aria-hidden="true"></i><a  href=""></a> Supprimer</button>
             </form>

           </td>
          </tr>
          @endforeach
        </tbody>

      </table> 
      {{ $users->links() }}
      </section>
    </article>

@endsection