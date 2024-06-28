<!DOCTYPE html>
    <head>
    <link
        rel="stylesheet"
        type="text/css"
        href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css">
        
    </head>
    <body>
        <x-shop-layout>
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
                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif

            <!-- Carousel -->
            <div id="demo" class="carousel slide" data-bs-ride="carousel">

            <!-- Indicators/dots -->
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#demo" data-bs-slide-to="0" class="active"></button>
                <button type="button" data-bs-target="#demo" data-bs-slide-to="1"></button>
                <button type="button" data-bs-target="#demo" data-bs-slide-to="2"></button>
            </div>

            <!-- The slideshow/carousel -->
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="{{asset('front/image/slideshow.png')}}" alt="" class="d-block w-100">
                </div>
                <div class="carousel-item">
                   <a href="{{route('sale-off')}}"><img src="{{asset('front/image/slideshow_1.png')}}" alt="" class="d-block w-100"> </a>
                </div>
                <div class="carousel-item">
                    <img src="{{url('https://bizweb.dktcdn.net/100/302/551/themes/758295/assets/breadcrump.jpg?1714979091463')}}" alt="" class="d-block w-100">
                </div>
            </div>

            <!-- Left and right controls/icons -->
            <button class="carousel-control-prev" type="button" data-bs-target="#demo" data-bs-slide="prev">
            <span class="carousel-control-prev-icon"></span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#demo" data-bs-slide="next">
            <span class="carousel-control-next-icon"></span>
            </button>
            </div>

            <div class='image-slider'>
                <div class="image-item">
                    <div class="image">
                        <img src="{{asset('front/image/banner-1.png')}}"> 
                    </div>
                </div>
                <div class="image-item">
                    <div class="image">
                        <img src="{{asset('front/image/banner-2.jpg')}}"> 
                    </div>
                </div>
                <div class="image-item">
                    <div class="image">
                        <img src="{{asset('front/image/banner-3.jpg')}}"> 
                    </div>
                </div>
                <div class="image-item">
                    <div class="image">
                        <img src="{{asset('front/image/banner-4.jpg')}}"> 
                    </div>
                </div>
            </div>

        <div class="container">
            <div id="wp-products">
                <div class="sale-hot" style="margin-bottom:40px;">
                    <center>
                        <a href="{{route('sale-off')}}">
                            <h2 style="margin-bottom: 50px;margin-top:50px;">SALE OFF</h2>
                        </a>  
                    </center> 
                    <div class='list-product'>
                            @foreach($sale_products as $row)
                                <div class="product">
                                    <a class="item" href="{{url('categories/detail/'.$row->id)}}">
                                        <span class="badge rounded-pill text-bg-danger">-{{$row->percent}}%</span>
                                        <img class="anhhh" src="{{asset('front/image/'.$row->image)}}" width="200px" ><br>  
                                        <div class="name">{{$row->name}}</div><br/>
                                        <div class="sale-price">
                                            <div class="old-price">{{number_format($row->price)}}.000đ</div> 
                                            <div class="discount"><b>{{number_format($row->discount)}}.000đ</b></div> 
                                        </div>  
                                        
                                    </a>
                                    <div class='btn-add-product'>
                                        <button class="btn btn-danger btn-sm mb-1 add-product" product_id="{{$row->id}}" >
                                            <i class="fa-solid fa-cart-shopping"></i>
                                                Add to cart
                                        </button> 
                                    </div>
                                </div>
                            @endforeach

                    </div>
                </div>
            </div>
        </div>

        </x-shop-layout>
        <script
      type="text/javascript"
      src="https://code.jquery.com/jquery-1.11.0.min.js"
    ></script>
    <script
      type="text/javascript"
      src="https://code.jquery.com/jquery-migrate-1.2.1.min.js"
    ></script>
    <script
      type="text/javascript"
      src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"
    ></script> 
    <script src="{{asset('front/js/app.js')}}"></script>
    <script src="{{asset('front/js/sweetalert.min.js')}}"></script>
    
    <script type="text/javascript">
        
        $(document).ready(function(){
            
            $('.add-product').click(function(){
                //console.log("Button clicked");
                //swal("Here's a message!");
            });


            $(".add-product").click(function(e){
                id= $(this).attr("product_id");
                num = 1;
                $.ajax({
                    type:"POST",
                    dataType:"json",
                    url: "{{route('cartadd')}}",
                    data:{"_token": "{{ csrf_token() }}","id":id,"num":num},
                    beforeSend:function(){
                    },
                    success:function(data){
                    $("#cart-number-product").html(data);
                    },
                    error: function (xhr,status,error){
                    },
                    complete: function(xhr,status){
                    }
                });
            });
        });
    </script>
    </body>
</html>
