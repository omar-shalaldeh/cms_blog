@extends('layouts.app')


@section('content')

    <div class="card card-default">
        <div class="card-header">
            <strong>{{isset($post)?'Edit Post':'Create Post'}}</strong>
        </div>
        <div class="card-body">
         @include('partilas.errors');
                   <form action="{{isset($post)?route('posts.update',$post->id):route('posts.store')}}" method="POST" enctype="multipart/form-data">
                @Csrf
           @if(isset($post))
               @method('PUT')


               @endif
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" name="title" value="{{isset($post)?$post->title:''}}" class="form-control">
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea  name="description" rows="5" cols="3" class="form-control" >{{isset($post)?$post->description:''}}</textarea>
                </div>
                <div class="form-group">
                    <label for="conten">Content</label>
                    <input id="content" type="hidden" name="conten" value="{{isset($post)?$post->contents:''}}">
                    <trix-editor input="content"></trix-editor>
                </div>
                @if(isset($post))
                    <div class="form-group">
                        <img src="{{asset('storage/'.$post->image)}}" style="width:100%;">


                    </div>


                    @endif
                <div class="form-group">
                    <label for="image">Photo</label>
                    <input type="file" name="image" class="form-control" value="{{isset($post)?$post->image:''}}" lang="en">
                </div>
                <div class="form-group">
                    <label for="category">Category</label>
                    <select name="category"  class="form-control">
                        @foreach($categories as $category)

                            <option value="{{$category->id}}"@if(isset($post))
                            @if($category->id==$post->category_id)
                                    selected
                                    @endif
                            @endif
                            >


                                {{$category->name}}


                            </option>
                            @endforeach

                    </select>
                </div>
                <div class="form-group">
                @if(\App\Tag::count()>0)
                        <label for="tag">Tag</label><br>
                <select class="form-control tagselector" name="tag[]" multiple="multiple">
                    @foreach($tags as $tag)

                        <option value="{{$tag->id}}"
                                @if(isset($post))
                                @if($post->hasTag($tag->id))
                                selected
                                @endif

                                @endif

                        >
                            {{$tag->name}}
                        </option>

                    @endforeach

                </select>
                        @endif
                </div>
                <div class="form-group">
                    <label for="publish_at">Publish_at</label>
                    <input type="text" name="publish_at" id="publish_at" value="{{isset($post)?$post->published_at:''}}" class="form-control">
                </div>
                <div class="form-group float-right">

                    <input type="submit" value="{{isset($post)?'Update Post':'Create Post'}}" name="submit" class="btn btn-primary col-md-20">
                </div>

            </form>
        </div>
    </div>


    @endsection




@section('scripts')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/js/select2.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.1.1/trix.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>

        flatpickr('#publish_at',{
            enableTime:true
        })

        $(document).ready(function() {
            $('.tagselector').select2();
        });

    </script>
    @endsection



@section('styles')

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.1.1/trix.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/css/select2.min.css" rel="stylesheet" />

    @endsection
