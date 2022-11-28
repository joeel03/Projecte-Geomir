<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Post extends Model
{
    use \Backpack\CRUD\app\Models\Traits\CrudTrait;
    use HasFactory;

    protected $fillable = [
        'body',
        'file_id',
        'latitude',
        'longitude',
        'author_id'
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
   public function liked()
   {
      return $this->belongsToMany(User::class, 'likes');
   }
   public function comprovarlike(){
    $id_post= $this->id;
    $id_user = auth()->user()->id;
    $select = "SELECT id FROM likes WHERE id_post = $id_post and id_user = $id_user";
    $id_like = DB::select($select);
    return empty($id_like);
}
   
}
