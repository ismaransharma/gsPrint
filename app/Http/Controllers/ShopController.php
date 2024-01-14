<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function postAddCategory(Request $request)
    {
        $request->validate([
            'category_title' => 'required|unique:categories,category_title',
            'category_image' => 'required|image|mimes:jpeg,jpg,png,gif',
            'status' => 'required|in:active,inactive'
        ]);

        // dd($request->all());


        $category_title = $request->input('category_title');
        
        $slug = Str::slug($category_title);

        $status = $request->input('status');
        $image = $request->file('category_image');

        if($image){
            $unique_name = sha1(time());

            $extension = $image->getClientOriginalExtension();

            $category_image = $unique_name . '.' . $extension;

            // dd($category_image, $image);

            $image->move('uploads/category/', $category_image);
            
        }
        
        // dd($image);


        $category = new Category;
        $category->category_title=$category_title;
        $category->status=$status;
        $category->slug=$slug;

        if($image){
            $category->category_image=$category_image;
        }

        $category->save();
        return redirect()->back()->with('success', 'Category Added Successfully...');

    }

    public function getDeleteCategory($slug){
        $category = Category::where('slug', $slug)->where('deleted_at', null)->limit(1)->first();
        if (is_null ($category)) {
            return redirect()->back()->with('error', 'Category not found');
        }
        else
        {
            $category_image_var = Category::where('slug', $slug)->where('deleted_at',null)->limit(1)->first();

            $imagePath = public_path('uploads/category/') . $category_image_var->category_image;

            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
            
            $category->delete();

        }


        return redirect()->back()->with('success', 'Category Deleted Successfully');
    }

    public function postEditCategory(Request $request, $slug){
        {

            $category = Category::where('slug', $slug)->where('deleted_at', null)->limit(1)->first();
            if (is_null ($category)) {
                return redirect()->back()->with('error', 'Category not found');
            
            }   
            $request->validate([
                'category_title' => 'required|unique:categories,category_title,' . $category->id,
                'category_image' => 'image|mimes:jpeg,jpg,png,gif',
                'status' => 'required|in:active,inactive'
            ]);
    
            // dd($request->all());
    
    
            $category_title = $request->input('category_title');

            $slug = Str::slug($category_title);

            $status = $request->input('status');
            $image = $request->file('category_image');
    
            if($image){
                $unique_name = sha1(time());
                
                $extension = $image->getClientOriginalExtension();
                $category_image = $unique_name . '.' . $extension;
    

    
                $image->move('uploads/category/', $category_image);
                if ($category->category_image !=null){
                    unlink('uploads/category/'. $category->category_image);
                }
                
            }
            
            $category->category_title=$category_title;
            $category->status=$status;
            $category->slug=$slug;
    
            if($image){
                $category->category_image = $category_image; 
            }
            
            // dd($image);
    
            $category->save();
            return redirect()->route('getManageCategory')->with('success', 'Category Edited Successfully...');
    
        }
    
    }

    public function postAddProduct(Request $request)
    {
        // dd($request->all());
        
        $request->validate([
            'product_title' => 'required|unique:products,product_title',
            'category_id' => 'required|integer|exists:categories,id',
            'product_image' => 'required|image|mimes:jpeg,jpg,png,gif',
            'status' => 'required|in:active,inactive',
            'size' => 'nullable|in:XS,S,M,L,XL,XXL,ALL',
            'sizeinc' => 'nullable|in:sqft,sqm,cuft,inch,cm,mm,m',
            'sizeincnum1' => 'nullable|numeric|integer',
            'sizeincnum2' => 'nullable|numeric|integer',
            'original_price' => 'nullable|numeric',
            'discount_price'=>'numeric',
            'product_description'=>'required',
            'colour'=>'nullable|string',
            'weight'=>'required|numeric',
            'paper_weight'=>'nullable|integer',
            'paper_type'=>'nullable|in:A1,A2,A3,A4,A5,A6',
            'print_type'=>'nullable|in:multi_colour_print,black_and_white_print',
            'thickness'=>'nullable|numeric',
            'qty_range1' => 'nullable|integer',
            'qty_range2' => 'nullable|integer',
            'qty_range3' => 'nullable|integer',
            'qty_range4' => 'nullable|integer',
            'qty_range5' => 'nullable|integer',
            'qty_range6' => 'nullable|integer',
            'qty_range7' => 'nullable|integer',
            'qty_range8' => 'nullable|integer',
            'qty_range9' => 'nullable|integer',
            'qty_range10' => 'nullable|integer',
            'nrml_price1' => 'nullable|integer|numeric',
            'nrml_price2' => 'nullable|integer|numeric',
            'nrml_price3' => 'nullable|integer|numeric',
            'nrml_price4' => 'nullable|integer|numeric',
            'nrml_price5' => 'nullable|integer|numeric',
            'urgent_price1' => 'nullable|integer|numeric',
            'urgent_price2' => 'nullable|integer|numeric',
            'urgent_price3' => 'nullable|integer|numeric',
            'urgent_price4' => 'nullable|integer|numeric',
            'urgent_price5' => 'nullable|integer|numeric',
            
        ]);

        // dd($request->all());

        
        
        
        $product_title = $request->input('product_title');
        
        $category_id = $request->input('category_id');
        $category = Category::where('id', $category_id)->first();
        if (!$category) {
            return redirect()->back()->with('error', 'Category Not Found');
        }
        
        
        $slug = Str::slug($product_title);
        
        $colour = $request->input('colour');
        $weight = $request->input('weight');
        $paper_weight = $request->input('paper_weight');
        $print_type = $request->input('print_type');
        $paper_type = $request->input('paper_type');
        $thickness = $request->input('thickness');
        $status = $request->input('status');
        $size = $request->input('size');
        $sizeinc = $request->input('sizeinc');
        $sizeincnum1 = $request->input('sizeincnum1');
        $sizeincnum2 = $request->input('sizeincnum2');
        $product_description = $request->input('product_description');
        
        $category_id = $request->input('category_id');
        $category = Category::where('id', $category_id)->where('deleted_at', null)->limit(1)->first();
        
        if (is_null($category)) {
            return redirect()->back()->with('error', 'Category Not Found');
        }
        
        $image = $request->file('product_image');
        $original_price = $request->input('original_price');
        $discount_price = $request->input('discount_price');
        $qty_range1 = $request->input('qty_range1');
        $qty_range2 = $request->input('qty_range2');
        $qty_range3 = $request->input('qty_range3');
        $qty_range4 = $request->input('qty_range4');
        $qty_range5 = $request->input('qty_range5');
        $qty_range6 = $request->input('qty_range6');
        $qty_range7 = $request->input('qty_range7');
        $qty_range8 = $request->input('qty_range8');
        $qty_range9 = $request->input('qty_range9');
        $qty_range10 = $request->input('qty_range10');
        $nrml_price1 = $request->input('nrml_price1');
        $nrml_price2 = $request->input('nrml_price2');
        $nrml_price3 = $request->input('nrml_price3');
        $nrml_price4 = $request->input('nrml_price4');
        $nrml_price5 = $request->input('nrml_price5');
        $urgent_price1 = $request->input('urgent_price1');
        $urgent_price2 = $request->input('urgent_price2');
        $urgent_price3 = $request->input('urgent_price3');
        $urgent_price4 = $request->input('urgent_price4');
        $urgent_price5 = $request->input('urgent_price5');
        

        
        if($image){
            
            $unique_name = sha1(time());

            $extension = $image->getClientOriginalExtension();
            
            $product_image = $unique_name . '.' . $extension;
            
            $image->move('uploads/product/', $product_image);
            
        }

        
        if ($discount_price) {
            $total = $original_price - $discount_price;
        
            // Check if $total is a whole number, and if so, format it without decimal places
            if (floor($total) == $total) {
                $total = number_format($total, 0, '.', ''); // Format as a whole number
            } else {
                $total = number_format($total, 2, '.', ''); // Format with two decimal places
            }
        }
        else
        {
            $total = $original_price;
        }

        
        
        $product = new Product;

        $product->product_title=$product_title;
        $product->product_description=$product_description;
        $product->category_id=$category_id;
        $product->category_title = $category->category_title;
        $product->status=$status;
        $product->size=$size;
        $product->sizeinc=$sizeinc;
        $product->sizeincnum1=$sizeincnum1;
        $product->sizeincnum2=$sizeincnum2;
        $product->slug=$slug;
        $product->original_price=$original_price;
        $product->discount_price=$discount_price;
        $product->colour=$colour;
        $product->weight=$weight;
        $product->paper_weight=$paper_weight;
        $product->paper_type=$paper_type;
        $product->print_type=$print_type;
        $product->thickness=$thickness;
        $product->total=$total;
        $product->qty_range1=$qty_range1;
        $product->qty_range2=$qty_range2;
        $product->qty_range3=$qty_range3;
        $product->qty_range4=$qty_range4;
        $product->qty_range5=$qty_range5;
        $product->qty_range6=$qty_range6;
        $product->qty_range7=$qty_range7;
        $product->qty_range8=$qty_range8;
        $product->qty_range9=$qty_range9;
        $product->qty_range10=$qty_range10;
        $product->nrml_price1=$nrml_price1;
        $product->nrml_price2=$nrml_price2;
        $product->nrml_price3=$nrml_price3;
        $product->nrml_price4=$nrml_price4;
        $product->nrml_price5=$nrml_price5;
        $product->urgent_price1=$urgent_price1;
        $product->urgent_price2=$urgent_price2;
        $product->urgent_price3=$urgent_price3;
        $product->urgent_price4=$urgent_price4;
        $product->urgent_price5=$urgent_price5;
        
        if($image){
            $product->product_image=$product_image;
        }
        
        // dd($product);
        

        $product->save();
        return redirect()->back()->with('success', 'Product Added Successfully...');
        
    }

    public function postEditProduct(Request $request, $slug)
    {

        $product = Product::where('slug', $slug)->where('deleted_at', null)->limit(1)->first();

        if (is_null ($product)) {
            return redirect()->back()->with('error', 'Product not found');
        }
        
        $request->validate([
            'product_title' => 'required|min:3',
            'category_id' => 'exists:categories,id',
            'category_title' => 'exists:categories,category_title',
            'product_image' => 'image|mimes:jpeg,jpg,png,gif',
            'status' => 'in:active,inactive',
            'size' => 'nullable|in:XS,S,M,L,XL,XXL,ALL',
            'sizeinc' => 'nullable|in:sqft,sqm,cuft,inch,cm,mm,m',
            'sizeincnum1' => 'nullable|numeric|integer',
            'sizeincnum2' => 'nullable|numeric|integer',
            'original_price' => 'nullable|numeric',
            'discount_price'=>'numeric',
            'colour'=>'string',
            'weight'=>'integer',
            'paper_weight'=>'nullable|integer|numeric',
            'paper_type'=>'nullable|in:A1,A2,A3,A4,A5,A6',
            'print_type'=>'nullable|in:multi_colour_print,black_and_white_print',
            'thickness'=>'nullable|numeric',
            'qty_range1' => 'nullable|integer',
            'qty_range2' => 'nullable|integer',
            'qty_range3' => 'nullable|integer',
            'qty_range4' => 'nullable|integer',
            'qty_range5' => 'nullable|integer',
            'qty_range6' => 'nullable|integer',
            'qty_range7' => 'nullable|integer',
            'qty_range8' => 'nullable|integer',
            'qty_range9' => 'nullable|integer',
            'qty_range10' => 'nullable|integer',
            'nrml_price1' => 'nullable|integer|numeric',
            'nrml_price2' => 'nullable|integer|numeric',
            'nrml_price3' => 'nullable|integer|numeric',
            'nrml_price4' => 'nullable|integer|numeric',
            'nrml_price5' => 'nullable|integer|numeric',
            'urgent_price1' => 'nullable|integer|numeric',
            'urgent_price2' => 'nullable|integer|numeric',
            'urgent_price3' => 'nullable|integer|numeric',
            'urgent_price4' => 'nullable|integer|numeric',
            'urgent_price5' => 'nullable|integer|numeric',
        ]);


        
        
        $product_title = $request->input('product_title');
        
        $slug = Str::slug($product_title);
        
        
        $category_id = $request->input('category_id');
        $category = Category::where('id', $category_id)->first();
        if (!$category) {
            return redirect()->back()->with('error', 'Category Not Found');
        }
        
        if (is_null($product)) {
            return redirect()->back()->with('error', 'Product Not Found');
        }

        // dd($request->all());

        
        $weight = $request->input('weight');
        $paper_weight = $request->input('paper_weight');
        $print_type = $request->input('print_type');
        $paper_type = $request->input('paper_type');
        $thickness = $request->input('thickness');
        $colour = $request->input('colour');
        $status = $request->input('status');
        $size = $request->input('size');
        $sizeinc = $request->input('sizeinc');
        $sizeincnum1 = $request->input('sizeincnum1');
        $sizeincnum2 = $request->input('sizeincnum2');
        $product_description = $request->input('product_description');
        $image = $request->file('product_image');
        $original_price = $request->input('original_price');
        $discount_price = $request->input('discount_price');
        $qty_range1 = $request->input('qty_range1');
        $qty_range2 = $request->input('qty_range2');
        $qty_range3 = $request->input('qty_range3');
        $qty_range4 = $request->input('qty_range4');
        $qty_range5 = $request->input('qty_range5');
        $qty_range6 = $request->input('qty_range6');
        $qty_range7 = $request->input('qty_range7');
        $qty_range8 = $request->input('qty_range8');
        $qty_range9 = $request->input('qty_range9');
        $qty_range10 = $request->input('qty_range10');
        $nrml_price1 = $request->input('nrml_price1');
        $nrml_price2 = $request->input('nrml_price2');
        $nrml_price3 = $request->input('nrml_price3');
        $nrml_price4 = $request->input('nrml_price4');
        $nrml_price5 = $request->input('nrml_price5');
        $urgent_price1 = $request->input('urgent_price1');
        $urgent_price2 = $request->input('urgent_price2');
        $urgent_price3 = $request->input('urgent_price3');
        $urgent_price4 = $request->input('urgent_price4');
        $urgent_price5 = $request->input('urgent_price5');
    

        
        if($image){
            $unique_name = sha1(time());

            $extension = $image->getClientOriginalExtension();
            
            $product_image = $unique_name . '.' . $extension;
            
            $image->move('uploads/product/', $product_image);

            if ($category->category_image != null){
                unlink('uploads/product/' . $product->product_image);
            }
        }

        if ($discount_price) {
            $total = $original_price - $discount_price;
        
            // Check if $total is a whole number, and if so, format it without decimal places
            if (floor($total) == $total) {
                $total = number_format($total, 0, '.', ''); // Format as a whole number
            } else {
                $total = number_format($total, 2, '.', ''); // Format with two decimal places
            }
        }
        else
        {
            $total = $original_price;
        }

        $product->product_title=$product_title;
        $product->product_description=$product_description;
        $product->category_id=$category_id;
        $product->category_title = $category->category_title;
        $product->status=$status;
        $product->size=$size;
        $product->sizeinc=$sizeinc;
        $product->sizeincnum1=$sizeincnum1;
        $product->sizeincnum2=$sizeincnum2;
        $product->slug=$slug;
        $product->original_price=$original_price;
        $product->discount_price=$discount_price;
        $product->colour=$colour;
        $product->weight=$weight;
        $product->paper_weight=$paper_weight;
        $product->paper_type=$paper_type;
        $product->print_type=$print_type;
        $product->thickness=$thickness;
        $product->qty_range1=$qty_range1;
        $product->qty_range2=$qty_range2;
        $product->qty_range3=$qty_range3;
        $product->qty_range4=$qty_range4;
        $product->qty_range5=$qty_range5;
        $product->qty_range6=$qty_range6;
        $product->qty_range7=$qty_range7;
        $product->qty_range8=$qty_range8;
        $product->qty_range9=$qty_range9;
        $product->qty_range10=$qty_range10;
        $product->nrml_price1=$nrml_price1;
        $product->nrml_price2=$nrml_price2;
        $product->nrml_price3=$nrml_price3;
        $product->nrml_price4=$nrml_price4;
        $product->nrml_price5=$nrml_price5;
        $product->urgent_price1=$urgent_price1;
        $product->urgent_price2=$urgent_price2;
        $product->urgent_price3=$urgent_price3;
        $product->urgent_price4=$urgent_price4;
        $product->urgent_price5=$urgent_price5;
        $product->total=$total;

        // dd($request->all());
        
        if($image){
            $product->product_image=$product_image;
        }

        $product->save();
        return redirect()->route('getManageProducts')->with('success', 'Product Edited Successfully...');
        
    }
    
    public function getDeleteProduct($slug)
    {
        $product = Product::where('slug', $slug)->where('deleted_at', null)->limit(1)->first();
        if (is_null ($product)) {
            return redirect()->back()->with('error', 'Product not found');
        }

        // dd($category);

        $product->deleted_at = Carbon::now();
        $product->save();

        return redirect()->back()->with('success', 'Product Deleted Successfully');
    }


}