<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Resenas;
use App\Models\File;
use App\Models\Place;



class ResenasController extends Controller
{
    /**
     * Display a listing of the resource.
     
     * @return \Illuminate\Http\Response
     */
    public function index(Place $place)
    {
        
        return view("resenas.index",[
        "resenas" => Resenas::all(),
        "files" => File::all(),
        "place"=>$place,
        ]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Place $place)
    {
        return view("resenas.create",[
            "place"=>$place,
        ]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Place $place)
    {
         // Validar dades del formulari
         $validatedData = $request->validate([
            'title'       => 'required',
            'description' => 'required',
            'upload'      => 'required|mimes:gif,jpeg,jpg,png,mp4|max:2048',
            'stars'       => 'required',
        ]);
        
        // Obtenir dades del formulari
        $title        = $request->get('title');
        $description = $request->get('description');
        $upload      = $request->file('upload');
        $stars    = $request->get('stars');

        // Desar fitxer al disc i inserir dades a BD
        $file = new File();
        $fileOk = $file->diskSave($upload);

        if ($fileOk) {
            // Desar dades a BD
            $resena = Resenas::create([
                'title'        => $title,
                'description' => $description,
                'file_id'     => $file->id,
                'stars'       => $stars,
                'author_id'   => auth()->user()->id,
                'place_id'    => $place->id,
            ]);
            // Patró PRG amb missatge d'èxit
            return redirect()->route('places.resenas.show', [$place, $resena])
                ->with('success', __('resena successfully saved'));
        } else {
            // Patró PRG amb missatge d'error
            return redirect()->route("places.resenas.create",$place)
                ->with('error', __('ERROR Uploading file'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Place $place,Resenas $resena)
    {
        $estrellas=$resena->stars;
        $id = auth()->id();
        return view("resenas.show", [
            'resena'  => $resena,
            "place"=>$place,
            'file'   => $resena->file,
            'author' => $resena->user,
            "estrellas"=>$estrellas,
            "id"=>$id,
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
    public function destroy(Place $place,Resenas $resena)
    {
        if($resena->author_id==auth()->id()){
            // Eliminar place de BD
            $resena->delete();
            // Eliminar fitxer associat del disc i BD
            $resena->file->diskDelete();
            // Patró PRG amb missatge d'èxit
            return redirect()->route("places.resenas.index",$place)
                ->with('success', 'Resena successfully deleted');
        }else{
            return redirect()->route("places.resenas.show",[$place,$resena])
            ->with('error', __('No ets el propietari de la reseña'));
        }
        
    }
}