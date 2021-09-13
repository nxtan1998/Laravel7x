@extends('admin_layout')
@section('admin_content')
    <div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      <b>Liệt kê đơn hàng</b>
    </div>
    <div class="row w3-res-tb">
     
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
            <th style="width:20px;">
              <label class="i-checks m-b-none">
                <input type="checkbox"><i></i>
              </label>
            </th>
            <th>Tên người mua hàng</th>
            <th>Tổng giá tiền đơn hàng</th>
            <th>Tình trạng</th>
            <th>Hiển thị</th>
            <th>Xác nhận đơn hàng</th>
            
     
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
            @foreach($all_order as $key => $order) 
          <tr>
            <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>
            <td>{{ $order->customer_name }}</td>
            <td>{{ number_format($order->order_total).' '.'VND' }}</td>
            
            <td>{{ $order->order_status }} </td>

            
                        <td>
                <a href="{{URL::to('/view-order/'.$order->id)}}" class="active styling-edit" ui-toggle-class="">
                <i class="fa fa-pencil-square-o text-success text-active"></i></a>
                <a onclick="return confirm('Bạn có chắc xóa đơn hàng này ?')" href="{{URL::to('/delete-manager-order/'.$order->id)}}" class="active styling-edit" ui-toggle-class="">
                <i class="fa fa-times text-danger text"></i>

            </td>
            <td><a href="{{URL::to('/thaydoi/'.$order->id)}}">Xác nhận đơn hàng</a></td>
             

             
          </tr>
          @endforeach 
        </tbody>
      </table>
    </div>
    <footer class="panel-footer">
      <div class="row">
    </footer>
  </div>
</div>
@endsection