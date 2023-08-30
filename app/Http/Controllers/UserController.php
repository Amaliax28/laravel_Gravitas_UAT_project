<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Models\Tester;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index(){

    }

    public function login(){
        if(!Auth::check())
        return view('users.login');
        else
        return back();
    }

    // Show Register User Form
    public function show(){
        return view('users.create');
    }

    // Store New User Data
    public function store(Request $request){
        //dd($request->all());

        $formFields = $request ->validate([
            'email' => ['required','email',Rule::unique('users','email')],
            'username' => ['required','min:4','max:10','regex:/^[a-zA-Z0-9]+$/',Rule::unique('users','username')],
            'password' => ['required','min:6'],
            'roles' => 'required',

        ]);

        // HASH PASSWORD
        $formFields['password'] = bcrypt($formFields['password']);

        // Input image
        if($request->hasFile('userImage')){
            $formFields['userImage'] = $request->file('userImage') -> store('users','public');
        }

        // Create user
        $user = User::create($formFields);

       /* $formFields2 = [
            'user_id' => $user->id,
            'name' => $user->roles
        ];

        Role::create($formFields2);*/


        // Login
        //auth()->login($user);

        return redirect('/')->with('message','User Created Successfully');
    }

    // Show Profile Settings Form
    public function edit(){
        return view('users.edit');
    }

    // Update User Data
    public function update(Request $request, User $user){

        //Check if password is changed
        if($request->filled('password')){
            $formFields = $request ->validate([
                'password' => ['required','confirmed','min:4'],
                'username' => 'required',
                'email' => 'email',
                'roles' => 'required',
            ]);

            // HASH PASSWORD
            $formFields['password'] = bcrypt($formFields['password']);
        }
        else{
            $formFields = $request ->validate([
                'username' => 'required',
                'email' => 'email',
                'roles' => 'required'
            ]);

            // Get existing hashed password
            $existingHashedPassword = $user->password;
            // Assign existing hashed password to the form fields
            $formFields['password'] = $existingHashedPassword;
        }
        // Input image
        if($request->hasFile('userImage')){
            $formFields['userImage'] = $request->file('userImage') -> store('users','public');
        }
        // Update user
        $user -> update($formFields);

        return back()->with('message','Profile Updated Successfully!');

    }

    // Logout User
    public function logout(Request $request){
        auth()->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login')->with('message','You have been logged out!');
    }

    //Login User
    public function authenticate(Request $request){
        if(!Auth::check()){
            $formFields = $request ->validate([
                'username' => 'required',
                'password' => 'required'
            ]);

            if(auth()->attempt($formFields)){
                $request->session()->regenerate();
                return redirect('/all-projects')->with('message','You are now logged in');
            }

            return back()->withErrors(['password'=>'Invalid Credentials'])->onlyInput('username');
        }
        else
            return back()->with('message','You have been logged in');



    }


}

