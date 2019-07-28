<?php

namespace App\Http\Controllers;

use Auth;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserApiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getData()
    {
        return Auth::user();
    }

    public function patchProfile(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'firstName' => 'nullable|string|max:255',
            'lastName' => 'nullable|string|max:255',
        ]);

        $errors = $validation->errors();
        if ($validation->fails()) {
            return response($errors->toJson(), 400);
        }

        $firstName = $request->input('firstName');
        $lastName = $request->input('lastName');

        $user = Auth::user();

        if (!$firstName && !$lastName) {
            return response(array('firstName' => 'First Name cannot empty.', 'lastName' => 'Last Name cannot empty.'), 400);
        }

        if ($firstName && $user->firstName != $firstName) {
            $user->firstName = $firstName;
            $user->save();
        }

        if ($lastName && $user->lastName != $lastName) {
            $user->lastName = $lastName;
            $user->save();
        }

        return $user;
    }

    public function patchEmail(Request $request) {
        $validation = Validator::make($request->all(), [
            'email' => 'required|email|unique:users',
        ]);

        $errors = $validation->errors();
        if ($validation->fails()) {
            return response($errors->toJson(), 400);
        }

        return Auth::user();
    }

    public function changePassword(Request $request) {
        $validation = Validator::make($request->all(), [
            'password' => 'required',
            'newPassword' => 'required|same:newPassword|min:8',
            'confirmPassword' => 'required|same:newPassword',     
        ]);

        $errors = $validation->errors();
        if ($validation->fails()) {
            return response($errors->toJson(), 400);
        }

        $password = $request->input('password');
        $newPassword = $request->input('newPassword');
        if(!Hash::check($password, Auth::user()->password)) {
            return response(array('password'=> 'Incorrect password.'), 401);            
        }

        if($password == $newPassword) {
            return response(array('newPassword'=> 'New password cannot be same as old password.'), 400);            
        }

        Auth::user()->password = Hash::make($newPassword);
        Auth::user()->save();

        return 'Password changed successfully.';
    }
}
