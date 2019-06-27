<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests\PostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Post;
use App\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostsController extends Controller
{

    public function __construct()
    {

      $this->middleware('VerifyCsrfCategory')->only(['create','store']);


    }





    public function index()
    {
     $posts=Post::all();
    return view('posts.index',compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories=Category::all();
        return view('posts.create',compact('categories'))->with('tags',Tag::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {$input=$request->all();
  $image=$request->image->store('posts');

/*if($file=$request->file('image'))
{
    $name=$file->getClientOriginalName();
    $file->move('posts',$name);
    $input['image']=$name;
}*/
    $post=auth()->user()->posts()->create([
         'title'=>$request->title,
         'description'=>$request->description,
         'contents'=>$request->conten,
         'published_at'=>$request->publish_at,
         'image'=>$image,
        'category_id'=>$request->category

    ]);




        if ($request->tag)
        {
            $post->tags()->attach($request->tag);

        }

  session()->flash('success','the create post successfully');
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
        return view('posts.create',compact('categories'))->with('post', $post)->with('tags',Tag::all());


    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostRequest $request, Post $post)
    {

        $data=$request->only(['title','description','published_at','contents']);


        if ($request->hasFile('image'))
        {
            $image=$request->image->store('posts');
            $post->deleteImage();

    $data['image']=$image;


        }

   $data['category_id']=$request->category;
   $data['contents']=$request->conten;
        if ($request->tag)
        {
            $post->tags()->sync($request->tag);


        }

        $post->update($data);
        session()->flash('success','update post successfully');
        return redirect(route('posts.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        $post=Post::onlyTrashed()->where('id',$id)->firstOrFail();
        $post->restore();
        return redirect(route('posts.index'));



    }

    public function destroy($id)
    {
        $post=Post::withTrashed()->whereId($id)->firstOrFail();
        if($post->trashed()) {
           $post->deleteImage();
            $post->Forcedelete();
        }else
        {
            $post->delete();
        }

        session()->flash('success','Trash post successfully');
       return redirect(route('posts.index'));


    }
    public function Trash()
    {

return view('posts.index')->with('posts',Post::onlyTrashed()->get());

    }
}
