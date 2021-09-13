<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Cart;
use App\Order;
use App\Detail_Order;
use App\Coupon;
use App\Shipping;
use Illuminate\Support\Facades\Mail;
use Nexmo\Laravel\Facade\Nexmo;

session_start(); 

class CheckoutController extends Controller
{
    public function AuthLogin(){
        $admin_id = Session::get('admin_id');
        if($admin_id){
            return Redirect::to('dashboard');

        }else{
            return Redirect::to('admin')->send();
        }
    }
    public function view_order($orderId){//chi tiết đơn hàng
        // $this->AuthLogin();

        $order_by_detail = DB::table('tbl_order_details')->get();
         $shipping = DB::table('tbl_shipping')->get();
         $order_id = DB::table('tbl_order')->get();
         $a = 0;
         foreach ($shipping as $ship) {
            foreach ($order_id as $order)
               {
                    if($ship->shipping_id == $order->shipping_id)
                    {
                        $a = $ship;
                    }
                 }
         }
         $OrderBill = array();       
         foreach ( $order_by_detail as $detail) 
         {
            // dd($detail);

              if($detail->order_id == $orderId)
              {
                 $OrderBill[] = $detail;
              }

         }
         return view('admin.view_order',compact('OrderBill','a','x'));
    }
    public function login_checkout(){
       
    	$cate_product = DB::table('tbl_category_product')->where('category_status','0')->orderby('category_id','desc')->get();
     	$brand_product = DB::table('tbl_brand')->where('brand_status','0')->orderby('brand_id','desc')->get();
        

    	return view('pages.checkout.login_checkout')->with('category',$cate_product)->with('brand',$brand_product);
    }
     public function login_checkout1(){
       
        $cate_product = DB::table('tbl_category_product')->where('category_status','0')->orderby('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand')->where('brand_status','0')->orderby('brand_id','desc')->get();

        return view('pages.checkout.OTP')->with('category',$cate_product)->with('brand',$brand_product);
    }
    public function add_customer(Request $request){
            
         $validate=$request->validate(
            [   
                'customer_email'=>'required|email|unique:tbl_customers,customer_email',
                'customer_phone'=>'required|min:10|max:10|'
                
            ],
            [
                'customer_email.unique'=>'đã có người sử dụng email này',
                'customer_phone.min'=>'số điện thoại ít nhất 10 số',
                'customer_phone.max'=>'số điện thoại quá 10 số'
               
            ]
        );

        if(Session::get('code')==$request->customer_OTP)
        {
            
        	$data = array();
        	$data['customer_name'] =  $request->customer_name; 	
        	$data['customer_email'] =  $request->customer_email; 	
        	$data['customer_password'] =  ($request->customer_password); 	
        	$data['customer_phone'] =  $request->customer_phone;


        	$customer_id =  DB::table('tbl_customers')->insertGetId($data);
        	Session::put('customer_id',$customer_id);
        	Session::put('customer_name',$request->customer_name);
            Session::put('customer_email',$request->customer_email);

        	return Redirect::to('checkout');

        } 
        return Redirect('sendOTP');
    }
    public function sendOTP(Request $request){

        $code = rand(1000,9999);
        $to_name = " Medical ";
        $to_email = $request->customer_email;
        $data1 = array("name"=>'xuantan',"code"=>$code);
        Mail::send('pages.send_mail',$data1,function($message) use ($to_name,$to_email){
            $message->to($to_email)->subject('Mã Xác Thực');
            $message->from($to_email,$to_name);
        });
        Session::put('code',$code);
        return Redirect::to('sendOTP');
    }

    //  public function send_mail(Request $request){
        
    //     $code = rand(1000,9999);
    //     $to_name = " Medical ";
    //     $to_email = $request->customer_email;
    //     $data1 = array("name"=>'xuantan',"code"=>$code);
    //     Mail::send('pages.send_mail',$data1,function($message) use ($to_name,$to_email){
    //         $message->to($to_email)->subject('Mã Xác Thực');
    //         $message->from($to_email,$to_name);
    //     });
    //     Session::put('code',$code);
    //     return view('MA-OTP');
    // }

    public function quenmatkhau(){
        $cate_product = DB::table('tbl_category_product')->where('category_status','0')->orderby('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand')->where('brand_status','0')->orderby('brand_id','desc')->get();
        
        
        return view('pages.checkout.quenmatkhau')->with('category',$cate_product)->with('brand',$brand_product);
       
    }

    public function checkout(){

    	$cate_product = DB::table('tbl_category_product')->where('category_status','0')->orderby('category_id','desc')->get();
     	$brand_product = DB::table('tbl_brand')->where('brand_status','0')->orderby('brand_id','desc')->get();
        $city = DB::table('tbl_tinhthanhpho')
                ->get();

        $quanhuyen = DB::table('tbl_quanhuyen')
                ->get();
        // $
                // ->join('tbl_tinhthanhpho','tbl_tinhthanhpho.matp','=','tbl_quanhuyen.matp')
                // ->join('tbl_xaphuongthitran','tbl_xaphuongthitran.maqh','=','tbl_quanhuyen.maqh')
                // ->select('tbl_tinhthanhpho.name as city','tbl_quanhuyen.*','tbl_xaphuongthitran.*')
                // ->get();
        
        
    	return view('pages.checkout.show_checkout')->with('category',$cate_product)->with('brand',$brand_product)->with('city',$city)->with('quanhuyen',$quanhuyen);
    }
    public function save_checkout_customer(Request $request){
        
       
        
      
        $validate = $request->validate(
            [
                'shipping_name' =>'required',
                 
                'shipping_phone'=>'required|min:10|max:10'
            ],
            [
                'shipping_name.required' =>'Vui lòng nhập tên người nhận hàng',
                
                'shipping_email.unique' =>'đã có người sử dụng email này',
                'shipping_phone.min'=>'Số điện thoại không đủ 10 số',
                'shipping_phone.max'=>'Số điện thoại lớn hơn 10 số'

            ]);
     
    	$data = array();
    	$data['shipping_name'] =  $request->shipping_name; 	
    	
    	$data['shipping_notes'] =  $request->shipping_notes; 	
    	$data['shipping_phone'] =  $request->shipping_phone;
    	$data['shipping_address']      =  $request->shipping_address;


    	$shipping_id =  DB::table('tbl_shipping')->insertGetId($data);


    	Session::put('shipping_id',$shipping_id);

 
    	return Redirect::to('/payment');
        
    }
    public function payment(Request $request){
    
        if(Cart::total()==0){
            return Redirect::to('/');
            // return view('page.')
        }
        $cate_product = DB::table('tbl_category_product')->where('category_status','0')->orderby('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand')->where('brand_status','0')->orderby('brand_id','desc')->get();
        
            return view('pages.checkout.payment')->with('category',$cate_product)->with('brand',$brand_product);

    }
    public function order_place(Request $request)
    {
        $x = 0;
        $y = '';
        if(Session::has('coupon'))
        {
            foreach (Session::get('coupon') as $key => $value) 
            $x =$value['coupon_number'];
            $y = $value['coupon_code'];
        
        }
        
        //dd($x);
        $content = Cart::content();
        //dd($content);
        $total = 0;
        //dd($content);
        foreach ($content as $value)
            $total = $total + ($value->price * $value->qty);
        
        //dd($total);
        $data = array();
        $data['payment_method'] =  $request->payment_option;  
        $data['payment_status'] =  'Đơn hàng đang xử lí';  
        $payment_id =  DB::table('tbl_payment')->insertGetId($data);

        //insert order
        
            $order_data = array();
            $order_data['customer_id'] =  Session::get('customer_id');
            $order_data['shipping_id'] =  Session::get('shipping_id');
            $order_data['coupon_name'] = $y;
            $order_data['payment_id']  =   $payment_id;
            $order_data['order_total'] =   $total - $x;
            $order_data['order_status']  = 'Đơn hàng đang đợi xử lí';                           
            $order_id =  DB::table('tbl_order')->insertGetId($order_data);
                $coupon = Coupon::all();
                foreach ($coupon as $value) {
                    
                       if($y==$value->coupon_code)
                       {
                            $value->delete();
                        }   
                    
                }
            Session::forget('coupon');
            
        //insert order_details
        $content = Cart::content();

        foreach ($content as $v_content) {
        $order_d_data['order_id'] =  $order_id;
        $order_d_data['product_id'] =  $v_content->id;
        $order_d_data['product_name']  =   $v_content->name;
        $order_d_data['product_price'] =   $v_content->price;
        $order_d_data['product_sales_quantity']  = $v_content->qty;
        $order_d_data['product_size'] = $v_content->options->size;
        $order_d_data['date'] = date("Y/m/d");
        //$order_d_data['product_size'] = $v_content->size ;              
        DB::table('tbl_order_details')->insert( $order_d_data);
            
        }
        if($data['payment_method']==1){
            echo 'Chuyển khoản';
        }else{
            Cart::destroy();
        $cate_product = DB::table('tbl_category_product')->where('category_status','0')->orderby('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand')->where('brand_status','0')->orderby('brand_id','desc')->get();
        if($total > 400000)
        {
            $coupon_data = array();
         $coupon_data['coupon_name'] = 'Mã Giảm Giá'.$order_id;
            $coupon_data['coupon_number'] = 100000;
            $coupon_data['coupon_code']  = 'MA'.$order_id;
            $coupon_data['id_order']  = $order_id;

             $order_id =  DB::table('tbl_coupon')->insertGetId($coupon_data);
        }


        return view('pages.checkout.handcash')->with('category',$cate_product)->with('brand',$brand_product);
        }
        // return Redirect::to('/payment');
    }
    // public function Thaydoi_giatri($id){
    //     $
    // }
    public function logout_checkout(){
    	Session::flush();
    	return Redirect::to('/login-checkout');
    }
    public function login_customer(Request $request){
    	$email = $request->email_account;
    	$password = $request->password_account;
    	$result = DB::table('tbl_customers')->where('customer_email',$email)->where('customer_password',$password)->first();
        
        
    	if($result){
    		Session::put('customer_id',$result->customer_id);
    		return Redirect::to('/checkout');
    	}else{
    		return Redirect::to('/login-checkout');	
    	}
   		

    }
    public function manage_order(){

        $this->AuthLogin();
        $all_order = DB::table('tbl_order')

        ->join('tbl_customers','tbl_order.customer_id','=','tbl_customers.customer_id')
        ->select('tbl_order.*','tbl_customers.customer_name')
        ->orderby('tbl_order.id','desc')->get();
        $manager_order = view('admin.manage_order')->with('all_order',$all_order);
        return view('admin_layout')->with('admin.manage_order',$manager_order);
    }
    public function delete_manager_order($managerorderId){
        
        $Allship = Shipping::all();
        
        $Order = Order::find($managerorderId);
        
         foreach ($Allship as  $value)
        {
            if($value->id == $Order->shipping_id)
            { 
              $value->delete();
            }
            
        }        
        DB::table('tbl_order')->where('id',$managerorderId)->delete();
        DB::table('tbl_order_details')->where('order_id',$managerorderId)->delete();
        Session::put('message','Xóa đơn hàng thành công');
        return Redirect::to('manage-order');
    }

    public function Thaydoi_giatri($orderId)
    {
        $x = Order::all();
        foreach ($x as  $value) {
            if($value->id ==$orderId)
            {
                 $value->order_status ='Đã duyệt đơn hàng';
                 $value->save();
            }
        }
        return Redirect::to('manage-order');
    }
    public function manage_khachhang(){

        $this->AuthLogin();
        $manage_khachhang = DB::table('tbl_customers')->get();
        $manage_khachhangtv = view('admin.manage_khachhang')->with('manage_khachhang',$manage_khachhang);
        return view('admin_layout')->with('admin.manage_khachhang',$manage_khachhangtv);
   }
   public function hightchart(){
        $chart = DB::table('tbl_order_details')
                   ->join('tbl_product','tbl_order_details.product_id','=','tbl_product.product_id')
                   ->select('tbl_product.category_id')
                   ->get();
        dd($chart);
   }
}
    