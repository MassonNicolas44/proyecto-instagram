<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{

    protected $table='images';

    //Relacion de uno a muchos
    public function comments(){
        return $this->HasMany('App\Comment');
    }

    //Relacion de uno a muchos
    public function likes(){
        return $this->HasMany('App\Like');
    }

    //Relacion de muchos a uno
    public function user(){
        return $this->belongsTo('App\User','user_id');
    }

    use HasFactory;
}