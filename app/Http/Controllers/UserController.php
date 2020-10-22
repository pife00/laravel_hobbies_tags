<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Hobby;
use Illuminate\Support\Facades\Gate;
use Intervention\Image\Facades\Image;
class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')->except(['show']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
            
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $hobby = Hobby::select()
        ->where('user_id',$user->id)
        ->orderBy('updated_at','desc')
        ->get();
        
        
        return view('user.show')->with([
            'hobbies'=>$hobby,
            'user'=> $user
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        abort_unless(Gate::allows('edit', $user), 403);
        return view('user.edit')->with([
            'user'=>$user
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        abort_unless(Gate::allows('edit', $user), 403);
        $request->validate([
            'name'=>'required|min:3',
            'motto'=>'required|min:5',
            'about_me'=>'required|min:7',
            'imagen'=> 'mimes:jpeg,gif,jpg,bmp,png'
        ]);

        if($request->imagen){
            $this->saveImageUser($request->imagen,$user->id);
        }

        $user->update([
            'name' => $request->name,
            'motto' => $request->motto,
            'about_me'=>$request->about_me,
        ]);

        return redirect('/home');

        

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        abort_unless(Gate::allows('edit', $user), 403);
  
    }
    
    public function saveImageUser($imageInput,$user_id){
        $imagen = Image::make($imageInput);
        //landscape
        if($imagen->width() > $imagen->height()){
            $imagen->widen(1200)
            ->save(public_path('/img/users/'.$user_id.'_large.jpg'))
            ->widen(400)->pixelate(12)
            ->save(public_path('/img/users/'.$user_id.'_pixelate.jpg'))
            ->widen(60)
            ->save(public_path('/img/users/'.$user_id.'_thumb.jpg'));
        }else{//Potrait
            $imagen->widen(900)
            ->save(public_path('/img/users/' . $user_id . '_large.jpg'))
            ->widen(400)->pixelate(12)
            ->save(public_path('/img/users/' . $user_id . '_pixelate.jpg'))
            ->widen(60)
            ->save(public_path('/img/users/' . $user_id . '_thumb.jpg'));
        }
    }

    public function deleteImageUser($user_id)
    {

        if (file_exists(public_path('/img/users/' . $user_id. '_large.jpg'))) {
            unlink(public_path('/img/users/' . $user_id. '_large.jpg'));
        }
        if (file_exists(public_path('/img/users/' . $user_id. '_thumb.jpg'))) {
            unlink(public_path('/img/users/' . $user_id. '_thumb.jpg'));
        }
        if (file_exists(public_path('/img/users/' . $user_id . '_pixelate.jpg'))) {
            unlink(public_path('/img/users/' . $user_id . '_pixelate.jpg'));
        }

        return back();
    }
}
