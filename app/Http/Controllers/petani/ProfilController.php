<?php

namespace App\Http\Controllers\petani;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\user;

class ProfilController extends Controller
{
    public function index()
    {
        $id_user = auth()->user()->id;
        $users = User::where('id', $id_user)->first();
        // return ($users);
        return view ('petani.profil.index', compact ('users','id_user'));
    }

    public function edit($id)
    {
        // $user = auth()->user()->id;
        $users = User::where('id', $id)->first();
        // return($user);
        return view ('petani.profil.edit', compact ('users'));
    }

    public function update (Request $request, $id)
    {
        $users = User::findOrFail($id);
        $users->name        = $request->name;
        $users->email       = $request->email;
        // $users->password    = $request->password;
        $users->email       = $request->email;
        $users->alamat       = $request->alamat;
        $users->no_hp       = $request->no_hp;
        
        if ($request->password) {
            $users->password = bcrypt($request->password);
        }
        $users->update();
        return redirect()->route('petani.profil.index');
    }
}
