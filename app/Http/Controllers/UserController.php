<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\Models\User;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function config()
    {
        return view('user.config');
    }

    public function update(Request $request)
    {

        //Traer usuario logeado
        $user = \Auth::user();

        $id = $user->id;

        //Validacion de datos antes de cargar
        $validate = $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'surname' => ['required', 'string', 'max:255'],
            'nick' => ['required', 'string', 'max:255','unique:users,nick,'.$id],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,'.$id],
        ]);

        //Traer datos del formulario
        $name = $request->input('name');
        $surname = $request->input('surname');
        $nick = $request->input('nick');
        $email = $request->input('email');

        //Asignar los nuevos valores a la tabla User
        $user->name = $name;
        $user->surname = $surname;
        $user->nick = $nick;
        $user->email = $email;

        //Cargar imagen
        $image_path = $request->file('image_path');
        if ($image_path) {

            //Nombre unico
            $image_path_name = time() . $image_path->getClientOriginalName();

            //Guarda la imagen en Storage/app/users
            Storage::disk('users')->put($image_path_name, File::get($image_path));

            //Setear la imagen
            $user->image = $image_path_name;
        }

        $user->update();

        //Redireccion de la pagina

        return redirect()->route('config')->with(['message' => 'Usuario modificado correctamente']);
    }

    public function getImage($filename)
    {
        $file = Storage::disk('users')->get($filename);
		return new Response($file, 200);
    }

    public function profile($id)
    {

        $user = User::find($id);
        return view('user.profile',['user'=>$user]);
    }


}