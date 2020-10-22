<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
class TagController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')->except(['index']);
        $this->middleware('admin')->except(['index']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $tag = Tag::all();
        return view('tag.index')->with([
            'tags'=>$tag
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tag.create');
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
            'nombre'=>'required|min:3',
            'estilo'=>'required|min:4'
        ]);
        $tag = new Tag([
            'nombre'=>$request->nombre,
            'estilo'=>$request->estilo,
        ]);
        $tag->save();
        return $this->index();

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function show(Tag $tag)
    {
        return view('tag.show')->with([
            'tag' => $tag
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function edit(Tag $tag)
    {
        abort_unless(Gate::allows('edit', $tag), 403);

        return view('tag.edit')->with([
            'tag' => $tag
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tag $tag)
    {
        abort_unless(Gate::allows('update', $tag), 403);

        $request->validate([
            'nombre'=>'required|min:3',
            'estilo'=>'required|min:3'
        ]);

        $tag->update([
            'nombre'=>$request->nombre,
            'estilo'=>$request->estilo,
        ]);

       return $this->index();

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tag $tag)
    {
        abort_unless(Gate::allows('delete', $tag), 403);

        $tag->delete();
        return $this->index();
    }
}
