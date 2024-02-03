<?php

namespace App\Http\Controllers\Auth;

use App\Models\Cart;
use App\Models\Product;
use App\Models\Category;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class CustomLoginController extends Controller
{
    use AuthenticatesUsers;

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function showLoginForm()
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

        $searchedItem = session('searchedItem');

    
        $data = [
            'categories' => Category::where('status', 'active')->where('deleted_at', null)->limit(3)->get(),
            'products' => Product::where('status', 'active')->where('deleted_at', null)->limit(3)->get(),
            'carts' => $carts, 
            'cartCount' => $cartCount, 
            'total_amount' => $total_amount,
            'user' => $user,
            'search' => $searchedItem
        ];

        return view('auth.login', $data);
    }

    public function showRegisterForm()
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

        $searchedItem = session('searchedItem');

    
        $data = [
            'categories' => Category::where('status', 'active')->where('deleted_at', null)->limit(3)->get(),
            'products' => Product::where('status', 'active')->where('deleted_at', null)->limit(3)->get(),
            'carts' => $carts, 
            'cartCount' => $cartCount, 
            'total_amount' => $total_amount, 
            'user' => $user,
            'search' => $searchedItem
        ];

        return view('auth.register', $data);
    }
}