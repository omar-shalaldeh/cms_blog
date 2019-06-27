<?php

namespace App\Http\Controllers\Blog;

use App\Category;
use App\Post;
use App\Tag;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PostsController extends Controller
{
    public function show($id)
    {
        $post=Post::findOrFail($id);
        return view('blog.show',compact('post'));

    }


    public function category(Category $category)
    {
        $search=request()->query('search');


        if ($search)
        {
            $posts=$category->posts()->where('title','LIKE','%'.$search.'%')->simplepaginate(2);

        }
        else
        {
            $posts=$category->posts()->simplePaginate(2);
        }

        return view('blog.category')->with('category',$category)
            ->with('posts',$posts)
            ->with('categories',Category::all())
            ->with('tags',Tag::all());
    }

    public function tag(Tag $tag)
    {
        return view('blog.tag')->with('tags',Tag::all())
            ->with('tag',$tag)
            ->with('posts',$tag->posts()->simplepaginate(2))
            ->with('categories',Category::all());

    }

}
