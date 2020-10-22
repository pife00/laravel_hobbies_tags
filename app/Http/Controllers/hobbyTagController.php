<?php

namespace App\Http\Controllers;
use App\Models\Tag;
use App\Models\Hobby;
use Illuminate\Support\Facades\Gate
use Illuminate\Http\Request;

class hobbyTagController extends Controller
{
    public function getFilterHobby($tag_id)
    {
       $tag = new Tag();
       $list = $tag::find($tag_id)->filteredHobbies()->paginate(15);
      
       $filter = $tag::find($tag_id);
       return view('hobby.index')->with([
           'hobbies'=>$list,
           'filter'=>$filter
       ]);
    }

    public function attachTag($hobbie_id,$tag_id)
    {
        $hobby = Hobby::find($hobbie_id);
        if(Gate::denies('connect_hobbyTag',$hobby)){
            abort(403);
        }
        

        $tag = Tag::find($tag_id);
        $hobby->tags()->attach($tag_id);
        return back()->with([
            'mensaje'=>'The Tag <br>'.$tag->name.'</b> fue añadido'
        ]);

    }

    public function detachTag($hobbie_id, $tag_id)
    {
        $hobby = Hobby::find($hobbie_id);
        $tag = Tag::find($tag_id);
        $hobby->tags()->detach($tag_id);
        return back()->with([
            'mensaje' => 'The Tag <br>' . $tag->name . '</b> fue removido'
        ]);
    }
}
