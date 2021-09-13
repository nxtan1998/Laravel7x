@extends('layout')
@section('content')
<div class="features_items"><!--features_items-->
                        <div class="fb-share-button" data-href="http://localhost/shopthethaolaravel/" data-layout="button" data-size="large"><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=http%3A%2F%2Flocalhost%2Fshopthethaolaravel%2F&amp;src=sdkpreparse" class="fb-xfbml-parse-ignore">Chia sẻ</a></div>
                        <div class="fb-like" data-href="http://localhost/shopthethaolaravel/danh-muc-san-pham/3" data-width="" data-layout="button_count" data-action="like" data-size="large" data-share="false"></div>
                        @foreach($category_name as $key => $name)
                        <h2 class="title text-center">{{$name->category_name}}</h2>
                        @endforeach
                        @foreach($category_by_id as $key => $product)
                        <a href="{{URL::to('/chi-tiet-san-pham/'.$product->product_id)}}"> 
                        <div class="col-sm-4">
                            <div class="product-image-wrapper">
                                <div class="single-products">   
                                        <div class="productinfo text-center">
                                            <img src="{{URL::to('public/uploads/product/'.$product->product_image)}}" alt="" />
                                            <h2>{{number_format($product->product_price).' '.'VND'}}</h2>
                                            <p>{{$product->product_name}}</p>
                                            <a href="{{URL::to('/chi-tiet-san-pham/'.$product->product_id)}}" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Thêm giỏ hàng</a>
                                        </div>
                                </div>
                                <div class="choose">
                                    
                                </div>
                            </div>
                        </div>
                    </a>
                        @endforeach
                    </div>  
                    <div class="fb-comments" data-href="http://localhost/shopthethaolaravel/danh-muc-san-pham/9" data-width="" data-numposts="20"></div>
                    
@endsection