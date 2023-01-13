<?php

namespace App\Http\Controllers\Api;

use App\Models\Place;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Models\File;
use App\Http\Controllers\Controller;
use App\Http\Controllers\api\Places;
use App\Models\Favorite;
use Illuminate\Support\Facades\DB;
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
            'name'        => 'required',
            'description' => 'required',
            'upload'      => 'required|mimes:gif,jpeg,jpg,png,mp4|max:2048',
            'latitude'    => 'required',
            'longitude'   => 'required',
        ]);
        // Desar fitxer al disc i inserir dades a BD
        $upload = $request->file('upload');
        $file = new File();
        $ok = $file->diskSave($upload);

        if ($ok) {
            $place = Place::create([
                'name'        => $request->get('name'),
                'description' => $request->get('description'),
                'file_id'     => $file->id,
                'latitude'    => $request->get('latitude'),
                'longitude'   => $request->get('longitude'),
                'author_id'   => auth()->user()->id,
            ]);
            return response()->json([
                'success' => true,
                'data'    => $place
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
        $place = Place::find($id);
        Log::debug($id);
        Log::debug($place);
        if ($place) {
            return response()->json([
                'success' => true,
                'data'    => $place
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => "not found"
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

       $place = Place::find($id);
        if (empty($place)) {
            return response()->json([
                'success'  => false,
                'message' => 'Error not found'
            ], 404);
        }
        // Validar fitxer
        $validatedData = $request->validate([
            'name'        => 'required',
            'description' => 'required',
            'upload'      => 'required|mimes:gif,jpeg,jpg,png,mp4|max:2048',
            'latitude'    => 'required',
            'longitude'   => 'required',
        ]);
        
        // Obtenir dades del formulari
        $name        = $request->get('name');
        $description = $request->get('description');
        $upload      = $request->file('upload');
        $latitude    = $request->get('latitude');
        $longitude   = $request->get('longitude');
        //desar bd
        $place->name        = $name;
        $place->description = $description;
        $place->latitude    = $latitude;
        $place->longitude   = $longitude;
        $place->save();
        // Update file
        $file=File::find($place->file_id);
        $ok = $file->diskSave($upload);

        if ($ok) {
            return response()->json([
                'success' => true,
                'data'    => $place
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
        if (empty($place)) {
            return response()->json([
                'success'  => false,
                'message' => 'not found'
            ], 404);
        }

        //$ok =  $place->file()->diskDelete();

        if ($place) {
            $place->delete();
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
    public function favorite(Place $place){
        $favorite=Favorite::create([
            'id_user'=>auth()->user()->id,
            'id_place'=>$place->id,
        ]);
        return redirect()->back();
        
    }
    public function unfavorite(Place $place)
    {
        DB::table('favorites')->where(['id_user'=>Auth::id(),'id_place'=>$place->id])->delete();
        return redirect()->back();
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
