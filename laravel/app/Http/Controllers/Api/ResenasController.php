<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Resenas;
use App\Models\File;


class ResenasController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum')->only('store');
        $this->middleware('auth:sanctum')->only('destroy');
    }
    public function index()
    {
        return response()->json([
            'success' => true,
            'data' => Resenas::all()
        ], 200);
    }

    public function store(Request $request)
    {
        // Validar dades del formulari
        $validatedData = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'upload' => 'required|mimes:gif,jpeg,jpg,png,mp4|max:2048',
            'stars' => 'required',
        ]);

        // Obtenir dades del formulari
        $title = $request->get('title');
        $description = $request->get('description');
        $upload = $request->file('upload');
        $stars = $request->get('stars');

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
    public function show($id)
    {
        $resena = Resenas::find($id);
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