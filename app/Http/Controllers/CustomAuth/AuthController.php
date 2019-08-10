<?php

namespace App\Http\Controllers\CustomAuth;

use App\Category;
use App\Http\Controllers\Controller;
use App\User;
use App\Utils\SEO;
use Auth;
use Hash;
use Illuminate\Http\Request;
use Socialite;

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
        $user->avatar = User::getDefaultAvatar();
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

    /**
     * Redirect the user to the Facebook authentication page.
     *
     * @return \Illuminate\Http\Response
     */
    public function facebookRedirect()
    {
        return Socialite::driver('facebook')->redirect();
    }

    /**
     * Obtain the user information from Facebook.
     *
     * @return \Illuminate\Http\Response
     */
    public function facebookCallback()
    {
        $socialUser = Socialite::driver('facebook')->user();

        $user = User::where('facebook_id', $socialUser->getId())->first();

        if (!$user) {
            $withSameEmail = User::where('email', $socialUser->getEmail())->count();
            if ($withSameEmail) {
                return redirect('/login')->withErrors(array('oAuth' => 'User with this email already exists.'));
            }
            $names = explode(' ', $socialUser->getName());
            $firstName = $names[0];
            $lastName = sizeof($names) > 1 ? $names[1] : null;
            $fb_id = $socialUser->getId();
            $user = User::create([
                'email' => $socialUser->getEmail(),
                'firstName' => $firstName,
                'lastName' => $lastName,
            ]);
            $user->facebook_id = $fb_id;
            $user->social_email = $socialUser->getEmail();
            $user->save();
        }

        Auth::login($user);

        return redirect('/');
    }

    /**
     * Redirect the user to the Google authentication page.
     *
     * @return \Illuminate\Http\Response
     */
    public function googleRedirect()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Obtain the user information from Google.
     *
     * @return \Illuminate\Http\Response
     */
    public function googleCallback()
    {
        $socialUser = Socialite::driver('google')->user();

        $user = User::where('google_id', $socialUser->getId())->first();

        if (!$user) {
            $withSameEmail = User::where('email', $socialUser->getEmail())->count();
            if ($withSameEmail) {
                return redirect('/login')->withErrors(array('oAuth' => 'User with this email already exists.'));
            }
            $names = explode(' ', $socialUser->getName());
            $firstName = $names[0];
            $lastName = sizeof($names) > 1 ? $names[1] : null;
            $google_id = $socialUser->getId();
            $user = User::create([
                'email' => $socialUser->getEmail(),
                'firstName' => $firstName,
                'lastName' => $lastName,
            ]);
            $user->google_id = $google_id;
            $user->social_email = $socialUser->getEmail();
            $user->save();
        }

        Auth::login($user);

        return redirect('/');
    }
}
