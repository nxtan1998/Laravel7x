<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Cart;
use App\Coupon;
session_start();

class CartController extends Controller
{
    
    public function check_coupon(Request $request){

        $data = $request->all();
        $coupon = Coupon::where('coupon_code',$data['coupon'])->first();
        if($coupon){
            $count = $coupon->count();

            if($count > 0){
                $coupon_session = Session::get('coupon');
                if($coupon_session){
                            $cou[] = array(
                                'coupon_code' =>$coupon->coupon_code,
                                'coupon_number'=>$coupon->coupon_number
                            );
                            Session::put('coupon',$cou);
                        
                }else{
                            $cou[] = array(
                                'coupon_code' =>$coupon ->coupon_code,
                                'coupon_number'=>$coupon ->coupon_number
                            );
                            Session::put('coupon',$cou);
                }
                Session::save();
                return redirect()->back()->with('message','Thêm mã giảm giá thành công');
            }
        }else{
            return redirect()->back()->with('message',' Mã giảm giá không đúng');
        }
       

}   

    public function save_cart(Request $request){

    	$productId = $request->productid_hidden;
    	$quantity = $request->qty;

    	$product_info = DB::table('tbl_product')->where('product_id',$productId)->first();

    	
     	// Cart::add('293ad', 'Product 1', 1, 9.99, 550);
     	// Cart::destroy();
     	$data['id'] = $product_info->product_id;
     	$data['qty'] = $quantity;
     	$data['name'] = $product_info->product_name;
     	$data['price'] = $product_info->product_price;
     	$data['weight'] = '1';
        
        
        $data['options']['size'] = $_POST['ten'];
     	$data['options']['image'] = $product_info->product_image;
     	$a = Cart::add($data);
        
     	// Cart::destroy();
     	return Redirect::to('/show-cart');
   	
    }
    public function show_cart(Request $request){
        

        $cart = Cart::content();
        $price = 0;
        foreach ($cart as $value) {
            $price = $price + $value->price;
        }

        $cate_product = DB::table('tbl_category_product')->where('category_status','0')->orderby('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand')->where('brand_status','0')->orderby('brand_id','desc')->get();
        if($price == 0)
        {
            
            return view('layout')->with('category',$cate_product)->with('brand',$brand_product);
        }
        else{


            return view('pages.cart.show_cart')->with('category',$cate_product)->with('brand',$brand_product);
        }

    }
    public function delete_to_cart($rowId){
    	Cart::update($rowId,0);
        Session::forget('coupon');
    	return Redirect::to('/show-cart');
    }
    public function delete_all_cart(){
        $cart = Session::get('cart');
        if($cart){
            Session::forget('coupon');
        return redirect()->back()->with('message','Xóa mã thành công');
        }
        
    }
    public function update_cart_quantity(Request $request){
    	$rowId = $request->rowId_cart;
    	$qty = $request->cart_quantity;
    	Cart::update($rowId,$qty);
    	return Redirect::to('/show-cart');
    }
}
