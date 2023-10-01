<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function save(Request $request)
    {

        //Validacion de datos antes de cargar
        $validate = $this->validate($request, [
            'image_id' => ['integer', 'required'],
            'content' => ['string', 'required'],
        ]);

        //Traer datos
        $user = \Auth::user();
        $image_id = $request->input('image_id');
        $content = $request->input('content');


        //Cargar valores
        $comment = new Comment();
        $comment->user_id = $user->id;
        $comment->image_id = $image_id;
        $comment->content = $content;

        $comment->save();

        //Redireccion de la pagina
        return redirect()->route('image.detail', ['id' => $image_id])->with(['message' => 'Commentario publicado correctamente']);

    }

    public function delete($id)
    {
        //Traer datos del usuario logeado
        $user = \Auth::user();

        //Traer el objeto del comentario
        $comment = Comment::find($id);

        //Comprobacion si es dueño del comentario o de la publicacion
        if ($user && ($comment->user_id == $user->id || $comment->image->user_id == $user->id)) {
            $comment->delete();

            //Redireccion de la pagina
            return redirect()->route('image.detail', ['id' => $comment->image->id])->with(['message' => 'Commentario eliminado correctamente']);

        } else {

            //Redireccion de la pagina
            return redirect()->route('image.detail', ['id' => $comment->image->id])->with(['message' => 'Commentario no se pudo eliminar']);

        }

    }

}