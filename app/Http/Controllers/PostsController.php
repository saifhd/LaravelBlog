<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\posts\CreatePostsRequest;
use App\Post;
use App\Tag;
use App\Category;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\posts\UpdatePostsRequest;
class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('VerifyCategoryCount')->only(['create','store']);
    } 
    public function index()
    {
        //
        return view('posts.index')->with('posts',Post::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('posts.create')->with('categories',Category::all())->with('tags',Tag::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreatePostsRequest $request)
    {
        //
        
        $image=$request->image->store('posts');
        $post=Post::create([
            'title'=>$request->title,
            'description'=>$request->description,
            'content'=>$request->content,
            'published_at'=>$request->published_at,
            'image'=>$image,
            'category_id'=>$request->category,
            'user_id'=>auth()->user()->id
        ]);
        
        
        if($request->tags)
        {
            $post->tags()->attach($request->tags);
        }
        session()->flash('success','Post Created Successfully');
        return redirect(route('posts.index'));
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
    public function edit(Post $post)
    {
        
        $categories=Category::all();
        
        return view('posts.create',compact('categories'))->with('post',$post)->with('tags',Tag::all());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostsRequest $request,Post $post)
    {
        
        // $data=$request->only(['tittle','description','content','published_at']);
        if($request->hasFile('image')){

            $image=$request->image->store('posts');
            Storage::delete($post->image);
            $post->image=$image;            
        }
        $post->title=$request->input('title');
        $post->description=$request->input('description');
        $post->content=$request->input('content');
        $post->published_at=$request->published_at;

        if($request->tags)
        {
            $post->tags()->sync($request->tags);
        }
        $post->save();


        session()->flash('success','Post Updated Successfully');
        return redirect(route('posts.index'));
    }

    /**
     * Remove the specified resource from storage.
     * 
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post=Post::withTrashed()->findOrFail($id);
        if($post->trashed())
        {
            Storage::delete($post->image);
             $post->forceDelete();
            session()->flash('success','Post Deleted Successfully');
        }
        else{
            $post->delete();
            session()->flash('success','Post Trashed Successfully');
        }
        
        return redirect(route('posts.index'));
        // dd($post);
    }
    public function trash()
    {
        $trashed=Post::onlyTrashed()->get();
        return view('posts.index')->with('posts',$trashed);
        
    }
    public function restore($id)
    {
        $post=Post::withTrashed()->findOrFail($id);
        $post->restore();
        return redirect(route('posts.index'))->with('success','Post restored successfully');

    }
}
