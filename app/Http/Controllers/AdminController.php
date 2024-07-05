<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Order;
use App\Models\Member;
use App\Models\Product;
use App\Models\Category;
use App\Models\Position;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
        

    public function dashboard()
    {
        $user = Auth::user();
    
        if ($user->u_a_mngt == 1) {
            $order = Order::where('payment_status', 'Y')->where('deleted_at', null)->get();
            $completed_orders = Order::where('order_status', 'Delivered')->count();
            $pending_orders = Order::where('order_status', 'Pending')->count();
            $shipped_orders = Order::where('order_status', 'Shipped')->count();
            $pOrder = Order::where('order_status', ['Shipped', 'Pending'])->count();
            $total = $order->sum('payment_amount');

            // Total Order Count
            $ttOrder = Order::whereNull('deleted_at')->count();
            
            // Total Order Amount
            $toa = Order::whereNull('deleted_at')->sum('payment_amount');
            $formattedToa = number_format($toa, 0);

            // Last Month total revenue
            $lastMonthStart = Carbon::now()->subMonth()->startOfMonth();
            $lastMonthEnd = Carbon::now()->subMonth()->endOfMonth();

            $lastMonthRevenue = Order::whereNull('deleted_at')
                ->whereBetween('created_at', [$lastMonthStart, $lastMonthEnd])
                ->sum('payment_amount');

                // Current Month Revenue
            $currentMonthStart = Carbon::now()->startOfMonth();
            $currentMonthEnd = Carbon::now()->endOfMonth();
            $currentMonthRevenue = Order::whereNull('deleted_at')
            ->whereBetween('created_at', [$currentMonthStart, $currentMonthEnd])
            ->sum('payment_amount');


            // Recent Orders
            $recentOrder = Order::whereNull('deleted_at')->orderBy('id', 'desc')->limit(4)->get();

    
            $orderStatusCounts = Order::whereNull('deleted_at')
                ->select('order_status', DB::raw('count(*) as count'))
                ->groupBy('order_status')
                ->get();
    
            $orderStatusData = [
                ['Order Status', 'Order Status Count']
            ];
    
            foreach ($orderStatusCounts as $statusCount) {
                $orderStatusData[] = [$statusCount->order_status, $statusCount->count];
            }
    
            $data = [
                'categories' => Category::whereNull('deleted_at')->orderBy('id', 'asc')->get(),
                'products' => Product::whereNull('deleted_at')->orderBy('id', 'asc')->get(),
                'Orders' => Order::where('payment_status', 'Y')->whereNull('deleted_at')->count(),
                'completed_order' => $completed_orders,
                'pending_order' => $pending_orders,
                'shipped_order' => $shipped_orders,
                'user' => $user->name,
                'totalEarnings' => $total,
                'orderStatusData' => $orderStatusData, 
                'ttOrders' => $ttOrder,
                'pOrders' => $pOrder,
                'toas' => $formattedToa,
                'lastMonthRevenue' => number_format($lastMonthRevenue, 0),
                'currentMonthRevenue' => number_format($currentMonthRevenue, 0),
                'recentOrders' => $recentOrder,
            ];
    
            return view('admin.adminHome', $data);
        } else {
            return redirect('/login')->with('error', 'Please Login as Admin');
        }
    }
    
    


    public function manageAboutUs()
    {

        $position = Position::where('deleted_at', null)->get();
        $member = Member::where('deleted_at', null)->get();

        $data = [
            'positions' => $position,
            'members' => $member,
        ];

        return view('admin.aboutUs.manageAboutUs', $data);
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
        
         $allOrders = Order::all();
         
         $deliveredOrders = Order::where('order_status', 'Delivered')->get();
         
         $pendingOrders = Order::where('order_status', 'Pending')->get();
         
         $shippedOrders = Order::where('order_status', 'Shipped')->get();
         
         $cancelledOrders = Order::where('order_status', 'Cancelled')->get();
         
         $refundedOrders = Order::where('order_status', 'Refunded')->get();

        //  dd($deliveredOrders);

        
        $data = [
            'allOrders' => $allOrders,
            'deliveredOrders' => $deliveredOrders,
            'pendingOrders' => $pendingOrders,
            'cancelledOrders' => $cancelledOrders,
            'refundedOrders' => $refundedOrders,
            'shippedOrders' => $shippedOrders,
            'searchOrder' => $searchedItem,
            'orders' => $order,

        ];

        return view('admin.orders.manageOrders', $data);
    }

    public function postUpdateOrder(Request $request, $id)
    {
        $order = Order::where('id', $id)->limit(1)->first();
        $newOrderStatus = $request->input('order_status');

        if(!($order->id == $id))
        {
            return back()->with("error", "Order not found.");
        }
        else{
            
            $order->order_status = $newOrderStatus;
            // dd($order->order_status);
            $order->save();

            return back()->with("success","Order Status updated to $newOrderStatus successfully.");

        }
     

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

                    
            $allOrders = Order::all();
            
            $deliveredOrders = Order::where('order_status', 'Delivered')->get();
            
            $pendingOrders = Order::where('order_status', 'Pending')->get();
            
            $shippedOrders = Order::where('order_status', 'Shipped')->get();
            
            $cancelledOrders = Order::where('order_status', 'Cancelled')->get();
            
            $refundOrders = Order::where('order_status', 'Refunded')->get();
        
            if ($orders->isNotEmpty()) {
                return view('admin.orders.searchedOrder', [
                    'searchOrder' => $searchOrder,
                    'orders' => $orders,
                    'allOrders' => $allOrders,
                    'deliveredOrders' => $deliveredOrders,
                    'pendingOrders' => $pendingOrders,
                    'cancelledOrders' => $cancelledOrders,
                    'refundOrders' => $refundOrders,
                    'shippedOrders' => $shippedOrders,
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

    public function __construct()
    {
        $this->middleware('checkUserRole');
    }


    // About Us 

    // Add Memeber Position
    public function postAddPosition(Request $request)
    {
        
        // dd($request->all());
        $request->validate([
            'member_position' => 'string|unique:positions',
        ]);

        
        $member_position = $request->input('member_position');
        
        
        $position = new Position;
        
        $position->member_position = $member_position; 
        

        $position->save();
        return redirect()->back()->with('success', 'Member Position Added Successfully...');
    }

    // Edit Memeber Position
    public function postEditMemberPosition(Request $request,$id)
    {
        
        // dd($id);


        
        $position = Position::where('id', $id)->where('deleted_at', null)->limit(1)->first();

        if (is_null ($position)) {
            return redirect()->back()->with('error', 'Position not found');
        }



        $request->validate([
            'member_position' => 'string',
        ]);

        
        $member_position = $request->input('member_position');

        // dd($member_position);
        
        
        
        $position->member_position = $member_position; 
        

        $position->save();
        return redirect()->back()->with('success', 'Member Position Edited Successfully...');
    }

    // Delete Member Position
    public function getDeleteMemberPosition(){
        
    }

    // Add Members
    public function postAddMember(Request $request)
    {
        // dd($request->all());
        
        $request->validate([
            'member_name' => 'required|string',
            'member_position_id' => 'required|integer|exists:positions,id',
            'member_image' => 'required|image|mimes:jpeg,jpg,png,gif',
            'member_number' => 'required|integer',
            'member_facebook' => 'required|string',
            'member_email' => 'required',
        ]);

        $member_name = $request->input('member_name');
        $member_number = $request->input('member_number');
        $member_facebook = $request->input('member_facebook');
        $member_email = $request->input('member_email');
        
        $position_id = $request->input('member_position_id');
        
        $position = Position::where('id', $position_id)->where('deleted_at',null)->limit(1)->first();
        
        // dd($position);

        if(!$position_id ){
            return redirect()->back()->with('error', 'Member Position Not Found!!!');
        }
        
        $image = $request->file('member_image');
        
        if($image)
        {
            $unique_name = sha1(time());
            $extension = $image->getClientOriginalExtension();
            $member_image = $unique_name . '.' . $extension;

            $image->move('uploads/members/', $member_image);
            
        }
        // dd($image);
        
        $member = new Member;

        $member->member_name = $member_name;
        $member->member_position_id = $position_id;
        $member->member_position_title = $position->member_position;
        $member->member_number = $member_number;
        $member->member_facebook = $member_facebook;
        $member->member_email = $member_email;

        
        if($image){
            $member->member_image=$member_image;
        }
        
        $member->save();
        return back()->with('success', 'Member Added Successfully!');

    }


}