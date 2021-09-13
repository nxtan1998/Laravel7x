@extends('layout')
@section('content')	
	<section id="cart_items">
		<div class="container">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="{{URL::to('/')}}"> Trang chủ </a></li>
				  <li class="active">Lịch Sử đơn hàng</li>
				</ol>
			</div>
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li class="active">
				  	@if(Session::has('message'))
						<div ><h2>{{ Session::get('message') }}</h2></div>	
				  	@endif
				  </li>
				</ol>
			</div>
			<div class="table-responsive cart_info">
				<?php
				$content = Cart::content();
				?>	
				<table class="table table-condensed">
					<thead>
						<tr class="cart_menu">
							
							<td class="price">Tổng Giá</td>
							<td class="quantity">Ngày</td>
							<td>Mã Giảm giá được nhận</td>
							<td>Số tiền giảm</td>
														<!-- <td class="quantity">Size</td> -->
							<td></td>
						</tr>
					</thead>
					<tbody>
						<?php $a = 0 ?>
						
						@foreach($data as $product)
						<tr>
							
							
							
							<td class="cart_total">
								
								<p class="cart_total_price">{{number_format($product->order_total) .'VND' }}</p>
							</td>
							<td class="cart_total">
								
								<p>{{$product->date }}</p>
							</td>
							<td class="cart_total">
								
								<p>{{$product->coupon_code }}</p>
							</td>
							<td class="cart_total">
								
								<p>{{$product->coupon_number }}</p>
							</td>
							
	
							
							
						</tr>
						@endforeach
					</tbody>
					
				</table>
				

			</div>		
	</section> <!--/#cart_items-->
	
@endsection