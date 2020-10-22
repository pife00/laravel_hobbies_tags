<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hobby;

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
        $hobby = Hobby::select()
        ->where('user_id',auth()->user()->id)
        ->orderBy('updated_at','desc')
        ->get();

       // die($hobby);
        return view('home')->with([
            'hobbies'=>$hobby
        ]);
    }
}
