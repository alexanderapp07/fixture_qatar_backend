<?php

namespace App\Http\Controllers;
use App\Models\Estadistica;
use App\Models\TipoEstadistica;
use App\Models\Jugador;
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
                        ->get();
        
        return response()->json([
            'status' => true, 
            'asistidores' => $asistidores
        ]);
    }
}
