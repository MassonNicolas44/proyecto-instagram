<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Image;
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
        return view('images.create');
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
        return redirect()->route('home')->with(['message' => 'Image creada correctamente']);
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
}