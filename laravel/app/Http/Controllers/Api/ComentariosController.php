<?php

namespace App\Http\Controllers\Api;

use App\Models\Post;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use App\Models\File;
use App\Models\Comentarios;
use App\Models\Likes;
use App\Models\User;
class ComentariosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    { return response()->json([
        'success' => true,
        'data' => Comentarios::all(),
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
        // Validar fitxer
        $validatedData = $request->validate([
            'body' => 'required',
        ]);

        // Obtenir dades del fitxer
        $body = $request->get('body');
        $author_id = $request->get('author_id');


        if (\Storage::disk('public')->exists($body)) {
            \Log::debug("Local storage OK");
            $fullPath = \Storage::disk('public')->path($body);
            \Log::debug("File saved at {$fullPath}");
            // Desar dades a BD

            $comentarios = Comentarios::create([
                'body' => $body,
                'author_id' => auth()->user()->id,
            ]);

            \Log::debug("DB storage OK");
            // Patró PRG amb missatge d'èxit
            return response()->json([
                'success' => true,
                'data' => $comentarios
            ], 201);
        } else {
            \Log::debug("Local storage FAILS");
            // Patró PRG amb missatge d'error
            return response()->json([
                'success' => false,
                'message' => 'Error creating post'
            ], 500);
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

        $comentarios = Comentarios::find($id);
        if ($comentarios) {
            if ($id) {
                return response()->json([
                    'success' => true,
                    'data' => $comentarios,
                ], 200);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => "comentarios doesen't exist",
                ], 500);
            }
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Error'
            ], 404);
        }
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
        // Validar fitxer
        $comentarios = Comentarios::find($id);
        if ($comentarios) {
            $file = File::find($comentarios->file_id);
            $validatedData = $request->validate([
                'body' => 'required'
            ]);

            // Obtenir dades del fitxer
            $body = $request->get('body');
            \Log::debug("Storing file '{$body}'");

            // Pujar fitxer al disc dur
            $uploadName = time() . '_' . $body;
            $filePath = $body->storeAs(
                'uploads',
                // Path
                $uploadName,
                // Filename
                'public' // Disk
            );

            if (\Storage::disk('public')->exists($body)) {
                \Log::debug("Local storage OK");
                $fullPath = \Storage::disk('public')->path($body);
                \Log::debug("File saved at {$fullPath}");
                // Desar dades a BD

                $file->filepath = $filePath;
                $file->save();
                \Log::debug("DB storage OK");
                $comentarios->body = $request->input('body');;
                $comentarios->save();
                // Patró PRG amb missatge d'èxit
                return response()->json([
                    'success' => true,
                    'data' => $comentarios
                ], 200);
            } else {
                \Log::debug("Local storage FAILS");
                // Patró PRG amb missatge d'error
                return response()->json([
                    'success' => false,
                    'message' => 'Error updating file'
                ], 421);
            }
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Error'
            ], 404);
        }
    }
    public function destroy($id)
    {
        $comentarios = Comentarios::find($id);

        if ($comentarios) {
            $comentarios->delete();
            return response()->json([
                'success' => true,
                'data' => $comentarios
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Error'
            ], 404);
        }
    }
    public function update_workaround(Request $request, $id)
    {
        return $this->update($request, $id);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

}
