<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    } 

    public function edit ()
    {
        $user = Auth::id();
        return view ('users.edit',[
            'user' => $user
        ]);
    }

    public function update (Request $request)
    {
        $file = $request->hasfile('picture');
        dd($file);
        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'email' => 'required',
            'picture' => 'image',
        ]);

        if ($validator->fails()) {
            return redirect()->route('users.edit')
                        ->withErrors($validator);
        }

        $user = Auth::user();
        $user->name = $request->name;
        $user->email = $request->email;


        if($request->hasfile('picture'))
        {
            $name =  $request->file('picture')->getClientOriginalName();
            $path = $request->file('picture')->storeAs('public/img', $name);
            $user->picture = $name;
        }
        $user->save();

        return redirect()
            ->route('users.edit')
            ->withMessage('Actualizado correctamente');
    }

    public function update_password(Request $request)
    {
        $user = Auth::user();
        //dd($request);
        $validator = Validator::make($request->all(),[
            'old_password' => 'required',
            'password' => ['required', 'string', 'min:8', 'confirmed']
        ]);

        if ($validator->fails()) {
            return redirect()->route('users.edit')
                        ->withErrors($validator);
        }

        if( !Hash::check($request->old_password , $user->password))
        {
            return redirect()->route('users.edit')
            ->with('error','Contraseña no coincide con la anterior');
        } 
        $user->password =  Hash::make($request->password);
        $user->save();
        return redirect()
            ->route('users.edit')
            ->with('status', 'Password updated!');
    }

}
