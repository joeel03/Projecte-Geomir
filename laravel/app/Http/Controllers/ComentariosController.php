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
    public function index(Post $post) 
    {
        return view("comentarios.index",[
            "comentarios" => Comentarios::where('post_id',$post->id)->get(),
            "post" => $post]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Post $post)
    {
        return view("comentarios.create",[
            "post"=>$post,
        ]);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Post $post)
    {
        // Validar dades del formulari
        $validatedData = $request->validate([
            'body'      => 'required',
        ]);
        
        // Obtenir dades del formulari
        $body = $request->get('body');
        $post_id = $post->id;
        
        if ($body) {
            // Desar dades a BD
            Log::debug("Saving post at DB...");
            $comentarios = Comentarios::create([
                'body'      => $body,
                'post_id' => $post_id,
                'author_id' => auth()->user()->id,
            ]);
            Log::debug("DB storage OK");
            // Patró PRG amb missatge d'èxit
            return redirect()->route('posts.comentarios.show',[$post, $comentarios])
                ->with('success', __('Coment successfully saved'));
        } else {
            // Patró PRG amb missatge d'error
            return redirect()->route("posts.comentarios.create")
                ->with('error', __('ERROR Uploading file'));
        }
    }
        /**
     * Display the specified resource.
     *
     * @param  \App\Models\Comentarios  $comentario
     * @param  \App\Models\Post  $post

     * @return \Illuminate\Http\Response
     */
    public function show(Post $post, Comentarios $comentario )
    {
        return view("comentarios.show", ['post'=>$post,'comentario'=> $comentario]);
    }
        /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Comentarios $comentarios)
    {
        //
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
        //
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post, Comentarios $comentario )
    {
        if($comentario->author_id==auth()->id()){
            // Eliminar place de BD
            $comentario->delete();
            // Eliminar fitxer associat del disc i BD
            // Patró PRG amb missatge d'èxit
            return redirect()->route("posts.comentarios.index",$post)
                ->with('success', 'Coment successfully deleted');
        }else{
            return redirect()->route("posts.comentarios.show",[$post,$comentario])
            ->with('error', __('No eres el propietario del comentario'));
        }    
    }
}
