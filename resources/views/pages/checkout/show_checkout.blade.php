@extends('layout')
@section('content')	

	<section id="cart_items">
		<div class="container">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="{{URL::to('/')}}"> Trang chủ </a></li>
				  <li class="active">Thanh toán giỏ hàng</li>
				</ol>
			</div>
			
				
			@if(count($errors)>0)
					<div class="alert alert-danger">
						@foreach($errors->all() as $err)
						{{ $err }}
						@endforeach
					</div>
				@endif
			<div class="register-req">
				<p>Đăng ký hoặc đăng nhập để thanh toán</p>
			</div><!--/register-req-->

			<div class="shopper-informations">
				<div class="row">
						
					<div class="col-sm-8 clearfix">
						<div class="bill-to">
							<p>Nhập thông tin</p>
							<div class="form-one">
								<form action="{{URL::to('/save-checkout-customer')}} " method="POST" >
									{{ csrf_field() }}
									<input type="text" name="shipping_name" placeholder="Họ tên người nhận "requiredrequiredrequiredrequired >
									<input type="text" name="shipping_email" placeholder="Email " requiredrequiredrequired>									
									<input type="text" 	name="shipping_phone" placeholder="Số điện thoại " >
									<textarea name="shipping_notes"  placeholder="Ghi chú đơn hàng" rows="5"></textarea>
									<input type="submit" value="Gửi"  name="send_order" class="btn btn-primary btn-sm">
								</form>
							</div>
							 
						</div>
					</div>					
				</div>
			</div>
			


			
		</div>
	</section> <!--/#cart_items-->



@endsection