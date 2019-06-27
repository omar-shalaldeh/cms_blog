@extends('layouts.app')


@section('content')
    @if(session()->has('success'))
        <div class="alert alert-success">
            {{session()->get('success')}}
        </div>


        @endif
    <div class="container">
        <div class="card card-default">
            <div class="card-header">
                <strong>Users</strong>
            </div>
            <div class="card-body">  <table class="table">

                    <tr>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>action</th>


                    </tr>
                    @forelse($users as $user)
                        <tr>
                            <td><img height="40" width="40" src="https://via.placeholder.com/150" alt="image"></td>
                            <td>
                                {{$user->name}}
                            </td>
                            <td>{{$user->email}}</td>

                             <td>
                                 @if(!$user->isAdmin())
                                 <form action="{{route('users.make_admin',$user->id)}}"method="POST">
                                     @csrf

                                 <button  type="submit" class="btn btn-success">Make Admin</button>
                                 </form>
                                 @endif
                             </td>

                        </tr>
                    @empty
                        <h1>No users</h1>
                    @endforelse

                </table></div>
        </div>



    </div>


    

@endsection

