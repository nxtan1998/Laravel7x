@extends('admin_layout')
@section('admin_content')
    <div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      <b>Liệt kê danh sách thành viên</b>
    </div>
    <div class="row w3-res-tb">

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
            <th>Khách hàng</th>
            <th>Địa chỉ email</th>
            <th>Số điện thoại</th>
           
            </tr>
        </thead>
        <tbody>
            @foreach($manage_khachhang as $key => $khach) 
          <tr>
            <td>{{$khach->customer_name}}</td>
            <td>{{$khach->customer_email}}</td>
            <td>{{$khach->customer_phone}}</td>
            
          </tr>
          @endforeach 
        </tbody>
      </table>
    </div>
    
  </div>
</div>
@endsection