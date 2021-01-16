<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // return view('home');
        $level = auth()->user()->level;
        
        if($level == 'admin'){
            
            return redirect()->route('admin.beranda.index');
        } else if ($level == 'petani') {

            return redirect()->route('petani.beranda.index');
        } else {
            return 'kamu tidak punya akses!';
        }
    }
}
