<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Like;

class LikeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function like($image_id)
    {
        //Traer datos
        $user = \Auth::user();

        //Comprobacion de que el usuario logeado y el like del usuario de la foto. Sean el mismo
        $isset_like = Like::where('user_id', $user->id)
            ->where('image_id', $image_id)
            ->count();

        if ($isset_like == 0) {

            //Cargar valores
            $like = new Like();
            $like->user_id = $user->id;
            $like->image_id = (int) $image_id;

            $like->save();

            //Devolucion del objeto Like con Json
            return response()->json(['like' => $like]);

        } else {

            //Devolucion del objeto Like con Json
            return response()->json(['message' => 'El like ya existe para esta imagen']);

        }

    }

    public function dislike($image_id)
    {

        //Traer datos
        $user = \Auth::user();

        //Comprobacion de que el usuario logeado y el like del usuario de la foto. Sean el mismo
        $like = Like::where('user_id', $user->id)
            ->where('image_id', $image_id)
            ->first();

        if ($like) {


            $like->delete();

            //Devolucion del objeto Like con Json
            return response()->json(['like' => $like, 'message' => 'Dislike realizado correctamente']);

        } else {

            //Devolucion del objeto Like con Json
            return response()->json(['message' => 'El like no existe para esta imagen']);

        }

    }

    public function index()
    {
        $user = \Auth::user();

        $likes = Like::where('user_id',$user->id)
        ->orderBy('id', 'desc')
        ->paginate(5);
        return view(
            'like.index',
            [
                'likes' => $likes
            ]
        );

    }

}