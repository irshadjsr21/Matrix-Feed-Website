<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use App\Utils\GeneratePassword;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class AuthorController extends Controller
{
    public function __construct()
    {
        $this->middleware('is_admin');
    }

    public function listAuthor()
    {
        $authors = User::where('type', User::AUTHOR_TYPE)->orderBy('created_at', 'desc')->paginate(10);
        return view('admin.author.index')->with('authors', $authors);
    }

    public function showAuthor(Request $request, $id)
    {
        $author = User::where([['id', $id], ['type', User::AUTHOR_TYPE]])->first();
        $data = array(
            'author' => $author,
        );

        return view('admin.author.show')->with($data);
    }

    public function editAuthorPage(Request $request, $id)
    {
        $author = User::where([['id', $id], ['type', User::AUTHOR_TYPE]])->first();
        return view('admin.author.edit')->with('author', $author);
    }

    public function editAuthor(Request $request, $id)
    {
        $request->validate([
            'firstName' => ['required', 'string', 'max:255'],
            'lastName' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'about' => ['nullable', 'string'],
            'password' => ['nullable', 'string', 'min:8'],
        ]);

        $email = $request->input('email');
        $password = $request->input('password');
        $author = User::where([['id', $id], ['type', User::AUTHOR_TYPE]])->first();

        $authors = User::where('email', $email)->count();
        if ($authors != 0 && $email != $author->email) {
            $error = ValidationException::withMessages(['email' => 'User with this email already exists.']);
            throw $error;
        }

        $author->firstName = $request->firstName;
        $author->lastName = $request->lastName;
        $author->about = $request->about;
        $author->email = $request->email;
        if ($password) {
            $author->password = Hash::make($password);
        }

        $author->save();
        if ($password) {
            $msg = 'Author update and password change successful.';
        } else {
            $msg = 'Author updated successfully! Password remained untouched.';
        }

        $request->session()->flash('success', $msg);

        return redirect('/admin/author');
    }

    public function addAuthorPage()
    {
        return view('admin.author.add');
    }

    public function addAuthor(Request $request)
    {
        $request->validate([
            'firstName' => ['required', 'string', 'max:255'],
            'lastName' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'about' => ['nullable', 'string'],
            'password' => ['nullable', 'string', 'min:8'],
        ]);

        $password;

        if (!$request->input('password')) {
            $password = GeneratePassword::new ();
        } else {
            $password = $request->input('password');
        }

        $author = new User;
        $author->type = User::AUTHOR_TYPE;
        $author->firstName = $request->input('firstName');
        $author->lastName = $request->input('lastName');
        $author->email = $request->input('email');
        $author->about = $request->input('about');
        $author->password = Hash::make($password);

        $author->save();

        $request->session()->flash('success', 'Author added successfully! Please note the password : ' . $password);

        return redirect('/admin/author');
    }

    public function deleteAuthor(Request $request, $id)
    {
        $author = User::where([['id', $id], ['type', User::AUTHOR_TYPE]])->first();

        $author->delete();
        $request->session()->flash('success', 'Author deleted successfully!');
        return redirect('/admin/author');
    }
}
