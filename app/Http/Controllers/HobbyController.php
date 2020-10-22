<?php

namespace App\Http\Controllers;

use Intervention\Image\Facades\Image;
use App\Models\Hobby;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Carbon;
class HobbyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth')->except(['index','show']);
    }
    
    public function index()
    { 
       $hobby = Hobby::orderBy('created_at','desc')->paginate(15);
        return view("hobby.index")->with([
            'hobbies'=>$hobby
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('hobby.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|min:3',
            'descripcion' => 'required|min:5',
            'imagen' => 'mimes:jpeg,gif,jpg,bmp,png'

        ]);
        $hobby = new Hobby([
            'nombre'=>$request->nombre,
            'descripcion'=>$request->descripcion,
            'user_id'=>auth()->id()
        ]);
        $hobby->save();
        
        if ($request->imagen) {
            $this->saveImage($request->imagen, $hobby->id);
        }
       return redirect('/hobby/'.$hobby->id);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Hobby  $hobby
     * @return \Illuminate\Http\Response
     */
    public function show(Hobby $hobby)
    {
        $allTags = Tag::all();
        $usedTags = $hobby->tags;
        $availableTag = $allTags->diff($usedTags);
        return view('hobby.show')->with([
            'hobby'=>$hobby,
            'availableTags'=> $availableTag      
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Hobby  $hobby
     * @return \Illuminate\Http\Response
     */
    public function edit(Hobby $hobby)
    {
        abort_unless(Gate::allows('edit', $hobby), 403); 
        return view('hobby.edit')->with([
            'hobby'=>$hobby
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Hobby  $hobby
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Hobby $hobby)
    {
        abort_unless(Gate::allows('update', $hobby), 403);

        $request->validate([
            'nombre' => 'required|min:3',
            'descripcion' => 'required|min:5',
            'imagen'=>'mimes:jpeg,gif,jpg,bmp,png'

        ]);

        if($request->imagen){
            $this->saveImage($request->imagen,$hobby->id); 
        }

        $hobby->update([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion
        ]);

        return $this->index()->with([
            'mensaje' => 'El hobbie <b>' . $hobby->nombre . '</b> ha sido actualizado'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Hobby  $hobby
     * @return \Illuminate\Http\Response
     */
    public function destroy(Hobby $hobby)
    {
        abort_unless(Gate::allows('delete',$hobby),403);
        $oldName = $hobby->nombre;
        $hobby->delete();
        return $this->index()->with([
            'mensaje' => 'El hobbie <b>' . $oldName . '</b> ha sido eliminado'
        ]);
    }

    public function saveImage($imageInput,$hobby_id)
    {
        $imagen = Image::make($imageInput);
        //landscape
        if ($imagen->width() > $imagen->height()) {
            $imagen->widen(1200)
                ->save(public_path('/img/hobbies/' . $hobby_id . '_large.jpg'))
                ->widen(400)->pixelate(12)
                ->save(public_path('/img/hobbies/' . $hobby_id . '_pixalate.jpg'));
            $imagen = Image::make($imageInput);
            $imagen->widen(60)
                ->save(public_path('/img/hobbies/' . $hobby_id . '_thumb.jpg'));
        } else { //Potrait
            $imagen->heighten(900)
                ->save(public_path('/img/hobbies/' . $hobby_id . '_large.jpg'))
                ->heighten(400)->pixelate(12)
                ->save(public_path('/img/hobbies/' . $hobby_id . '_pixalate.jpg'));
            $imagen = Image::make($imageInput);
            $imagen->heighten(60)
                ->save(public_path('/img/hobbies/' . $hobby_id . '_thumb.jpg'));
        }
    }

    public function deleteImage($hobby_id){

        if(file_exists(public_path('/img/hobbies/' . $hobby_id . '_large.jpg'))){
            unlink(public_path('/img/hobbies/' . $hobby_id . '_large.jpg'));
            
        }
        if (file_exists(public_path('/img/hobbies/' . $hobby_id . '_thumb.jpg'))) {
            unlink(public_path('/img/hobbies/' . $hobby_id . '_thumb.jpg'));
            
        }
        if (file_exists(public_path('/img/hobbies/' . $hobby_id . '_pixelate.jpg'))) {
            unlink(public_path('/img/hobbies/' . $hobby_id . '_pixelate.jpg'));
           
        }

        return back();

    }
}
