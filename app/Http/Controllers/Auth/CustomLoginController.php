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
        $user = Auth::user(); // Get the currently authenticated user
    
        if ($user) {
            $cart_code = $user->cart_code; // Assuming you have a 'cart_code' field in your User model
            $carts = Cart::where('cart_code', $cart_code)->get(); // Retrieve the user's cart items
            $cartCount = $carts->count(); // Get the count of cart items
    
            // Calculate the total amount from the cart items
            $total_amount = $carts->sum('total_price');
        } else {
            $carts = collect(); // Create an empty collection if the user is not authenticated
            $cartCount = 0; // Set the count to 0
            $total_amount = 0; // Set the total amount to 0 if the user is not authenticated
        }

        $searchedItem = session('searchedItem');

    
        $data = [
            'categories' => Category::where('status', 'active')->where('deleted_at', null)->limit(3)->get(),
            'products' => Product::where('status', 'active')->where('deleted_at', null)->limit(3)->get(),
            'carts' => $carts, // Pass the carts to the view
            'cartCount' => $cartCount, // Pass the cart count to the view
            'total_amount' => $total_amount, // Pass the total amount to the view
            'user' => $user,
            'search' => $searchedItem
        ];

        return view('auth.login', $data);
    }

    public function showRegisterForm()
    {
        $user = Auth::user(); // Get the currently authenticated user
    
        if ($user) {
            $cart_code = $user->cart_code; // Assuming you have a 'cart_code' field in your User model
            $carts = Cart::where('cart_code', $cart_code)->get(); // Retrieve the user's cart items
            $cartCount = $carts->count(); // Get the count of cart items
    
            // Calculate the total amount from the cart items
            $total_amount = $carts->sum('total_price');
        } else {
            $carts = collect(); // Create an empty collection if the user is not authenticated
            $cartCount = 0; // Set the count to 0
            $total_amount = 0; // Set the total amount to 0 if the user is not authenticated
        }

        $searchedItem = session('searchedItem');

    
        $data = [
            'categories' => Category::where('status', 'active')->where('deleted_at', null)->limit(3)->get(),
            'products' => Product::where('status', 'active')->where('deleted_at', null)->limit(3)->get(),
            'carts' => $carts, // Pass the carts to the view
            'cartCount' => $cartCount, // Pass the cart count to the view
            'total_amount' => $total_amount, // Pass the total amount to the view
            'user' => $user,
            'search' => $searchedItem
        ];

        return view('auth.register', $data);
    }
}