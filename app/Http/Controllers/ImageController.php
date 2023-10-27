<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Image;
use App\Models\Like;
use App\Models\Comment;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class ImageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create()
    {
        return view('image.create');
    }

    public function save(Request $request)
    {

        //Validacion de datos antes de cargar
        $validate = $this->validate($request, [
            'description' => ['required'],
            'image_path' => ['required', 'image'],
        ]);

        //Traer datos
        $image_path = $request->file('image_path');
        $description = $request->input('description');

        //Cargar valores
        $user = \Auth::user();
        $image = new Image();
        $image->user_id = $user->id;
        $image->image_path = $image_path;
        $image->description = $description;

        if ($image_path) {

            //Nombre unico
            $image_path_name = time() . $image_path->getClientOriginalName();

            //Guarda la imagen en Storage/app/users
            Storage::disk('images')->put($image_path_name, File::get($image_path));

            //Setear la imagen
            $image->image_path = $image_path_name;
        }

        $image->save();

        //Redireccion de la pagina
        return redirect()->route('home')->with(['message' => 'Imagen creada correctamente']);
    }

    public function getImage($filename)
    {
        $file = Storage::disk('images')->get($filename);
        return new Response($file, 200);
    }

    public function detail($id)
    {
        $image = Image::find($id);

        return view('image.detail', [
            'image' => $image
        ]);
    }

    public function delete($id){
		$user = \Auth::user();
		$image = Image::find($id);
		$comments = Comment::where('image_id', $id)->get();
		$likes = Like::where('image_id', $id)->get();
		
		if($user && $image && $image->user->id == $user->id){
			
			// Borrar todos los comentarios
			if($comments && count($comments) >= 1){
				foreach($comments as $comment){
					$comment->delete();
				}
			}
			
			// Borrar todos los likes
			if($likes && count($likes) >= 1){
				foreach($likes as $like){
					$like->delete();
				}
			}
			
			// Borrar ficheros de imagen
			Storage::disk('images')->delete($image->image_path);
			
			// Borrar el registro de la BD de imagen
			$image->delete();
			
			$message = array('message' => 'La imagen se ha eliminado correctamente.');
		}else{
			$message = array('message' => 'La imagen no se ha eliminado.');
		}
		
		return redirect()->route('home')->with($message);
	}
	
	public function edit($id){
		$user = \Auth::user();
		$image = Image::find($id);
		
	
		
		if($user && $image && $image->user->id == $user->id){
			return view('image.edit', [
				'image' => $image
			]);
		}else{
			return redirect()->route('home');
		}
	}
	
	public function update(Request $request){
		//Validación
		$validate = $this->validate($request, [
			'description' => 'required',
			'image_path'  => 'image'
		]);
		
		// Traer datos
		$image_id = $request->input('image_id');
		$image_path = $request->file('image_path');
		$description = $request->input('description');
		
		// Conseguir el objeto image
		$image = Image::find($image_id);
		$image->description = $description;
		
		// Subir fichero
		if($image_path){
			$image_path_name = time().$image_path->getClientOriginalName();
			Storage::disk('images')->put($image_path_name, File::get($image_path));
			$image->image_path = $image_path_name;
		}
		
		// Actualizar registro en la BD
		$image->update();
		
		return redirect()->route('image.detail', ['id' => $image_id])
						 ->with(['message' => 'Imagen se ha actualizada con exito']);
	}
}