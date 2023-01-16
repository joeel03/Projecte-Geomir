<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comentarios;
use App\Models\File;
use App\Models\Post;
use Illuminate\Support\Facades\Log;
class ComentariosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("comentarios.index",[
            "comentarios" => Comentarios::all()]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("comentarios.create");
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
            'body'      => 'required'
        ]);
        
        // Obtenir dades del formulari
        $body = $request->get('body');
        $upload = $request->file('upload');

        // Desar fitxer al disc i inserir dades a BD
        $file = new File();
        $fileOk = $file->diskSave($upload);

        if ($fileOk) {
            // Desar dades a BD
            Log::debug("Saving post at DB...");
            $comentarios = Comentarios::create([
                'body'      => $body,
                'file_id'   => $file->id,
                'author_id' => auth()->user()->id,
            ]);
            Log::debug("DB storage OK");
            // Patró PRG amb missatge d'èxit
            return redirect()->route('comentarios.show', $comentarios)
                ->with('success', __('Coment successfully saved'));
        } else {
            // Patró PRG amb missatge d'error
            return redirect()->route("comentarios.create")
                ->with('error', __('ERROR Uploading file'));
        }
    }
        /**
     * Display the specified resource.
     *
     * @param  \App\Models\Comentarios  $comentarios
     * @return \Illuminate\Http\Response
     */
    public function show(Comentarios $comentarios)
    {
        return view("comentarios.show", [
            'comentarios'   => $comentarios,
            'author' => $comentarios->user,
        ]);
    }
        /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Comentarios $comentarios)
    {
        return view("comentarios.edit", [
            'comentarios'   => $comentarios,
            'author' => $comentarios->user,
        ]);
    }
        /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Comentarios  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comentarios $comentarios)
    {
        // Validar dades del formulari
        $validatedData = $request->validate([
            'body'      => 'required',
        ]);

        // Obtenir dades del formulari
        $body      = $request->get('body');
        $upload    = $request->file('upload');

        // Desar fitxer (opcional)
        if (is_null($upload) || $comentarios->file->diskSave($upload)) {
            // Actualitzar dades a BD
            Log::debug("Updating DB...");
            $comentarios->body      = $body;
            $comentarios->save();
            Log::debug("DB storage OK");
            // Patró PRG amb missatge d'èxit
            return redirect()->route('comentarios.show', $comentarios)
                ->with('success', __('Coments successfully saved'));
        } else {
            // Patró PRG amb missatge d'error
            return redirect()->route("comentarios.edit")
                ->with('error', __('ERROR Uploading file'));
        }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Comentarios  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comentarios $comentarios)
    {
        // Eliminar post de BD
        $comentarios->delete();
        // Eliminar fitxer associat del disc i BD
        $comentarios->file->diskDelete();
        // Patró PRG amb missatge d'èxit
        return redirect()->route("comentarios.index")
            ->with('success', __('Coments successfully deleted'));
    }
}
