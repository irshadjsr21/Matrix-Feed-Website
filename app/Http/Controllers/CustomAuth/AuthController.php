<?php

namespace App\Http\Controllers\CustomAuth;

use App\Category;
use App\Http\Controllers\Controller;
use App\User;
use App\Utils\SEO;
use Auth;
use Hash;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function loginPage(Request $request)
    {
        $data = array(
            'SEO' => SEO::home($request->url()),
            'categories' => Category::all(),
        );
        return view('auth.login', $data);
    }

    public function login(Request $request)
    {
        //validate the fields....
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);

        $credentials = ['email' => $request->email, 'password' => $request->password];

        $redirectUrl = $request->redirect;

        if (Auth::attempt($credentials, $request->remember)) {
            if ($redirectUrl) {
                return redirect($redirectUrl);
            }
            return redirect('/');
        }

        $data = array(
            'SEO' => SEO::home($request->url()),
            'categories' => Category::all(),
            'authError' => 'Invalid email or password.',
        );
        return response()->view('auth.login', $data, 401);
    }

    public function signupPage(Request $request)
    {
        $data = array(
            'SEO' => SEO::home($request->url()),
            'categories' => Category::all(),
        );
        return view('auth.signup', $data);
    }

    public function signup(Request $request)
    {
        $request->validate([
            'firstName' => ['required', 'string', 'max:255'],
            'lastName' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $password = Hash::make($request->password);

        $user = new User;
        $user->firstName = $request->firstName;
        $user->lastName = $request->lastName;
        $user->email = $request->email;
        $user->password = $password;
        $user->type = User::DEFAULT_TYPE;
        $user->save();

        Auth::login($user, true);
        $redirectUrl = $request->redirect;
        if ($redirectUrl) {
            return redirect($redirectUrl);
        }
        return redirect('/');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
