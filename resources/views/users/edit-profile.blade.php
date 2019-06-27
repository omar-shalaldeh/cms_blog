@extends('layouts.app')



@section('content')

    <div class="card card-default">
        <div class="card-header">
            <h1 >
             My Profile
            </h1>

        </div>
        <div class="card-body">
            @include('partilas.errors')
            <form action="{{route('users.update')}}" method="post">
                @Csrf
                @method('PUT')
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" class="form-control" value="{{auth()->user()->name}}">
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" class="form-control" value="{{auth()->user()->email}}">
                </div>
                <div class="form-group">
                    <label for="about">About</label>
                    <input type="text" name="about" class="form-control" value="{{auth()->user()->about}}">
                </div>
                <div class="form-group">

                    <input type="submit" name="edit" class="btn btn-success" value="Update User">
                </div>
            </form>
    </div>
    </div>








    @endsection