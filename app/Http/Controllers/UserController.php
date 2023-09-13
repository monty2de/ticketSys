<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        return $users;
    }


    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
        $credintial = $request->only('email', 'password');

        

        if(Auth::attempt($credintial)){
            $user = User::where('email', $request->get('email'))->first();

         
            $token = $user->createToken('ApiTocken');
 
        return ['token' => $token->plainTextToken , 'userInfo' => $user ];
        }
        return 'not found';
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);
        
        $user =  User::create([
            'name' => $request->get('name') ,
            'email' => $request->get('email') ,
            'password' => Hash::make( $request->get('password')),
           
        ]);

        return 'user created';

        
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        $user = User::where('email', $request->get('email'))->first();

        return $user;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $data = request()->validate([
            'name' => 'required',
            'email' => 'required' , 
        ]);        

        $user = User::where('email', $request->get('email'))->first();


        $user->update(array_merge($data));

        return $user;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $user = User::where('email', $request->get('email'))->first();

        $user->delete();
        return 'user deleted';
    }
}
