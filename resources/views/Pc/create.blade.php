@extends('layouts.app')

@section('content')

    <form action="{{route('permis.store')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="Numero_pc" class="form-label"> Numéro permis:</label>
            <input  class="form-control" id="Numero_pc" name="Numero_pc">
        </div>
        <div class="form-floating">
            <textarea class="form-control" placeholder="Description" id="description" name="description"></textarea>
            <label for="description">Description :</label>
        </div>
        <div class="mb-3">
            <label for="Nom" class="form-label">Nom: </label>
            <input  class="form-control" id="Nom" name="Nom">
        </div>
        <div class="mb-3">
            <label for="Prenom" class="form-label">Prénom: </label>
            <input  type="text" class="form-control" id="Prenom" name="Prenom">
        </div>
        <div class="mb-3">
            <label for="Date_reussite_permis" class="form-label">Date de réussite: </label>
            <input  type="date" class="form-control" id="Date_reussite_permis" name="Date_reussite_permis">
        </div>
        <div class="mb-3">
            <label for="Date_Delivrance" class="form-label">Date de délivrance: </label>
            <input  type="date" class="form-control" id="Date_Delivrance" name="Date_Delivrance">
        </div>
        <div class="mb-3">
            <label for="Date_Edition" class="form-label">Date d'édition: </label>
            <input  type="date" class="form-control" id="Date_Edition" name="Date_Edition">
        </div>
        <div class="mb-3">
            <label for="Agent_delivrance" class="form-label">Agent de délivrance: </label>
            <input  type="text" class="form-control" id="Agent_delivrance" name="Agent_delivrance">
        </div>
        <div class="mb-3">
            <label for="poster" class="form-label">Poster</label>
            <input class="form-control" type="file" id="poster" name="poster" accept="image/png, image/jpeg">
        </div>

        <a type="button" class="btn btn-secondary" href="{{route('permis.index')}}">Annuler</a>
        <button type="submit" class="btn btn-primary">Submit</button>

    </form>

@endsection
