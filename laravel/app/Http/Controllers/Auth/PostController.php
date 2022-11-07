<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\File;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("post.index", [
            "post" => Post::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("post.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
public function store(Request $request)
    {
        //Validar fichero
        $validatedData = $request->validate([
            'upload' => 'required|mimes:gif,jpeg,jpg,mp4,png|max:1024',
            'body' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
            'visibility_id' => 'required',
        ]);

        //Obtener datos
        $upload = $request->file('upload');
        $fileName = $upload->getClientOriginalName();
        $fileSize = $upload->getSize();
        $body = $request->get('body');
        $latitude = $request->get('latitude');
        $longitude = $request->get('longitude');
        $visibility_id = $request->get('visibility_id');
        \Log::debug("Storing file '{$fileName}' ($fileSize)...");

        //Subir archivo
        $uploadName = time() . '_' . $fileName;
        $filePath = $upload->storeAs(
            'uploads',
            $uploadName,
            'public'
        );

        if (\Storage::disk('public')->exists($filePath)){
            \Log::debug("Local storage OK");
            $fullPath = \Storage::disk('public')->path($filePath);
            \Log::debug("File saved at {$fullPath}");
        

            //Guardar datos en la BD

            $file = File::create([
                'filepath' => $filePath,
                'filesize' => $fileSize,
            ]);

            $post = Post::create([
                'body' => $body,
                'file_id' => $file->id,
                'latitude' => $latitude,
                'longitude' => $longitude,
                'visibility_id' => $visibility_id,
                'author_id' => auth()->user()->id,
            ]);

            \Log::debug("DB storage OK");

            return redirect()->route('post.show', $post)
                ->with('success', 'File successfully saved');

        } else {
            \Log::debug("Local storage FAILS");

            return redirect()->route("post.create")
                ->with('error', 'ERROR uploading file');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view("post.show", [
            "post" => $post
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view("post.edit", [
            "post" => $post
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        //
    }
}
