<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Resenas;
use App\Models\File;
use App\Models\Place;
use Illuminate\Support\Facades\Log;


class ResenasController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum')->only('store');
        $this->middleware('auth:sanctum')->only('destroy');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json([
            'success' => true,
            'data' => Resenas::all(),
        ], 200);
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
            'title' => 'required',
            'description' => 'required',
            'upload' => 'required|mimes:gif,jpeg,jpg,png,mp4|max:2048',
            'stars' => 'required',
            'place_id' => 'required',
        ]);

        // Obtenir dades del formulari
        $title = $request->get('title');
        $description = $request->get('description');
        $upload = $request->file('upload');
        $stars = $request->get('stars');
        $place_id =$request->get('place_id');
        // Desar fitxer al disc i inserir dades a BD
        $file = new File();
        $fileOk = $file->diskSave($upload);

        if ($fileOk) {
            // Desar dades a BD
            $resena = Resenas::create([
                'title' => $title,
                'description' => $description,
                'file_id' => $file->id,
                'stars' => $stars,
                'author_id' => auth()->user()->id,
                'place_id'=>$place_id,
            ]);
            // Patró PRG amb missatge d'èxit
            return response()->json([
                'success' => true,
                'data' => $resena
            ], 201);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Error uploading file'
            ], 421);
        }
    }
     /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $resena = Resenas::find($id);
        Log::debug($id);
        Log::debug($resena);
        if ($resena) {
            return response()->json([
                'success' => true,
                'data' => $resena
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => "not found"
            ], 404);
        }

    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $resena = Resenas::find($id);
        if (empty($resena)) {
            return response()->json([
                'success' => false,
                'message' => 'not found'
            ], 404);
        }
        if ($resena) {
            // Eliminar place de BD
            $resena->delete();
            // Eliminar fitxer associat del disc i BD
            $resena->file->diskDelete();
            return response()->json([
                'success' => true,
                'data' => $resena
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Error deleting file'
            ], 500);
        }

    }

}