<?php

namespace App\Http\Controllers\Api;

use App\Models\Place;
use App\Models\User;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use App\Models\File;
use App\Http\Controllers\Controller;
use App\Http\Controllers\api\Places;

use Illuminate\Http\Request;

class PlaceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json([
            'success' => true,
            'data'    => Place::all()
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
            'upload' => 'required|mimes:gif,jpeg,jpg,png|max:2048'
        ]);
        // Desar fitxer al disc i inserir dades a BD
        $upload = $request->file('upload');
        $file = new File();
        $ok = $file->diskSave($upload);

        if ($ok) {
            return response()->json([
                'success' => true,
                'data'    => $file
            ], 201);
        } else {
            return response()->json([
                'success'  => false,
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
        $file=File::find($id);
        if ($file){
            return response()->json([
                'success' => true,
                'data'    => $file
            ], 200);
         }else{
             return response()->json([
                 'success' => false,
                 'message'=> "not found"
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
        
        $file=File::find($id);
        if (empty ($file)) {
            return response()->json([
                'success'  => false,
                'message' => 'Error not found'
            ], 404);
        }
        // Validar fitxer
        $validatedData = $request->validate([
            'upload' => 'required|mimes:gif,jpeg,jpg,png|max:2048'
        ]);
        // Desar fitxer al disc i inserir dades a BD
        $upload = $request->file('upload');

        $ok = $file->diskSave($upload);

        if ($ok) {
            return response()->json([
                'success' => true,
                'data'    => $file
            ], 200);
        } else {
            return response()->json([
                'success'  => false,
                'message' => 'Error uploading file'
            ], 421);
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
        $place = Place::find($id);
        if (empty ($place)) {
            return response()->json([
                'success'  => false,
                'message' => 'not found'
            ], 404);
        }
        $ok =  $place->diskDelete();

        if ($ok) {
            return response()->json([
                'success' => true,
                'data'    => $place
            ], 200);
        } else {
            return response()->json([
                'success'  => false,
                'message' => 'Error deleting file'
            ], 500);
        }
    }
    public function update_post(Request $request, $id)
    {
        return $this->update($request, $id);
    }
    public function delete_post(Request $request, $id)
    {
        return $this->destroy($request, $id);
    }
    public function show_post(Request $request, $id)
    {
        return $this->show($request, $id);
    }
}
    