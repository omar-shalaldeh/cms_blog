<?php

namespace App\Http\Controllers;

use App\Category;
use App\Post;
use App\Tag;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $search=request()->query('search');
        if ($search)
        {
            $posts=Post::where('title','LIKE','%'.$search.'%')->simplepaginate(1);

        }
        else
        {
            $posts=Post::simplepaginate(3);
        }
        $categories=Category::all();
        return view('welcome',compact('categories'))->with('tags',Tag::all())->with('posts',$posts);



    }
}
