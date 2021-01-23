<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Regletas;
class RegletasController extends Controller
{
    //
    public function getProducts(){
        $productos = Regletas::
            select('producto.idProducto','producto.nombre','imagenes.ruta')
            ->join('producto','producto.idProducto','=','regletas.idProductoRegleta_fk')
            ->join('imagenes','imagenes.idProductoImagen_fk','=','producto.idProducto')
            ->get()->groupBy('idProducto');
            return view('/iluminacionInterior/regletas')->with('productos',$productos);
    }

    public function viewProduct($id){

        $position =  strpos($id, '-s');
        $id = substr($id, $position + 2);
    
        $product = Regletas::
        join('producto','producto.idProducto','=','regletas.idProductoRegleta_fk')
        ->where('producto.idProducto','=', $id)->first();
    
        $imagenes = Regletas::imagenes($id);
    
        return view('regleta')->with(compact('product', $product))->with(compact('imagenes',$imagenes));
    
    }
}
