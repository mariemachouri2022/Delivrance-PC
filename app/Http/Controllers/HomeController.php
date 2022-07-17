<?php

namespace App\Http\Controllers;

use App\Models\Permis;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        //
        $permis=Permis::paginate();
        $data=[
            'title' => 'PC',
            'description' => 'Liste des Permis',
            'heading' => config('app.name'),
            'permis' => $permis
        ];
        return view('home.index',$data);
    }
}
