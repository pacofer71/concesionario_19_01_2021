<?php

namespace App\Http\Controllers;

use App\Models\Coche;
use App\Models\Marca;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class CocheController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $marcas=Marca::orderBy('nombre')->get();
        $miMarca=$request->get('marca_id');
        $kilos=$request->kilometros;
        $coches=Coche::orderBy('marca_id')->orderBy('modelo')->marca_id($miMarca)->kilometros($kilos)->paginate(3);
        return view('coches.index', compact('coches', 'marcas', 'request'));
    }
    public function index1(Marca $marca){
        if($marca!=null){
            $coches=Coche::orderBy('modelo')->marca_id($marca->id)->paginate(3);
        }
        else{
            $coches=Coche::orderBy("marca_id")->paginate(3);
        }
        return view('coches.index', compact('coches'));

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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Coche  $coche
     * @return \Illuminate\Http\Response
     */
    public function show(Coche $coche)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Coche  $coche
     * @return \Illuminate\Http\Response
     */
    public function edit(Coche $coche)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Coche  $coche
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Coche $coche)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Coche  $coche
     * @return \Illuminate\Http\Response
     */
    public function destroy(Coche $coche)
    {
        //
    }
    public function cochesxmarca(Marca $marca){
        $coches=Coche::orderBy('modelo')->marca_id($marca->id)->paginate(3);
        return view('coches.cochesxmarca', compact('coches'));
    }
}
