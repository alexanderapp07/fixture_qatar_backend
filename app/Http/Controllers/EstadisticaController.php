<?php

namespace App\Http\Controllers;
use App\Models\Estadistica;
use App\Models\TipoEstadistica;
use App\Models\Jugador;
use App\Models\Partido;
use Exception;
use Illuminate\Http\Request;

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
            $tEstadistica = TipoEstadistica::findOrFail($request->tipo_estadistica_id);
            $partido = Partido::findOrFail($request->partido_id);
            //$jugador = Jugador::findOrFail($request->jugador_id);
            $estadisticas->tipo_estadistica_id = $request->tipo_estadistica_id;
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
}
