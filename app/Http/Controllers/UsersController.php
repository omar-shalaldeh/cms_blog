<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdatePostRequest;
use App\Http\Requests\UpdateUserRequest;
use App\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function index()
    {
        $users=User::all();
        return view('users.index')->with('users',$users);



    }


    public function make_admin(User $user)
    {

       $user->role="admin";
        $user->save();

        return redirect(route('users.index'));

    }
public function update(UpdateUserRequest $request)
{
    $user=auth()->user();
    $user->update([
        'name'=>$request->name,
        'about'=>$request->about
    ]);
    session()->flash('success','updated user successfully');
    return redirect(route('users.index'));

}

    public function edit_profile()
{
return view('users.edit-profile')->with('user',auth()->user());


}
}
