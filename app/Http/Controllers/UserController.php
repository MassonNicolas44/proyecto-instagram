<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function config()
    {
        return view('user.config');
    }

    public function update(Request $request)
    {

        //Traer usuario logeado
        $user=\Auth::user();

        $id = $user->id;

        //Validacion de datos antes de cargar
        $validate=$this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'surname' => ['required', 'string', 'max:255'],
            'nick' => ['required', 'string', 'max:255,unique:users.nick'.$id],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users.email'.$id],
        ]);

        //Traer datos del formulario
        $name = $request->input['name'];
        $surname = $request->input['surname'];
        $nick = $request->input['nick'];
        $email = $request->input['email'];

//Asignar lso nuevos valores a la tabla User
$user->name=$name;
$user->surname=$surname;
$user->nick=$nick;
$user->email=$email;
$user->update();

//Redireccion de la pagina

return redirect()->route('config')->with(['message'=>'Usuario modificado correctamente']));


    }

}