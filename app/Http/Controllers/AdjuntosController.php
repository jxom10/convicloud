<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Adjunto;
use Illuminate\Support\Str;
use Intervention\Image\Laravel\Facades\Image;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;



class AdjuntosController extends Controller
{
    public function subir_archivo(Request $request){
		if($request->file){
			$nombre = Str::random(40);//hrtime(true).'.'.$ext;
			if($request->file('file')->storeas('images',$nombre)){
				$adjunto = new Adjunto;
				$adjunto->nombre = $nombre;
				$adjunto->descripcion = $request->file('file')->getClientOriginalName();
				$adjunto->tipo =  $request->file('file')->getClientOriginalExtension();
				$adjunto->id_caso = $request->id_caso;
				$adjunto->save();
				session()->flash('mensaje',['success','Archivo guardado correctamente']);
			}
		}
		else{
			session()->flash('mensaje',['danger','No se ha seleccionado archivo']);
		}
		
		return redirect()->route('caso_ver',['id'=>$request->id_caso]);
	}

	public function descargar( $nombre){
		$adjunto =  Adjunto::where('nombre',$nombre)->first();
		$file= 'images/'.$adjunto->nombre;

		return Response::download($file, $adjunto->descripcion);
	}
	public function eliminar($id){
		$adjunto = Adjunto::find($id);
		$nombre = $adjunto->descripcion;
		if($adjunto){
			$adjunto->delete();
		}
		return   response()->json(['adjunto' => $id,'nombre'=>$nombre]);
 	}
}

