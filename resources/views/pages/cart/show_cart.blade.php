@extends('layout')
@section('content')	
	<section id="cart_items">
		<div class="container">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="{{URL::to('/')}}"> Trang chủ </a></li>
				  <li class="active">Giỏ hàng của bạn</li>
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
							<td class="image">Hình ảnh</td>
							<td class="description">Tên sản phẩm</td>
							<td class="price">Giá</td>
							<td class="quantity">Số lượng</td>
							<td class="total">Tổng</td>
							<td class="total">Xóa</td>
							<!-- <td class="quantity">Size</td> -->
							<td></td>
						</tr>
					</thead>
					<tbody>
						<?php $a = 0 ?>
						
						@foreach($content as $v_content)
						<tr>
							
							<td class="cart_product">
								<a href=""><img src="{{URL::to('public/uploads/product/'.$v_content->options->image)}}" width="70" alt="" /></a>
							</td>
							<td class="cart_description">
								<h4><a href="">{{$v_content->name}}</a></h4>
								<p>Size : {{$v_content->options->size}}</p>
							</td>
							<td class="cart_price">
								<!-- <p>{{number_format($v_content->price).' '.'VND'}}</p> -->
								<p>{{number_format((double)($v_content->price)) .'VND' }}</p>
							</td>
							<td class="cart_quantity">
								<div class="cart_quantity_button">
									<form action ="{{URL::to('update-cart-quantity')}}" method="POST">
										{{ csrf_field() }}
									<input width="50px" class="cart_quantity_input" type="text" name="cart_quantity" value="{{$v_content->qty}}">

									<input type="hidden" value="{{$v_content->rowId}}" name="rowId_cart" class="form-control">
									<input type="submit" value="Cập nhật" name="update_qty" class="btn btn-default btn-sm">
								</form>
								</div>
							</td>
	
							<td class="cart_total">
								<p class="cart_total_price">
									<?php

									$subtotal = $v_content->price * $v_content->qty;
									echo number_format($subtotal).' '.'VND';

									?>
									<?php $a = $a + $subtotal ?>
								</p>
							</td>
							<td class="cart_delete">
								<a class="cart_quantity_delete" href="{{URL::to('/delete-to-cart/'.$v_content->rowId)}}"><i class="fa fa-times"></i></a>
							</td>
						</tr>
						@endforeach
					</tbody>
					
				</table>
				@if(Session::get('cart'))
				<tr><td>
					<LABEL>Mã giảm giá:</LABEL>
				<form method="POST" action="{{url('/check-coupon')}}">
					@csrf
						<input type="text" class="form-control" name ="coupon" placeholder="Nhập mã " >
						<input type="submit" class="btn btn-default check_coupon" name ="check_coupon" value="Sử dụng mã"></td>
				</form>
				<form method="POST" action="{{url('/delete-all-cart')}}">
					@csrf
						
						<!-- <input type="submit" class="btn btn-default check_coupon" name ="check_coupon" value="Xóa mã"></td> -->
				</form>		
				</tr>
				@endif

			</div>		
	</section> <!--/#cart_items-->
	<section id="do_action">
		<div class="container">			
			<div class="row">	
				<div class="col-sm-5">
					<div class="total_area">
						<ul>						
							<li>Tổng Tiền <span>{{number_format($a).' '.'VND'}}</span></li>
							<li>Được Giảm<span>
								@if(Session::get('coupon'))
									@foreach(Session::get('coupon') as $value)
										 {{$value['coupon_number']}}
									@endforeach

								@endif
								</span>
							</li>
							<!--  --></li>
							</li>
							</ul>
							<?php 
                                    $customer_id = Session::get('customer_id');
                                    if($customer_id !=NULL){
                                ?>
                                
                                <a class="btn btn-default check_out" href="{{URL::to('/checkout')}}">Thanh Toán</a>
                                
                                <?php
                                }else{
                                    ?>
                              
                                <a class="btn btn-default check_out" href="{{URL::to('/login-checkout')}}">Thanh Toán</a>
                                <?php
                                }
                                ?>
							
					</div>
				</div>
			</div>
		</div>
	</section><!--/#do_action-->
@endsection