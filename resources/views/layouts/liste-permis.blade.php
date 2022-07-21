<div class="container-fluid m-3">
    <div class="row row-cols-3 row-cols-md-4 row-cols-sm-12 d-flex justify-content-around gy-4 ">
        @foreach ($permis as $permis)
            <div class="card col m-b-2" style="width: 18rem;">
                <img src="{{$permis->urlPoster}}" class="card-img-top" width="200" height="200" alt="{{$permis->nom}}">
                <div class="card-body">
                <h5 class="card-title">{{$permis->nom}}</h5>
                <p class="card-text">{{$permis->description}}</p>
                <a href="{{route('permis.show',[$permis])}}" class="btn btn-primary">Détails</a>
                </div>
            </div>

        @endforeach
    </div>
</div>


{!!$permis->links()!!}
