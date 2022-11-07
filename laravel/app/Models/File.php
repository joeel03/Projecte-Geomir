<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;

    protected $fillable = [
        'filepath',
        'filesize',
    ];
    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}