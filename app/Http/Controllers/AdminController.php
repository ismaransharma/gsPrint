<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
        
    public function dashboard()
    {
        $user = Auth::user();
        $userName = $user->name;
        
        $order = Order::where('deleted_at', null)->get();

        $total = $order->sum('payment_amount');
        // dd($total);
        
        $data = [
            'categories' => Category::whereNull('deleted_at')->orderBy('id', 'asc')->get(),
            'products' => Product::whereNull('deleted_at')->orderBy('id', 'asc')->get(),
            'Orders' => Order::whereNull('deleted_at')->count(),
            'user' => $userName,
            'totalEarnings' => $total
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
        $searchedItem = session('searchOrder');


        $data = [
            'orders' => $order,
            'searchOrder' => $searchedItem
        ];

        return view('admin.orders.manageOrders', $data);
    }

    public function searchOrder(Request $request)
    {
        
        if ($request->input('searchOrder') === null) {
            return back()->with('error', 'Please enter Cart Code or Name or Email');
        } else {
            $searchOrder = $request->input('searchOrder');
            session(['searchedItem' => $searchOrder]);
        
            $matches = Order::where('cart_code', $searchOrder)->get();
        
            $likelyMatches = Order::where('cart_code', 'like', '%' . $searchOrder . '%')->orWhere('user_name', 'like', '%' . $searchOrder . '%')->orWhere('email', 'like', '%' . $searchOrder . '%')->get();
        
            $orders = $matches->merge($likelyMatches)->unique('id');
        
            if ($orders->isNotEmpty()) {
                return view('admin.orders.searchedOrder', [
                    'searchOrder' => $searchOrder,
                    'orders' => $orders,
                ]);
            } else {
                return back()->with('error', 'No orders found for the specified Cart Code');
            }
        }
        
    }

    public function makePaymentComplete($id)
    {
        $order = Order::where('id', $id)->limit(1)->first();
        if (is_null($order)) {
            return redirect()->back()->with('error', 'Order not found');
        }

        if ($order->payment_status == 'Y') {
            $order->payment_status = 'N';
            $order->save();
        } else {
            $order->payment_status = 'Y';
            $order->save();
        }

        return redirect()->back()->with('success', 'Order payment status changed.');
    }
}