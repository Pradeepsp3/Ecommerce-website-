<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    //view login page
    public function loginpage(){
        return view('auth.login');
    }

    //view admin panel
    public function adminPanel(){ 
            return view('admin');
    }

    //view register page
    public function registerpage(){
        return view('auth.register');
    }

    //login user
    public function loginAttempt(Request $request){
        $request->validate([
            'email'=>'required|email',
            'password'=>'required'
        ]);

        $email = $request->input('email');
        $password = $request->input('password');

        if(Auth::attempt(['email' => $email, 'password' => $password])){
            $user = User::where('email',$email)->first();
            Auth::login($user);
            if($user->role_as == '1'){
                return redirect('admin')->with(['user'=>$user]);
            }else{
            return redirect('/')->with(['user'=>$user]);
            }
        }
    }

    //Register new user details
    public function registerUser(Request $request)
    {


        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed',
        ]);


        $user = new User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));
        $user->save();

        Auth::login($user);

        return redirect('/')->with(['user'=>$user]);

        }

        // Logout user
        public function logout(){
            Auth::logout();
            return redirect('/');
        }
}
