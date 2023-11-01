<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

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
        $data = [
            'categories' => Category::where('status', 'active')->where('deleted_at', null)->limit(3)->get(),
            'products' => Product::where('status', 'active')->where('deleted_at', null)->limit(3)->get(),
        ];

        return view('home', $data);
    }
}