<?php

namespace App\Http\Controllers;

use App\Insumos;
use Illuminate\Http\Request;

class insumosController extends Controller
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\insumos  $insumos
     * @return \Illuminate\Http\Response
     */
    public function show(insumos $insumos)
    {
			return $insumos::where('activo', 1)->get();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\insumos  $insumos
     * @return \Illuminate\Http\Response
     */
    public function edit(insumos $insumos)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\insumos  $insumos
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, insumos $insumos)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\insumos  $insumos
     * @return \Illuminate\Http\Response
     */
    public function destroy(insumos $insumos)
    {
        //
    }
}
