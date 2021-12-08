<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $eventos = Event::all();

        return response()->json(['eventos'=>$eventos], 201,
            ["Content-Type"=>"application/json"]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        //Agregar un nuevo registro
        if ($request->isJson()) {
            $nuevoEvt = new Event();
            $nuevoEvt->nombre = $request->input('nombre'); //
            $nuevoEvt->descripcion = $request->input('descripcion'); //"Concurso de programación anual del I.T. Chetumal";
            $nuevoEvt->save();

            return response()->json(['mensaje'=>'creación de evento exitoso'], 201);
        }
        else
            return response()->json(['mensaje'=>'Datos en formato incorrecto'], 404);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        //$ev = Event::find($id);
        //bring 
        if (isset($id)) {
            $ev = DB::table('events')->find($id);
            return response()->json(['evento'=>$ev]);
        }
        else {
            return response()->json(['mensaje'=>'No se encontró el evento']);

        }
     
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        //Actualizar un registro
        if ($request->isJson()) {
            $ev = Event::find($id);
            $ev->nombre = $request->input('nombre');
            $ev->descripcion = $request->input('descripcion');
            $ev->save();

            return response()->json(['mensaje'=>'actualización de evento exitoso'], 201);
        }
        else
            return response()->json(['mensaje'=>'Datos en formato incorrecto'], 404);
        // return response()->json(['mensaje'=>'Llamaste a Update'], 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // us destroy to delete an id
        $ev = Event::find($id);
        $ev->delete();
        return response()->json(['mensaje'=>'Evento eliminado'], 201);        
    }
}
