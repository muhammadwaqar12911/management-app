<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use Hash;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email|max:255',
            'password' => 'required|min:8|max:255'
        ]);
        
        $user=User::where('email', $request->email)->first();
        if($user)
        {
            if(Hash::check($request->password, $user->password))
            {
                Auth::login($user, true);
                return redirect('dashboard');
            }
            else
            {
                return back()->with('password_error', '* incorrect password');
            }
        }
        else
        {
            return back()->with('email_error', '* user not found');
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect('login');
    }
}
