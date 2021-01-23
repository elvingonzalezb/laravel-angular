<?php

namespace App\Http\Controllers;

use App\Contacto;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ContactoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        $contactos = request()->user()->contactos;

        return response()->json([
            'contactos' => $contactos,
        ], 200);
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
    public function store(Request $request) {
       $this->validate($request, [ 
            'nombre'    => 'required',
            'apellido'  => 'required',
            'email'     => 'required|email|unique:contactos,email',
            'telefono'  => 'required',
            'direccion' => 'required',
        ]);

        $contacto = Contacto::create([
            'nombre'    => request('nombre'),            
            'user_id'   => Auth::user()->id,
            'apellido'  => request('apellido'),
            'email'     => request('email'),
            'telefono'  => request('telefono'),
            'direccion' => request('direccion')
        ]);

        return response()->json([
            'contacto' => $contacto,
            'message'  => 'Success'
        ], 200);    
            
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Contacto  $contacto
     * @return \Illuminate\Http\Response
     */
    public function show(Contacto $contacto)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Contacto  $contacto
     * @return \Illuminate\Http\Response
     */
    public function edit(Contacto $contacto)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Contacto  $contacto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Contacto $contacto) {
        $this->validate($request, [ 
            'nombre'    => 'required',
            'apellido'  => 'required',
            'email'     => 'required',
            'telefono'  => 'required',
            'direccion' => 'required',
        ]);

        $contacto->nombre    = request('nombre');
        $contacto->apellido  = request('apellido');
        $contacto->email     = request('nombre');
        $contacto->telefono  = request('telefono');
        $contacto->direccion = request('direccion');
        $contacto->save();

        return response()->json([
            'message'  => 'Contácto actualizado!'
        ], 200);    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Contacto  $contacto
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contacto $contacto) {
        $contacto->delete();

        return response()->json([
            'message' => 'Contacto eliminado satisfactoriamente!'
        ], 200);
    }
}
