@extends('admin_layout')
@section('admin_content')
    
<br>
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Thông tin vận chuyển 
    </div>
    
    <div class="table-responsive">
        <?php
            $message = Session::get('message');
                if($message){
                    echo '<span class="text-alert">',$message.'</span>';
                     Session::put('message',null);
                    } 
                ?>
      <table class="table table-striped b-t b-light">
        <thead>

          <tr>
            <th>Tên người nhận hàng</th>
            <th>Địa chỉ giao hàng</th>
            <th>Số điện thoại nhận hàng</th>
            <th>Ghi chú đơn hàng</th>
            <th style="width:50px;"></th>
          </tr>
        </thead>
        <tbody>
          <th>{{$a->shipping_name}}</th>
          <th>{{$a->shipping_address}}</th>
          <th>{{$a->shipping_phone}}</th>
          <th>{{$a->shipping_notes}}</th>
        </tbody>
      </table>
    </div>
    
  </div>
</div>
<br><br>
    <div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Chi tiết đơn hàng
    </div>
    <!-- <div class="row w3-res-tb">
      
      <div class="col-sm-4">
      </div>
          
    </div> -->
    <div class="table-responsive">
        <?php
            $message = Session::get('message');
                if($message){
                    echo '<span class="text-alert">',$message.'</span>';
                     Session::put('message',null);
                    } 
                ?>
      <table class="table table-striped b-t b-light">
        <thead>

          <tr>
            <th>Tên sản phẩm</th>
            <th>Số lượng</th>
            <th>Đơn giá</th>
            <th>Size</th>
            <th style="width:50px;" ></th>
          </tr>
           </div>
        </thead>
        <?php $tongtien = 0; ?>
      <?php foreach ($OrderBill as $value)
       {
        
        ?>
        <tbody
            <td></td>
            <td>{{$value->product_name}}</td>
            <td>{{$value->product_sales_quantity}}</td>
            <td>{{number_format($value->product_price).' '.'VND'}}</td>
            <td>{{$value->product_size}}</td>
            
            
      <?php 
          } 
          ?>
         
      </table>
    </div>

    <tr>
      

    </tr>   
    <tr>
     

    </tr>
    
    <label></label>
  
    
    <footer class="panel-footer">
        
    </footer>
  </div>
</div>
@endsection