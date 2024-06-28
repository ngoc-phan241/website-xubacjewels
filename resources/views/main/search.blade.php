<!DOCTYPE html>
<head>
    <link rel="stylesheet" href="{{asset('font/css/main-style.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
     <!-- Google Font -->
     <link href="https://fonts.googleapis.com/css?family=Muli:300,400,500,600,700,800,900&display=swap" rel="stylesheet">
</head>
<body>
    <x-shop-layout>
    <div class="container">
        <div id="wp-products" style="margin-bottom:50px;">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('product')}}">Trang chủ</a></li>
                <li class="breadcrumb-item active" aria-current="page">Tìm kiếm</li>
            </ol>
        </nav>
        
        @if ($errors->any())
            <div style='color:red;width:30%; margin:0 auto'>
                <div >
                {{ __('Whoops! Something went wrong.') }}
                </div>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{$error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if($data->isNotEmpty())
            <div class="">  
                <div class='list-product'>
                    @foreach($data as $row)  
                        <div class="product">
                            <a class='item' href="{{url('categories/detail/'.$row->id)}}">                            
                                @if ($row->discount != null)
                                    <span class="badge rounded-pill text-bg-danger">-{{$row->percent}}%</span>
                                @endif 
                                <img src="{{asset('front/image/'.$row->image)}}" width='150px'><br>
                                <div class="name">{{$row->name}}</div><br/>
                                <div class="price">
                                    @if ($row->discount == null)
                                        <b>{{number_format($row->price)}}.000đ</b> 
                                    @else
                                        <div class="sale-price">
                                            <div class="old-price">{{number_format($row->price)}}.000đ</div> 
                                            <div class="discount"><b>{{number_format($row->discount)}}.000đ</b></div> 
                                        </div> 
                                    @endif
                                </div>  
                            </a>  
                            <div class='btn-add-product'>
                                <button class='btn btn-success btn-sm mb-1 add-product' product_id="{{$row->id}}">
                                    <i class="fa-solid fa-cart-shopping"></i>
                                    Add to cart
                                </button> 
                            </div> 
                        </div>        
                    @endforeach
                </div>
            </div> 
           


            <div class="d-flex justify-content-center">
                {{$data->links()}} 
            </div> 
        @else
        <div>Không tìm thấy bất kỳ kết quả nào với từ khóa trên.</div>
        @endif      
        </div>
</div>
    </x-shop-layout>
</body>