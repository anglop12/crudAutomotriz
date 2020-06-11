<?php

namespace App\Http\Controllers;

use App\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clients = Client::with('concessionaire')->get()->toArray();
        return response()->json(array_reverse($clients));
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
            'lastname' => 'required',
            'age' => 'required',
            'concessionaire_id' => 'required',
        ]);

        $client = new Client($request->all());
        $client->save();

        $newClient = Client::with('concessionaire')->where('id', $client->id)->get()->first()->toArray();

        return response()->json(['client' => $newClient, 'message' => 'El cliente se guardo exitosamente']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function show($client)
    {
        $client = Client::find($client);

        return response()->json($client);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function edit($client)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $client)
    {
        $request->validate([
            'name' => 'required',
            'lastname' => 'required',
            'age' => 'required',
            'concessionaire_id' => 'required',
        ]);

        $client = Client::find($client);
        $client->update($request->all());
        
        $ClientEdit = Client::with('concessionaire')->where('id', $client->id)->get()->first()->toArray();

        return response()->json(['client' => $ClientEdit, 'message' => 'El cliente se actualizo correctamente']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function destroy($client)
    {
        $client = Client::find($client);
        $client->delete();

        return response()->json('El cliente se elimino correctamente');
    }
}
