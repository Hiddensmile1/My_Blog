<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdminLoginRequest;
use App\Models\Admin;
use App\Http\Requests\StoreAdminRequest;
use App\Http\Requests\UpdateAdminRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class AdminController extends Controller
{

    public function login(AdminLoginRequest $request)
    {

        //validate the form
        //check if credential exists
        //if it does, return token and user info
        //if it dosent, send and unauthrized error


        $credentials = $request->only(['email','password']);

        if(!Auth::guard('admin')->attempt($credentials))
        {
            return response()->json([
                'message' => 'Unauthorized'
            ],401);
        }

        $user = Admin::whereEmail($request->email)->first();
        $token = $user->createToken('Personal Access Token')->plainTextToken;

        return response()->json([
            'accessToken' =>$token,
            'user' => $user
        ]);
    }

    public function register(StoreAdminRequest $request)
    {
        //Validate form
        //store in the admin table
        //return success message and the stored data

    $admin = Admin::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password)
    ]);

    return response()->json([
        'status' => true,
        'message' => 'Record saved successfully!',
        'data' => $admin
    ]);


    Admin::all();
    Admin::latest ()->paginate(10);

    Admin::where('email', $request->email)->first();

    Admin::whereId($request->id)->delete();




    $admin = Admin::where('id', $request->id)->first();
    Admin::whereId($request->id)->update([
        'name' => $request->name ?? $admin->name,
        'email' => $request->email ?? $admin->email,
        'password' => Hash::make($request->password) ?? $admin->password
    ]);

    }






    // public function logout(Request $request)
    // {

    //     auth()->guard('admin')->user()->tokens()->delete();
    //     // $request->user()->tokens()->delete();

    //     return response()->json([
    //     'message' => 'Successfully logged out'
    //     ]);
    // }

    // public function user(Request $request)
    // {
    //     return response()->json($request->user());

    // }





}