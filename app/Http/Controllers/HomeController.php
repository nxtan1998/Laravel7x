<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Http\Requests;
use Mail;
use Illuminate\Support\Facades\Redirect;
session_start();
class HomeController extends Controller
{
    public function index(Request $request){

    	$cate_product = DB::table('tbl_category_product')->where('category_status','0')->orderby('category_id','desc')->get();
     	$brand_product = DB::table('tbl_brand')->where('brand_status','0')->orderby('brand_id','desc')->get();
     // 	$all_product = DB::table('tbl_product')
    	// ->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
    	// ->join('tbl_brand','tbl_brand.brand_id','=','tbl_product.brand_id')
    	// ->orderby('tbl_product.product_id','desc')->get();
    	$all_product = DB::table('tbl_product')->where('product_status','0')->orderby('product_id','desc')->limit(10)->get();
    	return view('pages.home')->with('category',$cate_product)->with('brand',$brand_product)->with('all_product',$all_product);
        
    }
    public function search(Request $request){

        $keywords = $request->keywords_submit;
        $cate_product = DB::table('tbl_category_product')->where('category_status','0')->orderby('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand')->where('brand_status','0')->orderby('brand_id','desc')->get();
     //     $all_product = DB::table('tbl_product')
        // ->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
        // ->join('tbl_brand','tbl_brand.brand_id','=','tbl_product.brand_id')
        // ->orderby('tbl_product.product_id','desc')->get();
        // $search_product = DB::table('tbl_product')->where('product_name' ,'like','%'.$keywords.'%')->get();
        // return view('pages.sanpham.search')->with('category',$cate_product)->with('brand',$brand_product)->with('search_product',$search_product);
         $search_product = DB::table('tbl_product')->where('product_price' ,'like','%'.$keywords.'%')->get();
        return view('pages.sanpham.search')->with('category',$cate_product)->with('brand',$brand_product)->with('search_product',$search_product);


    }
    public function Personal(){
        $cate_product = DB::table('tbl_category_product')->where('category_status','0')->orderby('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand')->where('brand_status','0')->orderby('brand_id','desc')->get();
        $data = DB::table('tbl_order')
        ->join('tbl_customers','tbl_customers.customer_id','=','tbl_order.customer_id')
        ->join('tbl_order_details','tbl_order_details.order_id','=','tbl_order.id')
        ->join('tbl_coupon','tbl_order.id','=','tbl_coupon.id_order')
        ->select('tbl_order.*', 'tbl_order_details.date','tbl_coupon.*')
        ->get();
        
        return view('Personal.personal')->with('data',$data)->with('category',$cate_product)->with('brand',$brand_product);
    }
    // public function send_mail(){
    //             $code = rand(1000,9999);
    //             $to_name = "DT-Sport";
    //             $to_email = "dh51603403@student.stu.edu.vn";//send to this email
        
    //             $data = array("name"=>"Mail gửi từ DT-Sport","code"=>'code'); //body of mail.blade.php
                
    //             Mail::send('pages.send_mail',$data,function($message) use ($to_name,$to_email){
                    
    //                 $message->to($to_email)->subject('test mail nhé');//send this mail with subject
    //                 $message->from($to_email,$to_name);//send from this mail
    //             });
    //             // return redirect('/')->with('message','');
    // }
}
