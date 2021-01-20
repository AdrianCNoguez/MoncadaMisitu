<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Series;
class SeriesController extends Controller
{
    //
    public function getProducts(){
        $productos = Series::
            select('producto.idProducto','producto.nombre','imagenes.ruta')
            ->join('producto','producto.idProducto','=','series.idProductoSerie_fk')
            ->join('imagenes','imagenes.idProductoImagen_fk','=','producto.idProducto')
            ->get()->groupBy('idProducto');
            return view('/iluminacionInterior.series')->with('productos',$productos);
    }
}
