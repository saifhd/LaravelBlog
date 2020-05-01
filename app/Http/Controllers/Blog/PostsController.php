<?php

namespace App\Http\Controllers\Blog;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Post;
use App\Tag;
use App\Category;
class PostsController extends Controller
{
    //
    public function show(Post $post)
    {
        return view('blog.show')->with('post',$post);
    }
    public function category(Category $category){
        // $search=request()->query('search');
        // if($search){
        //     $posts=$category->post()->where('title','LIKE','%'.$search.'%')->simplePaginate(3);
        // }
        // else{
        //     $posts=$category->post()->simplePaginate(3);
        // }
        return view('blog.category')->with('category',$category)
        ->with('posts',$category->post()->searched()->paginate(3))
        ->with('categories',Category::all())
        ->with('tags',Tag::all());
    }
    public function tag(Tag $tag){
        // $search=request()->query('search');
        // if($search){
        //     $posts=$tag->posts()->where('title','LIKE','%'.$search.'%')->simplePaginate(3);
        // }
        // else{
        //     $posts=$tag->posts()->simplePaginate(3);
        // }
        return view('blog.tag')->with('tag',$tag)
        ->with('posts',$tag->posts()->searched()->paginate(3))
        ->with('categories',Category::all())
        ->with('tags',Tag::all());
    }
}
