<?php

namespace App\Http\Controllers;


use App\Models\Partido;
use App\Models\Pais;
use App\Models\Estadio;
use App\Models\Estadistica;
use App\Models\Arbitro;
use Illuminate\Http\Request;

class PartidoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $partidos = Partido::all();

        return response()->json([
            'status' => true, 
            'partidos' => $partidos
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    /*public function create($request)
    {   
        $partidos= new Partido();
        try{
            $pais = Pais::findOrFail($request->pais_id);
            $estadio = Estadio::findOrFail($request->estadio_id);
            $arbitro = Jugador::findOrFail($request->arbitro_id);

            return response()->json([
                'status' => true, 
                'partidos' => 'existe'
            ]);

        }catch(Exception $e){
            return response()->json([
                'status' => false, 
                'partidos' => $e
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
        $partidos = new Partido();
        try{
            $pais = Pais::findOrFail($request->pais_id);
            $estadio = Estadio::findOrFail($request->estadio_id);
            //$arbitro = Arbitro::findOrFail($request->arbitro_id);
            $partidos->fecha = $request->fecha;
            $partidos->hora = $request->hora;
            $partidos->local_id = $request->pais_id;
            $partidos->visita_id = $request->pais_id;
            $partidos->estadio_id = $request->estadio_id;
            $partidos->arbitro_id = $request->arbitro_id;
            $partidos->save();
            return response()->json([
                'status' => true, 
                'partidos' => 'guardado con exito'
            ]);

        }catch(Exception $e){
            return response()->json([
                'status' => false, 
                'partidos' => 'No existe'
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
        $partidos = Partido::findOrFail($id);

        return response()->json([
            'status' => true, 
            'partidos' => $partidos
        ]);
    }


//
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
