<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AccountController extends Controller
{
    
    public function showPasswordForm()
    {
        return view('account.password');
    }

    public function edit()
    {
        $user = Auth::user();

        if ($user) {
            $cart_code = $user->cart_code; 
            $carts = Cart::where('cart_code', $cart_code)->get(); 
            $cartCount = $carts->count(); 
    
            $total_amount = $carts->sum('total_price');
        } else {
            $carts = collect(); 
            $cartCount = 0; 
            $total_amount = 0; 
        }
        

        $search = session('searchedItem');

        return view('site.myAccount.myAccDashboard', compact('user', 'search', 'cartCount'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        // dd($user->password);

        $request->validate([
            'name' => 'max:255',
            'email' => 'string|email|max:255|unique:users,email,' . $user->id,
            'current_password' => 'nullable|string',
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $current_password = $request->input('current_password');
        $current_password = trim($current_password);

        if(is_null($current_password)){
            $current_password = $user->password;
        }
        
        if ($current_password && !Hash::check($current_password, $user->password)) {
            return redirect()->route('profile.edit')->with('error', 'The current password is incorrect.');
        }
        
        // dd($current_password);
        
        if ($request->input('password') !== $request->input('password_confirmation')) {
            return redirect()->route('profile.edit')->with('error', 'Confirmation Password is Incorrect.');
        }

        $user->name = $request->input('name');
        $user->email = $request->input('email');

        if ($request->filled('password')) {
            $user->password = Hash::make($request->input('password'));
        }
        $user->save();

        return redirect()->route('profile.edit')->with('success', 'Profile updated successfully!');
    }
    
    
}