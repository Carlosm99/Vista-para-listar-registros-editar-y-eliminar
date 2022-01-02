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

       response()->json(['eventos'=>$eventos], 201,
            ["Content-Type"=>"application/json"]);

        return response()-> view('pages/events', compact('eventos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */

    public function create()
    {
        return view('pages.create');
    }

    public function store(Request $request)
    {

        //*****not usefull */
        // //Agregar un nuevo registro
        // if ($request->isJson()) {
        //     $nuevoEvt = new Event();
        //     $nuevoEvt->nombre = $request->input('nombre'); //
        //     $nuevoEvt->descripcion = $request->input('descripcion'); //"Concurso de programación anual del I.T. Chetumal";
        //     $nuevoEvt->save();

        //     return response()->json(['mensaje'=>'creación de evento exitoso'], 201);
        // }
        // else
        //     return response()->json(['mensaje'=>'Datos en formato incorrecto'], 404);
         //*****not usefull */
         
        $storeData = $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'required|string|max:255',
           
        ]);

        $evento = Event::create($storeData);
        
        // return response()->json(['mensaje'=>'creación de evento exitoso'], 201);
        return redirect()->route('events.index')->with('success', 'Evento actualizado con éxito');
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
    public function edit($id)
    {
        $eventos = Event::findOrFail($id);
        return view('pages/edit', compact('eventos'));
    }
    
    public function update(Request $request, $id)
    {
        $updateData = $request->validate([
            'nombre' => 'required|max:255',
            'descripcion' => 'required|max:255',
        ]);
        Event::whereId($id)->update($updateData);
        return redirect()->route('events.index')->with('success', 'Evento actualizado con éxito');
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
        return redirect('/events')->with('completed', 'Student has been deleted');   
    }
}
