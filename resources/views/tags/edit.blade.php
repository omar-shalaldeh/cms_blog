@extends('layouts.app')



@section('content')
    <div class="container">
        <div class="card card-default">
            <div class="card-header">
                <strong>Edit tag</strong>
            </div>
            <div class="card-body">
                @include('partilas.errors')
                <form action="{{route('tags.update',$tag->id)}}" method="post">
                    @Csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="name">name</label>
                        <input type="text" name="name" value="{{$tag->name}}" class="form-control">
                    </div>
                    <div class="form-group">
                        <input type="submit" value="Update tag" class="btn btn-success float-right">
                    </div>
                </form>
            </div>
        </div>
    </div>





@endsection