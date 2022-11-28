<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Perfil;

class PerfilController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $perfiles = Perfil::all();

        return response()->json([
            'status' => true,
            'perfiles' => $perfiles
        ]);
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $perfil = new Perfil;

        $perfil->campeon_pais_id = $request->campeon_pais_id;
        $perfil->informacion = $request->informacion;
        $perfil->usuario_id = $request->usuario_id;
        $perfil->save();

        $perfil->favoritos()->sync($request->favoritos);

        return response()->json([
            'status' => true,
            'message' => 'Perfil creado exitosamente',
            'perfil' => $perfil
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        $perfil = Perfil::findOrFail($id);

        $perfil->campeon_pais_id = $request->campeon_pais_id;
        $perfil->informacion = $request->informacion;
        $perfil->usuario_id = $request->usuario_id;
        $perfil->favoritos()->sync($request->favoritos);
        $perfil->save();

        return response()->json([
            'status' => true,
            'message' => 'Perfil actualizado exitosamente',
            'perfil' => $perfil
        ], 200);
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
