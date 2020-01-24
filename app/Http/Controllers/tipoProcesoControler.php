<?php

namespace App\Http\Controllers;

use App;
use DB;
use Illuminate\Http\Request;

class tipoProcesoControler extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
			$procesos = App\galeria_tipo::where('activo', 1)->get();
			$procesos=App\galeria_tipo::select(DB::raw('galeria_tipos.*, grupos.grupo'))
				->crossJoin('grupos', 'galeria_tipos.grupo_id', '=', 'grupos.id')
				->where('galeria_tipos.activo', 1)
				->get();
			$grupos = App\Grupos::where('activo', 1)->get();
			$usuarios = App\User::where('activo', 1)->get();
			//return $procesos;
			return view('categorias.crear', compact('grupos', 'usuarios', 'procesos'));
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
				//
			//return $request;
			$proceso =  new App\galeria_tipo;
			$proceso -> grupo_id = $request->sltGrupo;
			$proceso -> descripcion = $request->descripcion;
			$proceso -> save();
			//$procesosCompleto = App\galeria_tipo::where('activo', 1)->get();
			return back()->with('mensaje', 'Se guardó correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
				//
				//return $id;
				$proceso = App\galeria_tipo::findOrFail($id);
				//return $proceso;
				$proceso ->activo = 0;
				$proceso->save();
				return back()->with('borrado', 'Se borró correctamente');
    }
}
