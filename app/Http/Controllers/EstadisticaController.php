<?php

namespace App\Http\Controllers;
use App\Models\Estadistica;
use App\Models\TipoEstadistica;
use App\Models\Jugador;
use App\Models\Pais;
use App\Models\Partido;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EstadisticaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $estadisticas = Estadistica::all();

        return response()->json([
            'status' => true, 
            'estadisticas' => $estadisticas
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    /*public function create($request)
    {   
        $estadisticas = new Estadistica();
        try{
            $tEstadistica = TipoEstadistica::findOrFail($request->tipo_estadistica_id);
            $partido = Partido::findOrFail($request->partido_id);
            $jugador = Jugador::findOrFail($request->jagador_id);

            return response()->json([
                'status' => true, 
                'estadisticas' => 'existe'
            ]);

        }catch(Exception $e){
            return response()->json([
                'status' => false, 
                'estadisticas' => $e
            ]);
        }
    }*/

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $estadisticas = new Estadistica();
        try{
            $partido = Partido::findOrFail($request->partido_id);
            //$jugador = Jugador::findOrFail($request->jugador_id);
            $estadisticas->nombre = $request->nombre;
            $estadisticas->partido_id = $request->partido_id;
            $estadisticas->jugador_id = $request->jugador_id;
            $estadisticas->save();
            return response()->json([
                'status' => true, 
                'estadisticas' => 'guardado con exito'
            ]);

        }catch(Exception $e){
            return response()->json([
                'status' => false, 
                'estadisticas' => 'No existe'
            ]);
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
        $estadisticas = Estadistica::findOrFail($id);

        return response()->json([
            'status' => true, 
            'estadisticas' => $estadisticas
        ]);
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
    }

    public function maximosGoleadores() {
        /*
        select j.nombre, j.apellido, p.nombre, e.nombre, count(e.nombre) cantidad from qatar.jugadores j
        inner join qatar.paises p
        inner join qatar.estadisticas e
        on j.pais_id = p.id and e.jugador_id = j.id
        group by j.nombre, j.apellido, p.nombre, e.nombre
        having e.nombre = 'GOL'
        order by cantidad desc;
        */
        $goleadores = DB::table('jugadores as j')
                        ->join('paises as p', 'j.pais_id', '=', 'p.id')
                        ->join('estadisticas as e', 'e.jugador_id', '=', 'j.id')
                        ->select('j.nombre', 'j.apellido', 'p.nombre as pais', 'e.nombre as tipo', DB::raw('count(e.nombre) as cantidad'))
                        ->groupBy('j.nombre', 'j.apellido', 'p.nombre', 'e.nombre')
                        ->having('e.nombre', '=', 'GOL')
                        ->orderBy('cantidad', 'desc')
                        ->take(5)
                        ->get();
        
        return response()->json([
            'status' => true, 
            'goleadores' => $goleadores
        ]);
    }

    public function maximosAsistidores() {
        $asistidores = DB::table('jugadores as j')
                        ->join('paises as p', 'j.pais_id', '=', 'p.id')
                        ->join('estadisticas as e', 'e.jugador_id', '=', 'j.id')
                        ->select('j.nombre', 'j.apellido', 'p.nombre as pais', 'e.nombre as tipo', DB::raw('count(e.nombre) as cantidad'))
                        ->groupBy('j.nombre', 'j.apellido', 'p.nombre', 'e.nombre')
                        ->having('e.nombre', '=', 'ASISTENCIA')
                        ->orderBy('cantidad', 'desc')
                        ->take(5)
                        ->get();
        
        return response()->json([
            'status' => true, 
            'asistidores' => $asistidores
        ]);
    }

    public function resultados() {
        $goles_partidos = [];

        for($i = 0; $i < 32; $i++) { // $i < 48
            $partido = Partido::findOrFail($i + 1);

            $query = DB::table('partidos as a')
            ->join('paises as b', 'a.local_pais_id', '=', 'b.id')
            ->join('paises as c', 'a.visita_pais_id', '=', 'c.id')
            ->join('estadisticas as d', 'a.id', '=', 'd.partido_id')
            ->join('jugadores as e', 'd.jugador_id', 'e.id')
            ->join('paises as f', 'e.pais_id', '=', 'f.id')
            ->select('a.fecha', 'a.hora', 'a.id', 'd.nombre as tipo', 'b.nombre as local', 'c.nombre as visita', DB::raw('count(e.pais_id) as goles'), 'f.nombre')
            ->groupBy('d.nombre', 'b.nombre', 'c.nombre', 'e.pais_id', 'a.id', 'a.fecha', 'a.hora')
            ->havingRaw('d.nombre = "GOL" and a.id = ' . $partido->id . '')
            ->orderByRaw('a.fecha desc, a.hora desc')
            ->get();

            if(count($query)==0) {
                $local = Pais::findOrFail($partido->local_pais_id);
                $visita = Pais::findOrFail($partido->visita_pais_id);
                $partido = DB::table('partidos as p')
                            ->select('p.fecha', 'p.hora')
                            ->whereRaw('local_pais_id = ' . $local->id . ' and visita_pais_id = ' . $visita->id)
                            ->get();
                
                array_push($goles_partidos, [
                    "local" => $local->nombre,
                    "visita" => $visita->nombre,
                    "goles_local" => 0,
                    "goles_visita" => 0,
                    "fecha" => $partido[0]->fecha,
                    "hora" => $partido[0]->hora
                    //"puntos_local" => 1,
                    //"puntos_visita" => 1
                ]);
            } else if(count($query) == 1) {
                $item = $query->first();

                $goles_local = 0;
                $goles_visita = 0;
                $puntos_local = 0;
                $puntos_visita = 0;

                /*if($item->local == $item->nombre) {
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
                }*/

                array_push($goles_partidos, [
                    "local" => $item->local,
                    "visita" => $item->visita,
                    "goles_local" => $goles_local,
                    "goles_visita" => $goles_visita,
                    "fecha" => $item->fecha,
                    "hora" => $item->hora
                    //"puntos_local" => $puntos_local,
                    //"puntos_visita" => $puntos_visita
                ]);

            } else if(count($query) == 2) {
                $primero = $query[0];
                $segundo = $query[1];
                $goles_local = $primero->goles;
                $goles_visita = $segundo->goles;
                $puntos_local = 0;
                $puntos_visita = 0;

                /*if($goles_local > $goles_visita) {
                    $puntos_local = 3;
                } else if($goles_local < $goles_visita) {
                    $puntos_visita = 3;
                } else if($goles_local == $goles_visita) {
                    $puntos_local = 1;
                    $puntos_visita = 1;
                }*/

                array_push($goles_partidos, [
                    "local" => $primero->nombre,
                    "visita" => $segundo->nombre,
                    "goles_local" => $goles_local,
                    "goles_visita" => $goles_visita,
                    "fecha" => $primero->fecha,
                    "hora" => $primero->hora
                    //"puntos_local" => $puntos_local,
                    //"puntos_visita" => $puntos_visita
                ]);
            }
        }

        return response()->json([
            'status' => true, 
            'resultados' => $goles_partidos
        ]);
    }
}
