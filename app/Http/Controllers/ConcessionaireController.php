<?php

namespace App\Http\Controllers;

use App\Concessionaire;
use Illuminate\Http\Request;

class ConcessionaireController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $concessionaire = Concessionaire::with('clients')->get()->toArray();
        return response()->json(array_reverse($concessionaire));
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
        $request->validate([
            'name' => 'required',
            'state' => 'required',
            'city' => 'required',
        ]);

        $concessionaire = new Concessionaire($request->all());
        $concessionaire->save();

        $newConcessionaire = Concessionaire::with('clients')->where('id', $concessionaire->id)->get()->first()->toArray();

        return response()->json(['concessionaire' => $newConcessionaire, 'message' => 'El concesionario se guardo exitosamente']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Concessionaire  $concessionaire
     * @return \Illuminate\Http\Response
     */
    public function show($concessionaire)
    {
        $concessionaire = Concessionaire::find($concessionaire);

        return response()->json($concessionaire);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Concessionaire  $concessionaire
     * @return \Illuminate\Http\Response
     */
    public function edit(Concessionaire $concessionaire)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Concessionaire  $concessionaire
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $concessionaire)
    {
        $request->validate([
            'name' => 'required',
            'state' => 'required',
            'city' => 'required',
        ]);

        $concessionaire = Concessionaire::find($concessionaire);
        $concessionaire->update($request->all());

        $ConcessionaireEdit = Concessionaire::with('clients')->where('id', $concessionaire->id)->get()->first()->toArray();

        return response()->json(['concessionaire' => $ConcessionaireEdit, 'message' => 'El concesionario se actualizo correctamente']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Concessionaire  $concessionaire
     * @return \Illuminate\Http\Response
     */
    public function destroy($concessionaire)
    {
        $concessionaire = Concessionaire::find($concessionaire);
        $concessionaire->delete();

        return response()->json('El concesionario se elimino correctamente');
    }
}
