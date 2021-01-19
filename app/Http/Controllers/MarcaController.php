<?php

namespace App\Http\Controllers;

use App\Models\Marca;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class MarcaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $marcas=Marca::orderBy('nombre')->paginate(4);
        return view('marcas.index', compact('marcas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('marcas.create');
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
            'nombre'=>['required'],
            'historia'=>['required'],
            'url'=>['nullable', 'url']
        ]);
        //---------------------------------
        $marca=New Marca();
        $marca->nombre=ucwords($request->nombre);
        $marca->historia=ucfirst($request->historia);

        if($request->has('url')) $marca->url=$request->url;

        //vamos con la imagen NO es un campo obligatorio
        //1.- comprbamos si la he subido
        if($request->has('logo')){
            //he subido una imagen
            //valido que sea un fichero de imagen
            $request->validate([
                'logo'=>['image']
            ]);
            //si es un fichero de imagen
            $fileImagen=$request->file('logo');
            $nombre="img/marcas/".uniqid()."_".$fileImagen->getClientOriginalName();
            //dd($nombre);
            Storage::Disk("public")->put($nombre, File::get($fileImagen));

            $marca->logo="storage/".$nombre;
        }
        $marca->save();
        return redirect()->route('marcas.index')->with('mensaje', "Marca Guardada.");

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Marca  $marca
     * @return \Illuminate\Http\Response
     */
    public function show(Marca $marca)
    {
        return view('marcas.show', compact('marca'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Marca  $marca
     * @return \Illuminate\Http\Response
     */
    public function edit(Marca $marca)
    {
        return view('marcas.edit', compact('marca'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Marca  $marca
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Marca $marca)
    {
        $request->validate([
            'nombre'=>['required'],
            'historia'=>['required'],
            'url'=>['nullable', 'url']
        ]);
        //---------------------------------
        $marca->update([
        'nombre'=>ucwords($request->nombre),
        'historia'=>ucfirst($request->historia),
        'url'=>$request->url
        ]);

        //vamos con la imagen NO es un campo obligatorio
        //1.- comprbamos si la he subido
        if($request->has('logo')){
            //he subido una imagen
            //valido que sea un fichero de imagen
            $request->validate([
                'logo'=>['image']
            ]);
            //si es un fichero de imagen
            $fileImagen=$request->file('logo');
            $nombre="img/marcas/".uniqid()."_".$fileImagen->getClientOriginalName();
            //si he subido una image borro la antigua siempre que no sea default
            if(basename($marca->logo)!="default.png"){
                unlink($marca->logo);
            }

            Storage::Disk("public")->put($nombre, \File::get($fileImagen));
            $marca->update(['logo'=>"storage/".$nombre]);
        }

        return redirect()->route('marcas.index')->with('mensaje', "Registro actualizado.");

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Marca  $marca
     * @return \Illuminate\Http\Response
     */
    public function destroy(Marca $marca)
    {
        $logoMarca=basename($marca->logo);
        //dd($marca->logo);

        if($logoMarca!='default.png'){
            unlink($marca->logo);
        }
        $marca->delete();
        return redirect()->route('marcas.index')->with("mensaje", "Marca Borrada correctamente.");
    }
}
