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
			
				
			
			

			<div class="shopper-informations">
				<div class="row">
						
					<div class="col-sm-8 clearfix">
						<div class="bill-to">
							<p>Vui Lòng Nhập Email Đăng Ký Tài Khoản</p>
							<div class="form-one">
								<form action="{{URL::to('/send-OTP')}}" method="GET">
									{{ csrf_field() }}
									<input type="email" name="email" placeholder="Email "/>
									<button type="submit" class="btn btn-danger">Lấy Mã</button>

								</form>
							</div>
							 
						</div>
					</div>					
				</div>
			</div>
			


			
		</div>
	</section> <!--/#cart_items-->



@endsection