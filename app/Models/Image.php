<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{

    protected $table='images';

    //Relacion de uno a muchos
    public function comments(){
        return $this->HasMany('App\Models\Comment')->orderBy('id','desc');
    }

    //Relacion de uno a muchos
    public function likes(){
        return $this->HasMany('App\Models\Like');
    }

    //Relacion de muchos a uno
    public function user(){
        return $this->belongsTo('App\Models\User','user_id');
    }

    use HasFactory;
}