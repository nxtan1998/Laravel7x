@extends('layout')
@section('content')	
	<section id="form"><!--form-->
		<div class="container">
			<div class="row">
				<div class="col-sm-4 col-sm-offset-1">
					<div class="login-form"><!--login form-->
						<h2>Đăng nhập vào tài khoản</h2>
						<form action="{{URL::to('/login-customer')}}" method="POST">
							{{ csrf_field() }}
							<input type="text" name="email_account" placeholder="Tài khoản" />
							<input type="password" name="password_account" placeholder="Password" />
							<span>
								<button type="button" class="btn btn-primary"><a href="{{URL::to('/login-facebook')}}">Đăng nhập Facebook</a></button>
							</span>
							<button type="submit" class="btn btn-default">Đăng nhập</button>

						</form>
					</div><!--/login form-->
				</div>
				<div class="col-sm-1">
					<h2 class="or">OR</h2>
				</div>
				<div class="col-sm-4">
					<div class="signup-form"><!--sign up form-->
						<h2>Đăng ký tài khoản</h2>

						<div class="col-sm-3"></div>
						@if(count($errors)>0)
							<div class="alert alert-danger">
								@foreach($errors->all() as $err)
								{{ $err }}
								@endforeach
							</div>
						@endif
						<form action="{{URL::to('/send')}}" method="GET">
							{{ csrf_field() }}
							<input type="email" name="customer_email" placeholder="Email "/>
							<button type="submit" class="btn btn-danger">Đăng ký</button>

						</form>
					</div><!--/sign up form-->
				</div>
			</div>
		</div>
	</section><!--/form-->
@endsection