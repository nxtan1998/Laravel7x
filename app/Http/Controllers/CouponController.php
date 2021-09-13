<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Coupon;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
session_start();
class CouponController extends Controller
{
	public function delete_coupon($id){
		$coupon = Coupon::find($id);
		$coupon->delete();
		Session::put('message','Xóa mã giảm giá thành công');
    	return Redirect::to('list-coupon');

	}
	public function list_coupon(){
		$coupon = Coupon::orderby('id','DESC')->get();
		return view('admin.Coupon.listCoupon')->with(compact('coupon'));
	}
    public function insert_coupon()
    {
    	return view('admin.Coupon.insertcoupon');
    }
    public function insert_coupon_code(Request $request){
    	$data = $request->all();
        
    	$coupon = new Coupon;


    	$coupon->coupon_name = $data['coupon_name'];//Tên Chương trình
    	$coupon->coupon_code = $data['coupon_code'];//Tên mã 
    	$coupon->coupon_number = $data['coupon_number'];//Số lượng Mã
    	$coupon->save();

    	Session::put('message','Thêm mã giảm giá thành công');
    	return Redirect::to('insert-coupon');
    }
}
