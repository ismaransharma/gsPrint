<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {

        $data = [
            'categories' => Category::where('deleted_at', null)->orderby('id','asc')->get(),
            'products' => Product::where('deleted_at', null)->orderby('id','asc')->get(),
        ];

        return view('admin.adminHome', $data);
    }

    public function manageAboutUs()
    {
        return view('admin.aboutUs.manageAboutUs');
    }

    public function manageContactUs()
    {
        return view('admin.contactUs.manageContactUs');
    }

    public function manageCategory()
    {

        $data = [
            'categories' => Category::where('deleted_at', null)->orderby('id','asc')->get(),
        ];

        return view('admin.category.manageCategory', $data);
    }

    public function getEditCategory($slug)
    {

        $category = Category::where('slug', $slug)->where('deleted_at', null)->limit(1)->first();
        if (is_null ($category)) {
            return redirect()->back()->with('error', 'Category not found');
        }

        
        $data = [
            'category' => $category
        ];

        return view('admin.category.editCategory', $data);
    }

    public function ManageProducts()
    {
        $data = [
            'categories' => Category::where('deleted_at', null)->orderby('id','asc')->get(),

            'products' => Product::where('deleted_at', null)->orderby('id', 'asc')->get(),
        ];

        return view('admin.product.manageProduct',$data);
    }

    public function getEditProduct($slug)
    {
        $data = [
            'product' => Product::where('slug', $slug)->where('deleted_at', null)->first(),
            'categories' => Category::where('deleted_at', null)->get(),
        ];

        return view('admin.product.editProduct', $data);
    }

    public function manageOrders()
    {

        $order = Order::where('deleted_at', null)->get();

        $data = [
            'orders' => $order,
        ];

        return view('admin.orders.manageOrders', $data);
    }





}