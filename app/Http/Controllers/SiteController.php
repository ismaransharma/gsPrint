<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Laravel\Socialite\Facades\Socialite;


class SiteController extends Controller
{

    public function googleLogin()
    {
        return Socialite::driver('google')->redirect();
    }

    public function googleHandle()
    {
        try {
            // Complete the Google OAuth login
            $user = Socialite::driver('google')->user();
    
            // Find or create the user in your application
            $findUser = User::where('email', $user->email)->first();
    
            if (!$findUser) {
                $findUser = new User();
                $findUser->name = $user->name;
                $findUser->email = $user->email;
                $findUser->email_verified_at = now(); // Mark the email as verified
        
                $findUser->save();
    
                // Retrieve the cart count data (similar to how you did in your 'home' controller)
                $user = Auth::user(); // Get the currently authenticated user
    
                if ($user) {
                    $cart_code = $user->cart_code; 
                    $carts = Cart::where('cart_code', $cart_code)->get();

                    $cartCount = $carts->count();
                } else {
                    $cartCount = 0;                 }
    
                // Now you can pass $cartCount to the 'account.password' view
                return view('account.password', compact('findUser', 'cartCount','carts'));
            }
        
    
            Auth::login($findUser);
    
            // Redirect to a specific page or route
            return back()->with('success', 'Logged in successfully!');
        } catch (Exception $e) {
            // Handle exceptions if needed
        }
    }
    
    

        
        
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
    
        $data = [
            'categories' => Category::where('status', 'active')->where('deleted_at', null)->limit(3)->get(),
            'products' => Product::where('status', 'active')->where('deleted_at', null)->limit(3)->get(),
            'carts' => $carts, 
            'cartCount' => $cartCount,
            'total_amount' => $total_amount, 
            'user' => $user,
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
        
        $data = [
            'categories' => Category::where('status', 'active')->where('deleted_at', null)->limit(3)->get(),
            'products' => Product::where('status', 'active')->where('deleted_at', null)->limit(3)->get(),
            'carts' => $carts, 
            'cartCount' => $cartCount,
            'total_amount' => $total_amount, 
            'user' => $user,
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
        
        $data = [
            'categories' => Category::where('status', 'active')->where('deleted_at', null)->limit(3)->get(),
            'products' => Product::where('status', 'active')->where('deleted_at', null)->limit(3)->get(),
            'carts' => $carts, 
            'cartCount' => $cartCount,
            'total_amount' => $total_amount, 
            'user' => $user,
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


        $data = [
            'categories' => Category::where('status', 'active')->where('deleted_at', null)->limit(6)->get(),
            'products' => Product::where('status', 'active')->where('deleted_at', null)->get(),
            'carts' => $carts,
            'cartCount' => $cartCount,
            'total_amount' => $total_amount, 
            'user' => $user,
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

        $data = [
            'product' => Product::where('slug', $slug)->where('status', 'active')->where('deleted_at', null)->limit(1)->first(),
            'carts' => $carts, 
            'cartCount' => $cartCount, 
            'total_amount' => $total_amount, 
            'user' => $user,
        ];

        return view('site.buyNow', $data);
    }

    function search(Request $request)
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

        // dd($cart_code);

        
        $data = [
            'carts' => $carts, 
            'cartCount' => $cartCount, 
            'total_amount' => $total_amount, 
        ];
        
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
    
        $data = [
            'carts' => $carts,
            'cartCount' => $cartCount, 
            
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
            $carts = collect(); // Create an empty collection if the user is not authenticated
            $cartCount = 0; // Set the count to 0
            $total_amount = 0; // Set the total amount to 0 if the user is not authenticated
        }



    
        if (!$cart_code) {
            return redirect()->back()->with('error', 'No cart found to checkout');
        }
    
        // Check if the cart code exists in the database
        $carts = Cart::where('cart_code', $cart_code)->get();
    
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
        $order->payment_amount = $payment_amount;
    
        // dd($order->user_id);


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
            $message->from('boyg5729@gmail.com', 'Gs Print');
            $message->sender('boyg5729@gmail.com', 'Gs Print');
            $message->to($maildata['email'], $maildata['name']);
            $message->subject('Your Order has been Successfully Placed!');
            $message->priority(1);
        });
        
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

            // dd($userCartIds);
        
            // Delete carts associated with the user
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

    

    public function postAddToCart(Request $request, $slug)
    {
        // Validate the quantity input
        $request->validate([
            'quantity' => 'required|integer|min:1|max:10',
        ]);
    
        // Find the product based on the slug
        $product = Product::where('slug', $slug)
            ->where('deleted_at', null)
            ->where('status', 'active')
            ->first();
    
        if (is_null($product)) {
            return redirect()->back()->with('error', 'Product not found.');
        }
    
        $quantity = $request->input('quantity');
    
        $stock = $product->stock;
        $new_stock = $stock - $quantity;
    
        if ($new_stock < 1) {
            return redirect()->back()->with('error', 'Product is out of stock');
        }
    
        $user = Auth::user();
        $cart_code = Session::get('cart_code');
    
        if (is_null($cart_code)) {
            // Generate a new cart_code only if it doesn't exist in the session
            $cart_code = Str::random(8);
            session(['cart_code' => $cart_code]);
        }
    
        // Now, you can proceed to create a new Cart record
        $price = $product->total;
        $total_price = $quantity * $price;
    
        $cart = new Cart;
        $cart->cart_code = $cart_code;
        $cart->user_id = $user->id;
        $cart->product_id = $product->id;
        $cart->quantity = $quantity;
        $cart->price = $price;
        $cart->total_price = $total_price;
        $cart->save();

        $user->cart_code = $cart->cart_code;
        $user->save();
    
        // Update the product's stock
        $product->stock = $new_stock;
        $product->save();
    
        return redirect()->back()->with('success', 'Product added to cart');
    }
    

    

    public function getUpdateCart(Request $request, $id)
    {
        // Get the currently authenticated user
        $user = Auth::user();
    
        $cart_code = $user->cart_code; // Assuming you have a 'cart_code' field in your User model
    
        $cart = Cart::where('cart_code', $cart_code)->where('id', $id)->first();
    
        if (is_null($cart)) {
            return redirect()->back()->with('error', 'Cart not found');
        }
    
        $request->validate([
            'quantity' => 'required|integer|min:1|max:5',
        ]);
    
        $product = $cart->getProductFromCart;
    
        $quantity = $request->input('quantity');
        $product_stock = $product->stock + $cart->quantity;
        $new_stock = $product_stock - $quantity;
    
        if ($new_stock < 1) {
            return redirect()->back()->with('error', 'Product is out of stock');
        }
    
        $price = $product->total;
        $total_price = $quantity * $price;
    
        $cart->quantity = $quantity;
        $cart->price = $price;
        $cart->total_price = $total_price;
        $cart->save();
    
        $product->stock = $new_stock;
        $product->save();
    
        return redirect()->back()->with('success', 'Cart Updated Successfully');
    }
    

    public function getDeleteCart($id)
    {
        // Get the currently authenticated user
        $user = Auth::user();
        
        $cart_code = $user->cart_code; // Assuming you have a 'cart_code' field in your User model
        
        $cart = Cart::where('cart_code', $cart_code)->where('id', $id)->first();
        
        if (is_null($cart)) {
            return redirect()->back()->with('error', 'Cart not found');
        }
        
        $product = $cart->getProductFromCart;
        $new_stock = $product->stock + $cart->quantity;
        $product->stock = $new_stock;
        // dd($product);
        $product->save();
    
        $cart->delete();
        return redirect()->back()->with('success', 'Cart Deleted Successfully!');
    }


    
}