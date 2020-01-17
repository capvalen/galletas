<?php

namespace App\Http\Controllers;

use Auth;
use App;
use DB;
use File;
use Illuminate\Http\Request;

class galeriaControler extends Controller
{
	public function __construct(){
		$this->middleware('auth');
	}
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($fecha='')
    {
			$grupos = App\Grupos::where('activo', 1)->get();
			//return $grupos;
        if($fecha ==''){
					$fecha = date('Y-m-d');
					//entró vacío
					
					/* foreach ($galerias as $galeria) {
						echo $galeria->grupo;
					} */

					//$galerias = App\Galerias::findOrFail(1);//whereDate('created_at', date('Y-m-d') )->get();
					//return $galerias->grupo;
				}else{
					//entró con fecha
				}
				$galerias = App\Galerias::whereDate('created_at', $fecha )->get();
				$contador=App\Galerias::select(DB::raw('grupos.grupo, count(galerias.grupo_id) as cantidad, galerias.grupo_id'))
				->crossJoin('grupos', 'galerias.grupo_id', '=', 'grupos.id')
				->groupBy('galerias.grupo_id', 'grupos.grupo')
				->whereDate('galerias.dia', $fecha )
				->get();
				//return $contador;
				return view('galeria.mostrar', compact('fecha', 'galerias', 'grupos', 'contador'));
		}
		public function grupo($fecha='', $idGrupo=''){
			$categorias = App\Galerias::select(DB::raw('galerias.id, galeria_tipos.descripcion, galerias.foto, observacion, galerias.created_at, dia' ))
			->crossJoin('galeria_tipos', 'galeria_tipos.id', '=', 'galerias.idTipoGaleria')
			->whereDate('galerias.dia', $fecha )->where('galerias.grupo_id', $idGrupo)->get();
			//return $categorias;
			
			return view('galeria.mostrar', compact('fecha', 'categorias'));
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
    public function subida()
    {
			$grupos = App\Grupos::where('activo', 1)->get();
			$tipos = App\galeria_tipo::where('activo', 1)->get();
			//return $tipos;
			return view('galeria.subida', compact('grupos', 'tipos' ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
			//return $request;
			if( $request->hasFile('archivo') ){
				$archivo = $request->file('archivo');
				$extension = $archivo -> getClientOriginalExtension();
				$nombArchivo = time().'.'.$extension;
				$archivo->move('subidas/', $nombArchivo);
				
				$galeria =  new App\Galerias;
				$galeria -> foto = $nombArchivo;
				$galeria -> grupo_id = $request->grupo;
				$galeria -> idTipoGaleria = $request->tipo;
				$galeria -> dia = $request->dia;
				$galeria -> observacion = $request->observacion;
				$galeria -> idUser = Auth::id();
				$galeria -> save();
				return back()->with('mensaje','¡Archivo subido con éxito!')->with('fechaGuardada', $request->dia);
			}else{
				return back()->with('error','Debe subir un archivo antes de guardar');
			}
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
			$galeria = App\Galerias::findOrFail($id);
			//return $galeria;
			$grupos = App\Grupos::where('activo', 1)->get();
			$tipos = App\galeria_tipo::where('activo', 1)->get();
			//return $tipos;
			return view('galeria.editar', compact( 'galeria', 'grupos', 'tipos' ));
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
			$galeria = App\Galerias::findOrFail($id);
			$galeria -> grupo_id = $request->grupo;
			$galeria -> idTipoGaleria = $request->tipo;
			$galeria -> dia = $request->dia;
			$galeria -> observacion = $request->observacion;
			$galeria ->save();
			return redirect()->route('galeria.mostrar.grupo',  [$request->dia, $request->grupo]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
				//return $request;
				$galeria = App\Galerias::findOrFail($request->idBorrar);
				//return $galeria;
				$nombreArchivo = $galeria -> foto;
        File::delete('subidas/'. $nombreArchivo );
				$galeria->delete();

				//return 'ok';
				
        return back()->with('borrado', 'Foto eliminada del servidor');
    }
}
