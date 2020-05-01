<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Tag;
use App\Category;
class WellcomeController extends Controller
{
    //
    public function index()
    {
        // $search=request()->query('search');
        // if($search){
        //     $post=Post::where('title','LIKE','%'.$search.'%')->simplePaginate(4);
            
             
        // }
        // else{
        //     $post=Post::paginate(4);
        // }
        return view('welcome')->with('categories',Category::all())
        ->with('tags',Tag::all())
        ->with('posts',Post::searched()->Paginate(3));
    }
}
