<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
//use App\proveedores;
use App;
use DB;

class proveedoresControler extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
				$resp = $request->validate([
					'ruc' => 'required|unique:proveedores,ruc|max:11|min:8',
					'razonsocial' => 'required'
				], [
					'ruc.required' => 'El R.U.C. no puede estar en blanco',
					'ruc.unique' => 'El R.U.C. ya se encuentra registrado',
					'razonsocial.required' => 'La Razón Social no puede vacía'
				]);
				
				$nuevo =  new App\Proveedores;

				$nuevo -> ruc = $request->ruc;
				$nuevo -> razonsocial = $request->razonsocial;
				$nuevo -> direccion = $request->direccion;
				$nuevo -> celular = $request->celular;
				$nuevo -> contacto = $request->contacto;
				$nuevo -> save();

				//FALTA: Redirigir al nuevo proveedor
				return back()->with('mensaje', 'El proveedor ' . $request->razonsocial. ' se registró exitósamente' );

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\proveedores  $proveedores
     * @return \Illuminate\Http\Response
     */
    public function show(proveedores $proveedores)
    {
        $proveedores = DB::table('proveedores')->get();
        return $proveedores;
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\proveedores  $proveedores
     * @return \Illuminate\Http\Response
     */
    public function edit(proveedores $proveedores)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\proveedores  $proveedores
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, proveedores $proveedores)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\proveedores  $proveedores
     * @return \Illuminate\Http\Response
     */
    public function destroy(proveedores $proveedores)
    {
        //
		}
}
