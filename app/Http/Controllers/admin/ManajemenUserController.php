<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\user;
use Response;
use Alert;
use Illuminate\Support\Facades\Input;
use DB;
use Hash;

class ManajemenUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = user::whereNotIn('id', [1])->get();
        return view('admin.manajemen_user.index', ['user'=> $user]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function tambahUser(Request $request)
    {
        return view ('admin.manajemen_user.tambah_user');
       
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'email'     => 'required|email',
            'password'  => 'required|min:6',
            'level'     => 'required',
            'alamat'    => 'required',
            'no_hp'     => 'required'
        ]);

        $add = new User;
        $add->name      = $request->input ('name');
        $add->email     = $request->input ('email');
        $add->password  = $request->input ('password');
        $add->level     = $request->input ('level');
        $add->alamat    = $request->input ('alamat');
        $add->no_hp     = $request->input ('no_hp');
        
        if ($request->password) {
            $add->password = bcrypt($request->password);
        }
        $add->save();
        
        // alert()->success('Pengguna Berhasil Ditambahkan');
        return redirect ()->route ('admin.manajemen_user.index')->with('success','Pengguna Berhasil Ditambahkan');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = User::findOrFail($id);
        return view('admin.manajemen_user.edit', compact('data'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // return $request->all();
        // $validatedData = $request->validate([
        //     'name' => 'required|max:255',
        //     'email' => 'required|email',
        //     'password' => 'min:6',
        //     'alamat' => 'required',
        //     'no_hp'  => 'required'
        // ]);

        $user = User::find($id);
        $user->name     = $request->name;
        $user->email    = $request->email;
        // $user->password = $request->password;
        // $user->level    = $request->level;
        $user->alamat   = $request->alamat;
        $user->no_hp    = $request->no_hp;
        
       
        if ($request->password) {
            $user->password = bcrypt($request->password);
        }

        $user->update();
        // alert()->success('Data Berhasil Diperbaharui');
        return redirect()->route('admin.manajemen_user.index')->with('success','Data Berhasil Diperbaharui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('admin.manajemen_user.index')->with('success','Data Pengguna Berhasil dihapus');
    }
}
