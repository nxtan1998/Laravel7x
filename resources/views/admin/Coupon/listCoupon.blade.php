@extends('admin_layout')
@section('admin_content')
    <div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Liệt kê mã giảm giá
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
            <th>Tên mã giảm</th>
            <th>Mã giảm giá</th>
            
            <th>Số giảm </th> 
            <th>Xóa </th>
          </tr>
        </thead>
        <tbody>
            @foreach($coupon as $key => $cou) 
          <tr>
            <td>{{$cou->coupon_name}}</td>
            <td>{{$cou->coupon_code}}</td>
            
           
             <td><span class="text-ellipsis">
                
                
                {{$cou->coupon_number}} VNĐ                    
                
            </span></td>
                <td>
                
                
                <a onclick="return confirm('Bạn có chắc xóa mã khuyến mãi này không ?')" href="{{URL::to('/delete-coupon/'.$cou->id)}}" class="active styling-edit" ui-toggle-class="">
                <i class="fa fa-times text-danger text"></i>
            </td>
            <td></td>
          </tr>
          @endforeach 
        </tbody>
      </table>
    </div>
    <footer class="panel-footer">
     
    </footer>
  </div>
</div>
@endsection