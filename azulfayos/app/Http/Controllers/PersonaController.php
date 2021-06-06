<?php

namespace App\Http\Controllers;

use App\Models\Persona;
use App\Models\Genero;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
//use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;

class PersonaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $datos['personas']=Persona::paginate(5);
        //$datos1['generos']=Genero::paginate(10);

        //return response()->json($datos);
        //$idPersona = Persona::select("id")->get();//Funciona
        //return response()->json($idPersona);
        //$idPersona = Persona::all()->first();
        //$idPersonaGenero = DB::table('generos')->where('id', '=', $idPersona)->first();
        //$idPersona = DB::select('select id from personas');
        //$idPersonaGenero = DB::select('select * from generos where personas_id = ?',[$idPersona]);
        //DB::table('generos')->where('id', '=', $idPersona)->first();
        //$datos1['generos']=Genero::where('id','=',$idPersona)->get();
        //return response()->json($datos1);
        //if ($datos1){
        $datos1['generos']=Persona::join("generos","personas.id","=","personas_id")->get();
        //foreach ($idPersona as $key => $persona){
        //for ($i = 0; $i < count($idPersona); $i++){
        //$datos1['generos']=Genero::where('personas_id', $persona->id)->get();
        //return response()->json($datos1);
        //return view('persona.index', $datos, $datos1);
        //}
        
        return view('persona.index', $datos, $datos1);
        //}
        //if (!$datos1){

           //return view('persona.index', $datos, $datos1);
        //}
        //return response()->json($persona);

        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('persona.create');
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
            'nombre'=>'required|string|max:100',
            'apellido1'=>'required|string|max:100',
            'apellido2'=>'required|string|max:100',
            'telefono'=>'required|string|max:100',
            'foto'=>'required|max:1000000|mimes:jpeg,png,jpg,gif',
            'DNI'=>'required|string|max:11',
            'direccion'=>'required|string|max:1000',
        ];

        $mensaje=[
            'required'=>'Te falta por rellenar el campo de :attribute',
            'foto.required'=>'Te falta seleccionar una foto'
        ];

        $this->validate($request, $campos, $mensaje);

        //
        $datosPersona  = request()->except('_token');

        if($request->hasFile('foto')){
            $datosPersona['foto']=$request->file('foto')->store('uploads','public');
        }
        
        Persona::insert($datosPersona);

        return redirect('persona')->with('mensaje','Persona agreada con exito');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Persona  $persona
     * @return \Illuminate\Http\Response
     */
    public function show(Persona $persona)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Persona  $persona
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        
        $persona=Persona::findOrFail($id);
        return view('persona.edit', compact('persona'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Persona  $persona
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $campos=[
            'nombre'=>'required|string|max:100',
            'apellido1'=>'required|string|max:100',
            'apellido2'=>'required|string|max:100',
            'telefono'=>'required|string|max:100',
            
            'DNI'=>'required|string|max:11',
            'direccion'=>'required|string|max:1000',
        ];

        $mensaje=[
            'required'=>'Te falta por rellenar el campo de :attribute',
            'foto.required'=>'Te falta seleccionar una foto'
        ];

        if($request->hasFile('foto')){
          $campos= [ 'foto'=>'required|max:1000000|mimes:jpeg,png,jpg,gif'];
          $mensaje=['foto.required'=>'Te falta seleccionar una foto'];
        }

        $this->validate($request, $campos, $mensaje);
        
        //
        $datosPersona = request()->except(['_token','_method']);

        if($request->hasFile('foto')){
            $persona=Persona::findOrFail($id);
            Storage::delete('public/'.$persona->foto);
            $datosPersona['foto']=$request->file('foto')->store('uploads','public');
        }

        Persona::where('id','=',$id)->update($datosPersona);

        $persona=Persona::findOrFail($id);
        //return view('persona.edit', compact('persona'));
        return redirect('persona')->with('mensaje','Persona editada con exito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Persona  $persona
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $persona=Persona::findOrFail($id);
        if(Storage::delete('public/'.$persona->foto)){
            Persona::destroy($id);
        }
        return redirect('persona')->with('mensaje','Persona borrada con exito');
    }
}
