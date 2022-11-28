<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CalendarioController extends Controller
{
    public function index() {
        /**
         * 
         * select a.fecha, a.hora, b.nombre, c.nombre from qatar.partidos a 
         * inner join qatar.paises b 
         * inner join qatar.paises c
         * on a.local_pais_id = b.id and a.visita_pais_id = c.id
         * order by a.fecha;
         * 
         */
        $calendario = DB::table('partidos as a')
                        ->join('paises as b', 'a.local_pais_id', '=', 'b.id')
                        ->join('paises as c', 'a.visita_pais_id', '=', 'c.id')
                        ->select('a.fecha', 'a.hora', 'b.nombre as local', 'c.nombre as visita')
                        ->orderBy('fecha')
                        ->orderBy('hora')
                        ->get();

        return response()->json([
            'status' => true, 
            'calendario' => $calendario
        ]);
    }
}
