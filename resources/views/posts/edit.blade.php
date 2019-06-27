@extends('layouts.app')



@section('content')
    <div class="container">
        <div class="card card-default">
            <div class="card-header">
                <strong>Edit Post</strong>
            </div>
            <div class="card-body">
                <form action="{{route('posts.update',$post->id)}}" method="POST">
                    @Csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" name="title" value="{{$post->title}}" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <input type="text" name="description" value="{{$post->description}} " class="form-control">
                    </div>
                    <div class="form-group">

                        <input type="submit" value="Update Post" class="btn btn-success float-right">
                    </div>
                </form>
            </div>
        </div>
    </div>





    @endsection