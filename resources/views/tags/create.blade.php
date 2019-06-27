@extends('layouts.app')




@section('content')
    @if(session()->has('error'))

        <div class="alert alert-danger">
            {{session()->get('error')}}
        </div>



    @endif

    <div class="card card-default">
        <div class="card-header">
            <strong>Create tag</strong>

        </div>
        <div class="card-body">
          @include('partilas.errors')
            <form method="post" action="{{route('tags.store')}}">
                {{Csrf_field()}}
                <div class="form-group">
                    <input type="text" name="name" class="form-control">
                </div>

                <div class="form-group ">
                    <input type="submit" value="Create tags" class="btn btn-primary">
                </div>

            </form>

        </div>
    </div>




@endsection