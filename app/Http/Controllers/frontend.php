<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class frontend extends Controller
{
    //
    public function __construct(){
        //if (Auth::guest()){ return redirect('/login'); }else{  return view('plantillas.inicio');}
        $this->middleware('auth');
    }
    public function index(){
        return view('plantillas.inicio');
    }
    public function caja(){ return view('caja.cajaInicio'); }
}
