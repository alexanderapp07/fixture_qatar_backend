<?php

namespace App\Http\Controllers;

use App\Models\Pais;
use App\Models\Partido;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use function PHPUnit\Framework\isNull;

class TablaController extends Controller
{
    public function golesEnContra() {
        $goles = [];

        for($i = 0; $i < 32; $i++) {
            $pais = Pais::findOrFail($i+1);

            $query = DB::table('partidos as p')
                        ->join('estadisticas as e', 'p.id', '=', 'e.partido_id')
                        ->join('jugadores as j', 'e.jugador_id', '=', 'j.id')
                        ->join('paises as pa', 'j.pais_id', '=', 'pa.id')
                        ->select('p.local_pais_id', 'p.visita_pais_id', 'e.nombre', DB::raw('count(e.nombre) as cantidad'), 'pa.nombre')
                        ->groupBy('p.local_pais_id', 'p.visita_pais_id', 'e.nombre', 'pa.nombre')
                        ->havingRaw('(p.local_pais_id = ' . strval($pais->id) . ' or p.visita_pais_id = ' . strval($pais->id) .') and e.nombre = "GOL" and not pa.nombre = "' . $pais->nombre . '"')
                        ->get();
            $item = $query->first();

            if($item == null) {
                array_push($goles, [
                    "nombre" => $pais->nombre,
                    "cantidad" => 0
                ]);
            } else {
                array_push($goles, [
                    "nombre" => $pais->nombre,
                    "cantidad" => $item->cantidad
                ]);
            }
        }

        return $goles;
    }

    public function golesFavor() {
        /*
            select count(e.nombre), e.nombre, p.nombre from qatar.estadisticas e
            inner join qatar.jugadores j
            inner join qatar.paises p
            on e.jugador_id = j.id and j.pais_id = p.id
            group by e.nombre, p.nombre
            having e.nombre = 'GOL';
         */
        $goles = [];
        
        for($i = 0; $i < 32; $i++) {
            $pais = Pais::findOrFail($i + 1);

            $query = DB::table('estadisticas as e')
                    ->join('jugadores as j', 'e.jugador_id', '=', 'j.id')
                    ->join('paises as p', 'j.pais_id', '=', 'p.id')
                    ->select('e.nombre', 'p.nombre', DB::raw('count(e.nombre) as cantidad'))
                    ->groupBy('e.nombre', 'p.nombre')
                    ->havingRaw('e.nombre = "GOL" and p.nombre = "' . $pais->nombre . '"')
                    ->get();
            $item = $query->first();

            if($item == null) {
                array_push($goles, [
                    "nombre" => $pais->nombre,
                    "cantidad" => 0
                ]);
            } else {
                array_push($goles, [
                    "nombre" => $pais->nombre,
                    "cantidad" => $item->cantidad
                ]);
            }
        }

        return $goles;
    }

    public function puntosPorPais() {
        $goles_partidos = [];
        $puntos = [];

        for($i = 0; $i < 12; $i++) { // $i < 48
            $partido = Partido::findOrFail($i + 1);

            $query = DB::table('partidos as a')
            ->join('paises as b', 'a.local_pais_id', '=', 'b.id')
            ->join('paises as c', 'a.visita_pais_id', '=', 'c.id')
            ->join('estadisticas as d', 'a.id', '=', 'd.partido_id')
            ->join('jugadores as e', 'd.jugador_id', 'e.id')
            ->join('paises as f', 'e.pais_id', '=', 'f.id')
            ->select('a.id', 'd.nombre as tipo', 'b.nombre as local', 'c.nombre as visita', DB::raw('count(e.pais_id) as goles'), 'f.nombre')
            ->groupBy('d.nombre', 'b.nombre', 'c.nombre', 'e.pais_id', 'a.id')
            ->havingRaw('d.nombre = "GOL" and a.id = ' . $partido->id . '')
            ->get();

            if(count($query)==0) {
                $local = Pais::findOrFail($partido->local_pais_id);
                $visita = Pais::findOrFail($partido->visita_pais_id);
                
                array_push($goles_partidos, [
                    "local" => $local->nombre,
                    "visita" => $visita->nombre,
                    "goles_local" => 0,
                    "goles_visita" => 0,
                    "puntos_local" => 1,
                    "puntos_visita" => 1
                ]);
            } else if(count($query) == 1) {
                $item = $query->first();

                $goles_local = 0;
                $goles_visita = 0;
                $puntos_local = 0;
                $puntos_visita = 0;

                if($item->local == $item->nombre) {
                    $goles_local = $item->goles;
                }

                if($item->visita == $item->nombre) {
                    $goles_visita = $item->goles;
                }

                if($goles_local > $goles_visita) {
                    $puntos_local = 3;
                } else if($goles_local < $goles_visita) {
                    $puntos_visita = 3;
                } else if($goles_local == $goles_visita) {
                    $puntos_local = 1;
                    $puntos_visita = 1;
                }

                array_push($goles_partidos, [
                    "local" => $item->local,
                    "visita" => $item->visita,
                    "goles_local" => $goles_local,
                    "goles_visita" => $goles_visita,
                    "puntos_local" => $puntos_local,
                    "puntos_visita" => $puntos_visita
                ]);

            } else if(count($query) == 2) {
                $primero = $query[0];
                $segundo = $query[1];
                $goles_local = $primero->goles;
                $goles_visita = $segundo->goles;
                $puntos_local = 0;
                $puntos_visita = 0;

                if($goles_local > $goles_visita) {
                    $puntos_local = 3;
                } else if($goles_local < $goles_visita) {
                    $puntos_visita = 3;
                } else if($goles_local == $goles_visita) {
                    $puntos_local = 1;
                    $puntos_visita = 1;
                }

                array_push($goles_partidos, [
                    "local" => $primero->nombre,
                    "visita" => $segundo->nombre,
                    "goles_local" => $goles_local,
                    "goles_visita" => $goles_visita,
                    "puntos_local" => $puntos_local,
                    "puntos_visita" => $puntos_visita
                ]);
            }
        }

        for($i = 0; $i < 32; $i++) {
            $pais = Pais::findOrFail($i + 1);
            $puntos_pais = 0;

            for($j = 0; $j < count($goles_partidos); $j++) {
                if($pais->nombre == $goles_partidos[$j]['local']) {
                    $puntos_pais += $goles_partidos[$j]['puntos_local'];
                }

                if($pais->nombre == $goles_partidos[$j]['visita']) {
                    $puntos_pais += $goles_partidos[$j]['puntos_visita'];
                }
            }

            array_push($puntos, [
                "nombre" => $pais->nombre,
                "puntos" => $puntos_pais
            ]);
        }
        
        return $puntos;
    }

    public function tablaPosiciones() {
        $golesContra = $this->golesEnContra();
        $golesFavor = $this->golesFavor();
        $puntos = $this->puntosPorPais();

        //dd($golesFavor[0]["nombre"] . ' ' . $golesFavor[0]["cantidad"]);
        $tablas = [];

        for($i = 0; $i < 32; $i++) {
            array_push($tablas, [
                "nombre" => $golesContra[$i]["nombre"],
                "golesFavor" => $golesFavor[$i]["cantidad"],
                "golesContra" => $golesContra[$i]["cantidad"],
                "diferenciaGoles" => $golesFavor[$i]["cantidad"] - $golesContra[$i]["cantidad"],
                "puntos" => $puntos[$i]["puntos"]
            ]);
        }

        //dd($tablas);
        return $tablas;
    }

    public function ordenarTablas() {
        $tablas = $this->tablaPosiciones();

        for($k = 4; $k < 33; $k += 4) {
            $inicio_i = $k - 1;
            $fin_i = $inicio_i - 3;
            
            for($i = $inicio_i; $i > $fin_i; $i--) { 
                for($j = $fin_i; $j < $i; $j++) { 
                    if($tablas[$j]['puntos'] < $tablas[$j + 1]['puntos']) {
                        $temp = $tablas[$j + 1];
                        $tablas[$j + 1] = $tablas[$j];
                        $tablas[$j] = $temp;
                    }
                    if($tablas[$j]['puntos'] == $tablas[$j + 1]['puntos']) {
                        //$dif_local = $tablas[$j]['golesFavor'] - $tablas[$j]['golesContra'];
                        //$dif_visita = $tablas[$j + 1]['golesFavor'] - $tablas[$j]['golesContra'];
                        if($tablas[$j]['diferenciaGoles'] < $tablas[$j + 1]['diferenciaGoles']) {
                            $temp = $tablas[$j + 1];
                            $tablas[$j + 1] = $tablas[$j];
                            $tablas[$j] = $temp;
                        }
                    }
                }
            }
        }

        return response()->json($tablas);
    }
}
