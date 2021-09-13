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

			<div class="review-payment">
				<h2>Xem lại giỏ hàng</h2>
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
							<td>Xóa</td>
							
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
								<p>{{number_format($v_content->price).' '.'VND'}}</p>
							</td>
							<td class="cart_quantity">
								<div class="cart_quantity_button">
									<form action ="{{URL::to('update-cart-quantity')}}" method="POST">
										{{ csrf_field() }}
									<input class="cart_quantity_input" type="text" name="cart_quantity" value="{{$v_content->qty}}">

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
				<div class="container">		
				<div class="row">	
				<div class="col-sm-4">
					<div class="total_area">
						@if(Session::has('coupon'))
						
							<ul>

								<h5><li> Tổng hóa đơn <span>{{number_format($a). 'VNĐ' }}</span></li></h5>
							</li>
							</ul>

							<li>Được giảm<span>
								@if(Session::get('coupon'))
									@foreach(Session::get('coupon') as $value)
										 {{$value['coupon_number']}}
									@endforeach

								@endif
								</span>
							</li>
							<li>Tiền thanh toán sau giảm <span>{{number_format($a-$value['coupon_number']).' '.'VND'}}</span>
						@else
							<ul>

								<h5><li> Tiền Thanh Toán <span>{{number_format($a). 'VND' }}</span></li></h5>
							</li>
							</ul>
						@endif

						

					</div>
				</div>
			</div>
			</div>
			</div>
			<section id="do_action">
		
	</section><!--/#do_action-->
			<h4 style="margin:40px 0;font-size: 20px;">  Chọn phương thức thanh toán</h4>
			<form method="POST" action="{{URL::to('/order-place')}}">
				{{ csrf_field() }}
			<div class="payment-options">
					<span>
						<label><input name="payment_option" value="Chuyển khoản" type="checkbox"> Chuyển Khoản</label>
					</span>
					<span>
						<label><input name="payment_option" value="Tiền mặt" type="checkbox"> Tiền mặt</label>
					</span>
						<input type="submit" value="Đặt hàng"  name="send_order" class="btn btn-primary btn-sm">

				</div>
				</form>
		</div>
	</section> <!--/#cart_items-->
	



@endsection