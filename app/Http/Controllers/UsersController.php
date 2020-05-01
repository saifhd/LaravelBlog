<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Http\Requests\UpdateProfileRequest;
class UsersController extends Controller
{
    //
    public function index()
    {
        return view('users.index')->with('users',User::all());
    }
    public function makeAdmin($id){
        $user=User::findOrFail($id);
        $user->role="admin";
        $user->save();
        return redirect('users');
    }
    public function edit()
    {
        return view('users.edit')->with('user',auth()->user());
    }
    public function update(UpdateProfileRequest $request){
        $user=auth()->user();
        $user->name=$request->name;
        $user->about=$request->about;
        $user->save();

        return redirect('users')->with('success','Profile Updated Successfully');
    }
}
