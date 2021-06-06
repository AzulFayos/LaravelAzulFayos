<?php

namespace App\Http\Controllers;

use App\Models\Genero;
use App\Models\Persona;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;


class GeneroController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        //$datos['generos']=Genero::paginate(10);
        return redirect('persona');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $campos=[
            'GenNombre'=>'required|string|max:100',
        ];

        $mensaje=[
            'required'=>'Te falta por rellenar el campo de :attribute',
        ];

        $this->validate($request, $campos, $mensaje);
        //
        $datosGenero = request()->except(['_token','_method']);

        $idPersona = DB::table('personas')->where('id')->first();
        $idPersonaGenero = DB::table('generos')->where('id', '=', $idPersona)->first();

       // if(!$idPersonaGenero){
            //return response()->json($datosGenero);
           // return redirect('persona')->with('mensaje', 'genero no insertado');
        //}
       // if ($idPersonaGenero){
            //Genero::insert($datosGenero);
      //      return redirect('persona')->with('mensaje', 'genero insertado');
      //  }
        
        Genero::insert($datosGenero);
       // return response()->json($datosGenero);
        return redirect('persona')->with('mensaje','Género agregado correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Genero  $genero
     * @return \Illuminate\Http\Response
     */
    public function show(Genero $genero)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Genero  $genero
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $genero=Genero::findOrFail($id);
        return view('genero.edit', compact('genero'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Genero  $genero
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $campos=[
            'GenNombre'=>'required|string|max:100',
        ];

        $mensaje=[
            'required'=>'Te falta por rellenar el campo de :attribute',
        ];

        $this->validate($request, $campos, $mensaje);
        //
        $datosGenero = request()->except(['_token','_method']);
        Genero::where('id','=',$id)->update($datosGenero);

        $genero=Genero::findOrFail($id);
        //return view('genero.edit', compact('genero'));
        return redirect('persona')->with('mensaje','Género editado con éxito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Genero  $genero
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $campos=[
            'id'=>'required|integer|max:100',
            'GenNombre'=>'required|string|max:100',
        ];

        $mensaje=[
            'required'=>'Te falta por seleccionar el campo de :attribute',
        ];

        $this->validate($request, $campos, $mensaje);
        //
        $genero=Genero::findOrFail($id);
        Genero::destroy($id);
        return redirect('persona')->with('mensaje','Género borrado con exito');
    }
}
