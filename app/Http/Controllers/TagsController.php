<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Tag;

use App\Http\Requests\tags\CreateCategoryRequest;
use App\Http\Requests\tags\UpdateCategoryRequest;
class TagsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $tags=Tag::all();
        return view('tags.index',compact('tags'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        
        return view('tags.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateCategoryRequest $request)
    {
        //
        
        $tags=new Tag;
        $tags->name=$request->input('name');
        $tags->save();
        return redirect(route('tags.index'))->with('success','Tag Created Successfully');

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
    public function edit(Tag $tag)
    {
        // return 123;
        return view('tags.create')->with('tag',$tag);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCategoryRequest $request,Tag $tag)
    {
        $tag->name=$request->input('name');
        $tag->save();
        return redirect(route('tags.index'))->with('success','Tag Updated Successfully');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tag $tag)
    {
        if($tag->posts->count()>0){
            session()->flash('error','Tag cannot be Deleted because it has some posts');
            return redirect(route('tags.index'));
        }
        $tag->delete();
        return redirect(route('tags.index'))->with('success','Tag was Deleted Successfully');
    }
}
