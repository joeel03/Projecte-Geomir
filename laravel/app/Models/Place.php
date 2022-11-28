<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Place extends Model
{
    use \Backpack\CRUD\app\Models\Traits\CrudTrait;
    use HasFactory;
    
    protected $fillable = [
        'name',
        'description',
        'file_id',
        'latitude',
        'longitude',
        'author_id',
    ];

    public function file()
    {
        return $this->belongsTo(File::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'author_id');
    }
    public function author()
    {
        return $this->belongsTo(User::class);
    }
    public function favorited()
    {
       return $this->belongsToMany(User::class, 'favorites');
    }
    public function comprovarfavorite(){
        $id_place= $this->id;
        $id_user = auth()->user()->id;
        $select = "SELECT id FROM favorites WHERE id_place = $id_place and id_user = $id_user";
        $id_favorite = DB::select($select);
        return empty($id_favorite);
    }
    
}
