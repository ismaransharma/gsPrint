<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\User;
use App\Models\Order;
use App\Models\Member;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;


class SiteController extends Controller
{  

    public function home()
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

        $cateProducts = Category::where('status', 'active')->whereHas('products', 
            function ($query) {$query->whereNull('deleted_at');
        })->whereNull('deleted_at')->limit(7)->get();


    
        $data = [
            'categories' => Category::where('status', 'active')->where('deleted_at', null)->limit(3)->get(),
            'products' => Product::where('status', 'active')->where('deleted_at', null)->limit(6)->get(),
            'carts' => $carts, 
            'cartCount' => $cartCount,
            'total_amount' => $total_amount, 
            'user' => $user,
            'search' => $searchedItem,
            'cateproducts' => $cateProducts,
        ];
    
        return view('site.home', $data);
    }
    
    public function contactUs()
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
        
        return view('site.contactUs', $data);
    }

    public function aboutUs()
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
            'members' => Member::where('deleted_at', null)->get(),
        ];
        
        return view('site.aboutUs', $data);
    }

    public function shop()
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
            'categories' => Category::where('status', 'active')->where('deleted_at', null)->limit(6)->get(),
            'products' => Product::where('status', 'active')->where('deleted_at', null)->get(),
            'carts' => $carts,
            'cartCount' => $cartCount,
            'total_amount' => $total_amount, 
            'user' => $user,
            'search' => $searchedItem
        ];
        
        return view('site.shop', $data);
    }

    public function productDetails($slug)
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
            'product' => Product::where('slug', $slug)->where('status', 'active')->where('deleted_at', null)->limit(1)->first(),
            'carts' => $carts, 
            'cartCount' => $cartCount, 
            'total_amount' => $total_amount, 
            'user' => $user,
            'search' => $searchedItem
        ];

        return view('site.buyNow', $data);
    }

    public function search(Request $request)
    {

        // dd($request->all());
        
        if ($request->input('search') == null) 
        {   
            
            $search = $request->input('search');
            if ($search === null) {
                $search = 'null';
                session(['searchedItem' => null]);
                return back()->with('error','Please enter any product name');
            } else {
                session(['searchedItem' => $search]);
            }
            
        }
        
        else
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


            $search = $request->input('search');
            if ($search === null) {
                $search = 'null';
                session(['searchedItem' => null]);
            } else {
                session(['searchedItem' => $search]);
            }
            


            $products = Product::where('product_title', 'like', '%' . $search . '%')->get();
            $categories = Category::where('category_title', 'like', '%' . $search . '%')->get();
            $matchingCategoryProducts = [];
            
            foreach ($categories as $category) {
                $categoryProducts = $category->products;
            
                foreach ($categoryProducts as $product) {
                    $matchingCategoryProducts[] = $product;
                }
            }
            
            $mergedProducts = $products->concat($matchingCategoryProducts)->unique('id');
            
            if ($products != $mergedProducts) {
                $products = $mergedProducts;
            }
            
            $data = [
                'search' => $search,
                'products' => $products, 
                'mergedProducts' => $mergedProducts, 
                'carts' => $carts, 
                'cartCount' => $cartCount,
                'total_amount' => $total_amount, 
                'user' => $user,

            ];
            
            if ($products->isEmpty()) {
                return back()->with('error', 'Products not found');
            } else {
                return view('site.search', $data);
            }
        }

        


    }

    public function cateShop($id)
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

        $Category = Category::where('id', $id)->where('status', 'active')->where('deleted_at', null)->get();
        $Product = Product::where('category_id',$id)->where('deleted_at', null)->get();
        $searchedItem = session('searchedItem');

        $allCate = Category::where('status', 'active')->where('deleted_at',null)->get();

        
        $data = [
            'category' => $Category,
            'products' => $Product,
            'search' => $searchedItem,
            'carts' => $carts,
            'cartCount' => $cartCount,
            'categories' => $allCate
        ];
        
        // dd($data);


        return view('site.cateShop',$data);
        
    }

    // Cart 
    public function getCart()
    {
        $user = Auth::user(); 

    
        // dd($user->cart_code);
    
        
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


        // dd($cart_code);

        
        $data = [
            'carts' => $carts, 
            'cartCount' => $cartCount, 
            'total_amount' => $total_amount, 
            'search' => $searchedItem,
        ];
        
        $seachedItem = $this->home();

        return view('site.go-to-cart', $data);
    }

    public function getProceedToCheckout()
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
            'carts' => $carts,
            'cartCount' => $cartCount, 
            'search' => $searchedItem,
            
        ];
    
        return view('site.checkout', $data);
    }


    public function postCheckout(Request $request)
    {
        $user = Auth::user(); 
    
        if ($user) {
            $cart_code = $user->cart_code;
            // dd($cart_code);
            $carts = Cart::where('cart_code', $cart_code)->get(); 
            $cartCount = $carts->count(); 
    
            $total_amount = $carts->sum('total_price');
        } else {
            $carts = collect();
            $cartCount = 0; 
            $total_amount = 0; 
        }

        
        if (!$cart_code) {
            return redirect()->back()->with('error', 'No cart found to checkout');
        }
    
        $carts = Cart::where('cart_code', $cart_code)->get();      
                
        foreach ($carts as $cart) {
            $quantity = $cart->quantity;
            $price2 = $cart->price2;
            $price = $cart->total_price;
            $upload_design = $cart->upload_design;
        }
        
        // dd($upload_design);
        
        if ($carts->isEmpty()) {
            return redirect()->back()->with('error', 'No cart found to checkout');
        }
        
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'address' => 'required',
            'mobile_number' => ['required', 'regex:/^(98|97)[0-9]{8}/', 'min:10', 'max:10',],
            'payment_method' => 'required|in:cod',
        ]);

        foreach($carts as $cart)
        {
            $product_name = $cart->getProductFromCart->product_title;          
        }

        $total = $price;
        // dd($price);
        
        $perPrice = $price / $quantity;

        
        $name = $request->input('name');
        $email = $request->input('email');
        $address = $request->input('address');
        $mobile_number = $request->input('mobile_number');
        $payment_method = $request->input('payment_method');
        $additional_information = $request->input('additional_information');

        
    
        $payment_amount = $carts->sum('total_price') + 150;
    
        $order = new Order;
        $order->name = $name;
        $order->cart_code = $cart_code;
        $order->user_id = $user->id; 
        $order->user_name = $user->name; 
        $order->email = $email;
        $order->address = $address;
        $order->mobile_number = $mobile_number;
        $order->additional_information = $additional_information;
        $order->payment_method = $payment_method;
        $order->payment_status = 'N';
        $order->product_name = $product_name;
        $order->quantity = $quantity;
        $order->payment_amount = $payment_amount;
        $order->price = $perPrice;
        $order->total = $total;
        $order->upload_design = $upload_design;
        $order->price2 = $price2;


        // dd($order);
        $order->save();
    
        // Mail Pathauni logic
    
        $order = Order::find($order->id);
    
        $orderItemsHTML = '<ol>';
        foreach ($carts as $cart_items) {
            $orderItemsHTML .= '<li><b>' . $cart_items->getProductFromCart->product_title . ': </b><span>' . $cart_items->quantity . ' * ' . $cart_items->price . '</span></li>';
        }
        $orderItemsHTML .= '</ol';
    
        $maildata = [
            'name' => $name,
            'email' => $email,
            'order_code' => $cart_code,
            'order_date' => $order->created_at->format("d M, Y H:i:s"),
            'total_price' => $carts->sum('total_price'),
            'shipping_charge' => 150.00,
            'grand_total' => $order->payment_amount,
            'order_items' => $orderItemsHTML
        ];
    
        
        Mail::send('email.order', $maildata, function ($message) use ($maildata) {
            $message->from('smaransharma90@gmail.com', 'Gs Print');
            $message->sender('smaransharma90@gmail.com', 'Gs Print');
            $message->to($maildata['email'], $maildata['name']);
            $message->subject('Your Order has been Successfully Placed!');
            $message->priority(1);
        });
        
        // dd($order);
        
        // dd($cart_code);

        $cart_code = Session::forget('cart_code');

        if ($user) {
            $user->cart_code = null;
            $user->save();
        }

        // Set the cart_code to null for the cart if the cart exists
        if ($carts->isNotEmpty()) {
            // Filter carts by user ID
            $userCartIds = $carts->where('user_id', $user->id)->pluck('id')->all();
            
            Cart::whereIn('id', $userCartIds)->delete();
        }
        

      
        return redirect()->route('getHome')->with('success', 'Order created Successfully');
    }
    
    public function getCartCode() 
    {
        $cart_code = Session::get('cart_code');

        if(is_null($cart_code)){

            $cart_code = Str::random(8);

            dd($user);

            session(['cart_code' => $cart_code]);
            return($cart_code);

        }

        else{
            $check = Order::where('cart_code', $cart_code)->limit(1)->first();

            // Order table ma tyo cart_code xaina cart_code return gardeko

            if(is_null($check)){
                return ($cart_code);
            }

            else{
                $cart_code = Str::random(8);

                return($cart_code);
            }

        }
    }

    public function postAddToCartAndDirectProceedToCheckOut(Request $request, $slug)
    {

        
        $request->validation = ([
            'upload_design' => 'image|mimes:jpeg,jpg,png,gif'
        ]);
        // dd($request->upload_design);
        
        $cart_code = Session::get('cart_code');
        $user = Auth::user();

                
        if (is_null($user)) {
            return redirect()->route('login')->with('error', 'Please log in to buy the Product.');
        }
        
        $product = Product::where('slug', $slug)
        ->where('deleted_at', null)
        ->where('status', 'active')
        ->first();

        if (is_null($product)) {
            return redirect()->back()->with('error', 'Product not found.');
        }
        
        if (is_null($cart_code)) {
            $cart_code = Str::random(8);
            session(['cart_code' => $cart_code]);
        }

        $price2 = $request->input('price2');
        $quantity = $request->input('quantity');
        $image = $request->file('upload_design');
        $price = 0; 
        // dd($image);
        
        if($image){
            
            $unique_name = sha1(time());

            $extension = $image->getClientOriginalExtension();
            
            $design_image = $unique_name . '.' . $extension;
            
            // dd($design_image, $image);

            
            $image->move('uploads/uploadADesign/', $design_image);
            
        }



        if($price2 == 'nrml_price')
        {
            if ($quantity >= $product->qty_range1 && $quantity <= $product->qty_range2) {
                $price = $quantity * $product->nrml_price1;
            }
            elseif ($quantity >= $product->qty_range3 && $quantity <= $product->qty_range4)
            {
                $price = $quantity * $product->nrml_price2;

            }
            else if($quantity >= $product->qty_range5 && $quantity <= $product->qty_range6)
            {
                $price = $quantity * $product->nrml_price3;
            }
            else if($quantity >= $product->qty_range7 && $quantity <= $product->qty_range8)
            {
                $price = $quantity * $product->nrml_price4;
            }
            else if($quantity >= $product->qty_range9 && $quantity <= $product->qty_range10)
            {
                $price = $quantity * $product->nrml_price5;
            }

        }
        else 
        {
            if ($quantity >= $product->qty_range1 && $quantity <= $product->qty_range2) {
                $price = $quantity * $product->urgent_price1;
            }
            elseif ($quantity >= $product->qty_range3 && $quantity <= $product->qty_range4)
            {
                $price = $quantity * $product->urgent_price2;

            }
            else if($quantity >= $product->qty_range5 && $quantity <= $product->qty_range6)
            {
                $price = $quantity * $product->urgent_price3;
            }
            else if($quantity >= $product->qty_range7 && $quantity <= $product->qty_range8)
            {
                $price = $quantity * $product->urgent_price4;
            }
            else if($quantity >= $product->qty_range9 && $quantity <= $product->qty_range10)
            {
                $price = $quantity * $product->urgent_price5;
            }


            
        }
    
        $total_price = $price;

        // dd($total_price);
    
        
        $cart = new Cart;
        $cart->cart_code = $cart_code;
        $cart->user_id = $user->id;
        $cart->product_id = $product->id;
        $cart->price = $price;
        $cart->price2 = $price2;
        $cart->total_price = $total_price;
        $cart->quantity = $quantity;
        
        if($image){
            $cart->upload_design=$design_image;
        }

        $cart->save();

        $user->cart_code = $cart->cart_code;
        $user->save();
    
    
        return redirect()->route('getProceedToCheckout')->with('success', 'Proceeding to Checkout.');
    }

    public function postAddToCart(Request $request, $slug)
    {

        // dd($slug);
        
        $request->validation = ([
            'upload_design' => 'image|mimes:jpeg,jpg,png,gif'
        ]);
        // dd($request->upload_design);
        
        $cart_code = Session::get('cart_code');
        $user = Auth::user();

                
        if (is_null($user)) {
            return redirect()->route('login')->with('error', 'Please log in to add products to the cart.');
        }
        
        $product = Product::where('slug', $slug)
        ->where('deleted_at', null)
        ->where('status', 'active')
        ->limit(1)->first();

        if (is_null($product)) {
            return redirect()->back()->with('error', 'Product not found.');
        }
        
        if (is_null($cart_code)) {
            $cart_code = Str::random(8);
            session(['cart_code' => $cart_code]);
        }

        $price2 = $request->input('price2');
        $quantity = $request->input('quantity');
        $image = $request->file('upload_design');
        $price = 0; 
        // dd($image);
        
        if($image){
            
            $unique_name = sha1(time());

            $extension = $image->getClientOriginalExtension();
            
            $design_image = $unique_name . '.' . $extension;
            
            // dd($design_image, $image);

            
            $image->move('uploads/uploadADesign/', $design_image);
            
        }



        if($price2 == 'nrml_price')
        {
            if ($quantity >= $product->qty_range1 && $quantity <= $product->qty_range2) {
                $price = $quantity * $product->nrml_price1;
            }
            elseif ($quantity >= $product->qty_range3 && $quantity <= $product->qty_range4)
            {
                $price = $quantity * $product->nrml_price2;

            }
            else if($quantity >= $product->qty_range5 && $quantity <= $product->qty_range6)
            {
                $price = $quantity * $product->nrml_price3;
            }
            else if($quantity >= $product->qty_range7 && $quantity <= $product->qty_range8)
            {
                $price = $quantity * $product->nrml_price4;
            }
            else if($quantity >= $product->qty_range9 && $quantity <= $product->qty_range10)
            {
                $price = $quantity * $product->nrml_price5;
            }

        }
        else 
        {
            if ($quantity >= $product->qty_range1 && $quantity <= $product->qty_range2) {
                $price = $quantity * $product->urgent_price1;
            }
            elseif ($quantity >= $product->qty_range3 && $quantity <= $product->qty_range4)
            {
                $price = $quantity * $product->urgent_price2;

            }
            else if($quantity >= $product->qty_range5 && $quantity <= $product->qty_range6)
            {
                $price = $quantity * $product->urgent_price3;
            }
            else if($quantity >= $product->qty_range7 && $quantity <= $product->qty_range8)
            {
                $price = $quantity * $product->urgent_price4;
            }
            else if($quantity >= $product->qty_range9 && $quantity <= $product->qty_range10)
            {
                $price = $quantity * $product->urgent_price5;
            }


            
        }
    
        $total_price = $price;

        // dd($total_price);
    
        
        $cart = new Cart;
        $cart->cart_code = $cart_code;
        $cart->user_id = $user->id;
        $cart->product_id = $product->id;
        $cart->price = $price;
        $cart->price2 = $price2;
        $cart->total_price = $total_price;
        $cart->quantity = $quantity;
        
        if($image){
            $cart->upload_design=$design_image;
        }

        $cart->save();

        $user->cart_code = $cart->cart_code;
        $user->save();
    
    
        return redirect()->back()->with('success', 'Product added to cart');
    }

    
    public function getUpdateCart(Request $request, $id)
    {

        $user = Auth::user();
        $cart_code = $user->cart_code;
                    
        $cart = Cart::where('cart_code', $cart_code)
        ->where('id', $id)
        ->first();

        // dd($cart->price2);

        if (is_null($cart)) {
        return redirect()->back()->with('error', 'Cart not found');
        }

        $request->validate([
        'quantity' => 'required|integer|min:1',
        ]);

        // dd($request->all());


        // $price = 0;

        
        $product = $cart->getProductFromCart;
        
        $quantity = $request->input('quantity');

        $price2 = $cart->price2;
        
        
        if($price2 == 'nrml_price')
        {
            if ($quantity >= $product->qty_range1 && $quantity <= $product->qty_range2) {
                $price = $quantity * $product->nrml_price1;
            }
            elseif ($quantity >= $product->qty_range3 && $quantity <= $product->qty_range4)
            {
                $price = $quantity * $product->nrml_price2;

            }
            else if($quantity >= $product->qty_range5 && $quantity <= $product->qty_range6)
            {
                $price = $quantity * $product->nrml_price3;
            }
            else if($quantity >= $product->qty_range7 && $quantity <= $product->qty_range8)
            {
                $price = $quantity * $product->nrml_price4;
            }
            else if($quantity >= $product->qty_range9 && $quantity <= $product->qty_range10)
            {
                $price = $quantity * $product->nrml_price5;
            }

        }
        else if($price2 == 'urgent_price')
        {
            if ($quantity >= $product->qty_range1 && $quantity <= $product->qty_range2) {
                $price = $quantity * $product->urgent_price1;
            }
            elseif ($quantity >= $product->qty_range3 && $quantity <= $product->qty_range4)
            {
                $price = $quantity * $product->urgent_price2;

            }
            else if($quantity >= $product->qty_range5 && $quantity <= $product->qty_range6)
            {
                $price = $quantity * $product->urgent_price3;
            }
            else if($quantity >= $product->qty_range7 && $quantity <= $product->qty_range8)
            {
                $price = $quantity * $product->urgent_price4;
            }
            else if($quantity >= $product->qty_range9 && $quantity <= $product->qty_range10)
            {
                $price = $quantity * $product->urgent_price5;
            }
        }
        else
        {
            return back()->with('error', 'Invalid quantity');
        }
        
        // dd($price);
        
        $total_price = $price;
        // dd($total_price);
    
        $cart->quantity = $quantity;
        $cart->price = $price;
        $cart->total_price = $total_price;
        $cart->save();
    
        return redirect()->back()->with('success', 'Cart Updated Successfully');
    }
    
    public function getDeleteCart($id)
    {
        // Get the currently authenticated user
        $user = Auth::user();
        
        $cart_code = $user->cart_code; 
        
        $cart = Cart::where('cart_code', $cart_code)->where('id', $id)->first();
        
        if (is_null($cart)) {
            return redirect()->back()->with('error', 'Cart not found');
        }
        
        $product = $cart->getProductFromCart;
        // dd($product);
        $product->save();
    
        $cart->delete();
        return redirect()->back()->with('success', 'Cart Deleted Successfully!');
    }
    
    public function getDeleteAllCart()
    {
        $user = Auth::user();
    
        if (!$user) {
            return redirect()->back()->with('error', 'User not authenticated');
        }
    
        $cart_code = $user->cart_code;
        $cartItems = Cart::where('cart_code', $cart_code)->get();
    
        if ($cartItems->isEmpty()) {
            return redirect()->back()->with('error', 'Cart is already empty');
        }
    
        foreach ($cartItems as $cartItem) {
            $cartItem->delete();
        }
    
        return redirect()->back()->with('success', 'Cart deleted successfully!');
    }

    public function getAccDashboard()
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
            'search' => $searchedItem,
            'cartCount' => $cartCount,
            'user' => $user,
            'carts' => $carts

        ];

        return view('site.myAccount.myAccDashboard', $data);
    }


    public function getYourOrder()
    {
        $user = Auth::user();
    
        if ($user) {
            $cart_code = $user->cart_code;
            $carts = Cart::where('cart_code', $cart_code)->get();
            $cartCount = $carts->count();
            $total_amount = $carts->sum('total_price');
    
            // dd($cart_code);

            $orders = Order::where('user_id', $user->id)->get();
            
            // dd($orders);

            $searchedItem = session('searchedItem');

    
            $data = [
                'cartCount' => $cartCount,
                'user' => $user,
                'search' => $searchedItem,
                'orders' => $orders,
            ];
    
            return view('site.myAccount.yourOrder', $data);
        } else {
            // Handle the case when the user is not logged in
            return redirect()->route('login')->with('error', 'You need to log in to view your orders.');
        }
    }
    


    
}