<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ApiController extends Controller
{
    //function to add user using api
    public function register_new_user(Request $request)
    {
        
        //store data in json file
        if (Storage::exists('public/test.json')) {
             $data = Storage::disk('public')->get('test.json');
            //  return json_decode($data);
             $temp = json_decode($data);
             array_push($temp, $request->all());
             Storage::disk('public')->put('test.json',json_encode($temp));
        } else {
            Storage::disk('public')->put('test.json',json_encode([$request->all()]));
        }

        //logic to store data in database
        $user = User::create([

            'username' => $request->username,
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);
        return response()->json([
            'success' => true,
            'user_id' => $user->id
        ]);
    }

    //function to read users
    public function users()
    {
    //read data from json file
        $users = Storage::disk('public')->get('test.json');
        return json_decode($users);

        
    }

    //function to edit users
    public function edit_user(Request $request, $id)
    {
        $users = Storage::disk('public')->get('test.json');
       return $users;
        //updata data in database using user_id
        $user = User::findorfail($id);
        $user->username = $request->username;
        $user->firstname = $request->firstname;
        $user->lastname = $request->username;
        $user->email = $request->email;
        $user->password = bcrypt($request->username);
        $user->save();

        return response()->json([
            'success' => true,
            'data' => "user updated"
        ]);
    }
  
}
