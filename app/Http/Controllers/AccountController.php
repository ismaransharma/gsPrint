<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
{
    
    public function showPasswordForm()
    {
        return view('account.password');
    }

    public function updatePassword(Request $request)
    {
        // Validate the form data
        $request->validate([
            'new_password' => 'required|min:8|confirmed', 
        ]);

        // dd($request->all());
    
        // Get the authenticated user
        $user = Auth::user();
    
        // Update the user's password
        $user->password = bcrypt($request->new_password);
        $user->save();
    
        // Redirect the user to a success page or another appropriate route
        return redirect('/')->with('success', 'Password updated successfully.');
    }
    
    
}