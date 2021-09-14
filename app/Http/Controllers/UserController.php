<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index(){
        $users = User::all();
        return view('welcome')->with(['users' => $users]);
    }
    public function show()
    {
      $users = User::all();
      return response()->json(['users' => $users]);
    }

    public function store(Request $request)
    {
        $data = $request->all();

        $user = new User;
        $user['first_name'] = $data['first_name'];
        $user['last_name'] = $data['last_name'];
        $user['email'] = $data['email'];
        $user['username'] = $data['username'];

        $user->save();

        return response()->json(['success'=>'Ajax request submitted successfully', 'users' => User::all()]);
    }
}
