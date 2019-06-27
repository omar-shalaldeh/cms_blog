@extends('layouts.app')




@section('content')
    @if(session()->has('error'))

        <div class="alert alert-danger">
            {{session()->get('error')}}
        </div>



        @endif

    <div class="card card-default">
        <div class="card-header">
            <strong>Create Category</strong>
        
        </div>
            <div class="card-body">
           @if($errors->any())
               <div class="alert alert-danger">
                   <ul class="list-group">
                       @foreach($errors->all() as $error)
                           <li class="list-group-item">
                               {{$error}}
                           </li>



                           @endforeach
                   </ul>
               </div>

               @endif
                <form method="post" action="{{route('categories.store')}}">

                    @Csrf
                    <div class="form-group">
                        <input type="text" name="name" class="form-control">
                    </div>

                    <div class="form-group ">
                        <input type="submit" value="Create Categories" class="btn btn-primary">
                    </div>

                </form>
           
        </div>
    </div>
    
    
    
    
    @endsection