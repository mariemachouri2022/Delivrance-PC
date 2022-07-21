<?php

namespace App\Http\Controllers;

use App\Models\Permis;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

use Str;

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
            'Agent_delivrance' => 'Agent de délivrance: '.$permis->Agent_delivrance,
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
        DB::beginTransaction();
        try{
            $validated = $request->validated();
            $poster=null;
            $urlPoster=null;

            if(($request->file('poster')!==null)&&($request->file('poster')->isValid())){

                $ext=$request->file('poster')->extension();
                $fileName=Str::uuid().'.'.$ext;
                $poster=$request->file('poster')->storeAs('public/images',$fileName);
                $urlPoster=env('APP_URL').Storage::url($poster);
            }

            Auth::user()->permis()->create([
                'Numero_pc'=> $validated['Numero_pc'],
                'Nom' => $validated['Nom'],
                'Prenom' => $validated['Prenom'],
                'poster' => $poster,
                'urlPoster' => $urlPoster,
                'Date_reussite_permis' => $validated['Date_reussite_permis'],
                'Date_Delivrance' => $validated['Date_Delivrance'] ,
                'Date_Edition' => $validated['Date_Edition'],
                'Agent_delivrance' => $validated['Agent_delivrance']
            ]);

        }catch(ValidationException $exception){
            DB::rollBack();
        }

        DB::commit();

        return redirect()->route('permis.index');
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
            'Agent_delivrance' => 'Agent de délivrance: '.$permis->Agent_delivrance,
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
        abort_if(auth()->user()->id !== $permis->organisateur->id,403 );

        $data=[
            'title' => $description="Editer PC ".$permis->nom,
            'description' => $description,
            'heading' => $description,
            'permis' =>$permis
        ];
        return view('permis.edit',$data);
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
        abort_if($permis->organisateur->id !== auth()->id(),403);

        DB::beginTransaction();
        try{
            $validated = $request->validated();

            $poster=$permis>poster;
            $urlPoster=$permis->urlPoster;

            if(($request->file('poster')!==null)&&($request->file('poster')->isValid())){

                $ext=$request->file('poster')->extension();
                $fileName=Str::uuid().'.'.$ext;
                $poster=$request->file('poster')->storeAs('public/images',$fileName);
                $urlPoster=env('APP_URL').Storage::url($poster);



                //Supprimer l'ancien poster s'il existe
                DB::afterCommit(function() use($permis){
                    if($permis->poster!=null){
                        Storage::delete($permis->poster);
                    }

                });

            }
            Auth::user()->permis()->where('id',$permis->id)->update([
                'Numero_pc'=> $validated['Numero_pc'],
                'Nom' => $validated['Nom'],
                'Prenom' => $validated['Prenom'],
                'poster' => $poster,
                'urlPoster' => $urlPoster,
                'Date_reussite_permis' => $validated['Date_reussite_permis'],
                'Date_Delivrance' => $validated['Date_Delivrance'] ,
                'Date_Edition' => $validated['Date_Edition'],
                'Agent_delivrance' => $validated['Agent_delivrance']
            ]);

        }catch(ValidationException $exception){
            DB::rollback();
        }
        DB::commit();

        return redirect()->route('permis.show',[$permis]);
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
        abort_if($permis->organisateur->id !== auth()->id(),403);

        DB::beginTransaction();
        try{
            DB::afterCommit(function() use($permis){

                if($permis->poster!=null){
                    Storage::delete($permis->poster);
                }

            });

            $permis->delete();

        }catch(ValidationException $e){
            DB::rollback();
        }
        DB::commit();

        return redirect()->route('permis.index');
    }
}
