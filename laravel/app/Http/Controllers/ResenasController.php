<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Resenas;
use App\Models\File;


class ResenasController extends Controller
{
    /**
     * Display a listing of the resource.
     
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("resenas.index",[
        "resenas" => Resenas::all(),
        "files" => File::all()]
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("resenas.create");

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
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
            Log::debug("Saving resena at DB...");
            $resena = Resenas::create([
                'title'        => $title,
                'description' => $description,
                'file_id'     => $file->id,
                'stars'       => $stars,
                'author_id'   => auth()->user()->id,
            ]);
            Log::debug("DB storage OK");
            // Patró PRG amb missatge d'èxit
            return redirect()->route('resenas.show', $resena)
                ->with('success', __('resena successfully saved'));
        } else {
            Log::debug("Disk storage FAILS");
            // Patró PRG amb missatge d'error
            return redirect()->route("resenas.create")
                ->with('error', __('ERROR Uploading file'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Resenas $resena)
    {
        return view("resenas.show", [
            'resena'  => $resena,
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
    public function destroy(Resenas $resena)
    {
        // Eliminar place de BD
        $resena->delete();
        // Eliminar fitxer associat del disc i BD
        $resena->file->diskDelete();
        // Patró PRG amb missatge d'èxit
        return redirect()->route("resenas.index")
            ->with('success', 'Resena successfully deleted');
    }
}
