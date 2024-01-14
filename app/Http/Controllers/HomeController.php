<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
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
            'search' => $searchedItem,
            'cateproducts' => Category::where('status', 'active')->where('deleted_at', null)->limit(7)->get(),

        ];
    
        return view('site.home', $data);
    }
}