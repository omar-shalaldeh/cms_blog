@extends('layouts.app')


@section('content')

    @if(session()->has('success'))
        <div class="alert alert-success">
            {{session()->get('success')}}
        </div>
    @endif
   <div class="d-flex justify-content-end my-2">
       <a href="{{route('posts.create')}}" class="btn btn-success">Add Post</a>
   </div>
    <div class="card card-default">
        <div class="card-header">

            <strong>Posts</strong>

        </div>
        <div class="card-body">
            @if($posts->count()>0)

         <table class="table">
             <tr>
                 <th>Image</th>
                 <th>Title</th>
                 <th>Time Ago</th>
                  <th>Category</th>
                  <th></th>


             </tr>
             @foreach($posts as $post)
            <tr>
                <td><img height="50px" width="70px" src="{{'storage/'.$post->image}}"></td>
                <td>{{$post->title}}</td>
                <td>{{$post->created_at->diffForHumans()}}</td>
                <td><a href="{{$post->category?route('categories.edit',$post->category_id):''}}">{{$post->category?$post->category->name:'Not Category'}}</a></td>
                <td>
                @if(!$post->trashed())
                    <a href="{{route('posts.edit',$post->id)}}" class="btn btn-primary btn-sm float-right ">Edit</a>
                    @endif
                  <form action="{{route('posts.destroy',$post->id)}}" class="float-right " method="POST">
                      @Csrf
                      @method('DELETE')
                      <input type="submit" class="btn btn-danger btn-sm mx-1" value="{{$post->trashed()?'Delete':'Trash'}}">
                  </form>
                      @if($post->trashed())
                          <form action="{{route('posts.restore',$post->id)}}" class="float-right">
                          <input type="submit" value="Restore" class="btn btn-success float-right btn-sm">

                      </form>


                          @endif

                </td>
            </tr>



                 @endforeach
         </table>
                @else
               <h3 class="text-center"><strong>Not yet Post</strong></h3>
            @endif
        </div>
    </div>
    @endsection