<?php

namespace App\Http\Controllers;

use App\Models\Permis;
use Illuminate\Http\Request;
use App\Models\User;

class PermisController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $permis=auth()->user()->permis()->paginate();


        $data=[
            'title' => $description="Mes permis",
            'Numero_pc' => 'Numéro permis: '.$permis->Numero_pc,
            'Nom' => 'Nom: '.$permis->Nom,
            'Prenom' => 'Prénom: '.$permis->Prenom,
            'Date_reussite_permis' => 'Date de réussite: '.$permis->Date_reussite_permis,
            'Date_Delivrance' => 'Date de délivrance: '.$permis->Date_Delivrance,
            'Date_Edition' => 'Date d édition : '.$permis->Date_Edition,
            'Agent_delivrance' => 'Agent de délivrance '.$permis->Agent_delivrance,
            'heading' => $description ,
            'permis' => $permis
        ];

        return view('permis.mes-permis',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $data=[
            'title' => $description="ajouter nouveau permis",
            'description' => $description,

            'heading' => $description
        ];
        return view('permis.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Permis  $permis
     * @return \Illuminate\Http\Response
     */
    public function show(Permis $permis)
    {
          $data=[
            'Numero_pc' => 'Numéro permis: '.$permis->Numero_pc,
            'Nom' => 'Nom: '.$permis->Nom,
            'Prenom' => 'Prénom: '.$permis->Prenom,
            'Date_reussite_permis' => 'Date de réussite: '.$permis->Date_reussite_permis,
            'Date_Delivrance' => 'Date de délivrance: '.$permis->Date_Delivrance,
            'Date_Edition' => 'Date d édition : '.$permis->Date_Edition,
            'Agent_delivrance' => 'Agent de délivrance '.$permis->Agent_delivrance,
            'heading' => config('app.name'),
            'permis' => $permis
        ];
        return view('permis.details-permis', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Permis  $permis
     * @return \Illuminate\Http\Response
     */
    public function edit(Permis $permis)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Permis  $permis
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Permis $permis)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Permis  $permis
     * @return \Illuminate\Http\Response
     */
    public function destroy(Permis $permis)
    {
        //
    }
}
