<?php

namespace App\Http\Controllers;

use App\Models\Place;
use App\Models\File;
use Illuminate\Http\Request;

class PlacesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("places.index", [
            "places" => Place::all()
        ]);
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("places.create");

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
            'upload' => 'required|mimes:gif,jpeg,jpg,png|max:1024'
        ]);
       
        // Obtenir dades del fitxer
        $upload = $request->file('upload');
        $fileName = $upload->getClientOriginalName();
        $fileSize = $upload->getSize();
        \Log::debug("Storing file '{$fileName}' ($fileSize)...");
  
        // Pujar fitxer al disc dur
        $uploadName = time() . '_' . $fileName;
        $filePath = $upload->storeAs(
            'uploads',      // Path
            $uploadName ,   // Filename
            'public'        // Disk
        );
       
        if (\Storage::disk('public')->exists($filePath)) {
            \Log::debug("Local storage OK");
            $fullPath = \Storage::disk('public')->path($filePath);
            \Log::debug("File saved at {$fullPath}");
            // Desar dades a BD
            $file = File::create([
                'filepath' => $filePath,
                'filesize' => $fileSize,
            ]);
            \Log::debug("DB storage OK");
            $place = Place::create([
                'name' => $request->input('name'),
                'description' => $request->input('description'),
                'file_id' => $file->id,
                'latitude' => $request->input('latitude'),
                'longitude' => $request->input('longitude'),
                'category_id' => $request->input('category_id'),
                'visibility_id' => $request->input('visibility_id'),
                'author_id' => auth()->user()->id,
    
            ]);
            // Patró PRG amb missatge d'èxit
            return redirect()->route('places.show', $place)
                ->with('success', 'Place successfully saved');
        } else {
            \Log::debug("Local storage FAILS");
            // Patró PRG amb missatge d'error
            return redirect()->route("places.create")
                ->with('error', 'ERROR uploading file');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\File  $file
     * @return \Illuminate\Http\Response
     */
    public function show(Place $place)
    {
        $file=File::find($place->file_id);
        return view("places.show", [
            "place" => $place,
            "file" => $file
        ]);
    
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\File  $file
     * @return \Illuminate\Http\Response
     */
    public function edit(File $file)
    {
        return view("places.edit", [
            "file" => $file
        ]); 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\File  $file
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, File $file)
    {// Validar fitxer
        $validatedData = $request->validate([
            'upload' => 'required|mimes:gif,jpeg,jpg,png|max:1024'
        ]);
       
        // Obtenir dades del fitxer
        $upload = $request->file('upload');
        $fileName = $upload->getClientOriginalName();
        $fileSize = $upload->getSize();
        \Log::debug("Storing file '{$fileName}' ($fileSize)...");
  
        // Pujar fitxer al disc dur
        $uploadName = time() . '_' . $fileName;
        $filePath = $upload->storeAs(
            'uploads',      // Path
            $uploadName ,   // Filename
            'public'        // Disk
        );
       
        if (\Storage::disk('public')->exists($filePath)) {
            \Storage::disk('public')->delete($file->filepath);  
            \Log::debug("Local storage OK");
            $fullPath = \Storage::disk('public')->path($filePath);
            \Log::debug("File saved at {$fullPath}");
            $file->filesize=$fileSize;
            $file->filepath=$filePath;
            $file->save();
            // Desar dades a BD
            $file = File::create([
                'filepath' => $filePath,
                'filesize' => $fileSize,
            ]);
            \Log::debug("DB storage OK");
            $place = Place::create([
                'name' => $request->input('name'),
                'description' => $request->input('description'),
                'file_id' => $file->id,
                'latitude' => $request->input('latitude'),
                'longitude' => $request->input('longitude'),
                'category_id' => $request->input('category_id'),
                'visibility_id' => $request->input('visibility_id'),
                'author_id' => auth()->user()->id,
    
            ]);
            // Patró PRG amb missatge d'èxit
            return redirect()->route('places.show', $place)
                ->with('success', 'Place successfully saved');
        } else {
            \Log::debug("Local storage FAILS");
            // Patró PRG amb missatge d'error
            return redirect()->route("places.create")
                ->with('error', 'ERROR uploading file');
        }
            
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\File  $file
     * @return \Illuminate\Http\Response
     */
    public function destroy(File $file)
    {
        $file=File::find($place->file_id);
        if (\Storage::disk('public')->exists($file->file_id->filepath)){
            \Storage::disk('public')->delete($file->file_id->filepath);           
            File::destroy($file->id);
                
            return redirect()->route("places.index", ["places" => File::all()])
            ->with('alert', 'eliminado');
     
        }else{
            \Log::debug("Local storage FAILS");
            // Patró PRG amb missatge d'error
            return redirect()->route("files.index")
                ->with('error', 'ERROR uploading file');

        }
    }
}
