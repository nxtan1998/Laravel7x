@extends('admin_layout')
@section('admin_content')

<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            THÊM DANH MÃ GIẢM GIÁ
                        </header>
                        <div class="panel-body">
                            <?php
                                $message = Session::get('message');
                                if($message){
                                    echo '<span class="text-alert">',$message.'</span>';
                                    Session::put('message',null);
                                } 
                            ?>
                            <div class="position-center">
                                <form role="form" action="{{URL::to('/insert-coupon-code')}}" method="post">
                                    @csrf
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên mã giảm giá</label>
                                    <input type="text" name="coupon_name" class="form-control" id="exampleInputEmail1" >
                                </div>
                                 <div class="form-group">
                                    <label for="exampleInputEmail1">Mã giảm giá</label>
                                   <input type="text" name="coupon_code" class="form-control" id="exampleInputEmail1" >
                                </div>
                               
                                
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Số tiền giảm</label>
                                    
                                    <input type="text" name="coupon_number" type="number" min="50000"  class="form-control" id="exampleInputEmail1" >
                                    
                                    
                                </div>
                               
                                <button type="submit" name="add_coupon" class="btn btn-info">Thêm mã</button>
                            </form>
                            </div>

                        </div>
                    </section>

            </div>
@endsection