@extends('layouts.app')

@section('content')
    <a type="button" class="btn btn-primary" href="{{URL::previous()}}">Retour</a>
    @if((Auth::check())&&(Auth::user()->id === $permis->user_id))
        <a type="button" class="btn btn-primary" href="{{route('permis.edit',[$permis])}}">Modifier</a>
        <form style="display: inline;" action="{{ route('events.destroy', [$permis]) }}" method="post">
             @csrf
            @method('DELETE')
             <button class="btn btn-danger" type="submit">
                 Supprimer
             </button>
        </form>
    @endif

    <div class="card m-3 " style="max-width: 80%; ">
        <div class="row g-0">
        <div class="col-md-4">
            <img src="{{$permis->urlPoster}}" class="img-fluid rounded-start" alt="{{$permis->nom}}">
        </div>
        <div class="col-md-8">
            <div class="card-body">
            <h5 class="card-title">Numéro permis:{{$permis->Numero_pc}}</h5>
            <p class="card-title"> Nom : {{$permis->Nom}}</p>
            <p class="card-text">Prénom :{{$permis->Prenom}}</p>
            <p class="card-text">Date de réussite: {{$permis->Date_reussite_permis}}</p>
            <p class="card-text">Date de délivrance: {{$permis->Date_Delivrance}}</p>
            <p class="card-text">Date d édition : {{$permis->Date_Edition}}</p>
            <p class="card-text">Agent de délivrance : {{$permis->Agent_delivrance}}</p>

            

            </div>
        </div>
        </div>
    </div>
@endsection
