<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\user;
use Hash;

class ProfilController extends Controller
{
    public function index()
    {
        $id_user = auth()->user()->id;
        $user = User::where('id', $id_user)->first();
        // return ($user);
        return view ('admin.profil.index', compact ('user','id_user'));
    }

    public function edit($id)
    {
        // return "aa";
        $user = User::where('id', $id)->first();
        // return($user);
        return view ('admin.profil.edit', compact ('user'));
    }

    public function update (Request $request, $id)
    {
        $users = User::findOrFail($id);
        $users->name        = $request->name;
        $users->email       = $request->email;
        $users->alamat       = $request->alamat;
        $users->no_hp       = $request->no_hp;
        
        if ($request->password) {
            $users->password = Hash::make($request->password);
        }

        $users->update();
        
        return redirect()->route('admin.profil.index');
    }
}
