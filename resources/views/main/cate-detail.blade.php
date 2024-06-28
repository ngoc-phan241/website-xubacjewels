<!DOCTYPE html>
    <head>
        <link
            rel="stylesheet"
            type="text/css"
            href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css">

            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
            <script src="https://code.jquery.com/jquery-3.7.1.js" ></script>
            <style>
                .mota{
                    
                    border: 1px solid #Dddddd;
                    margin: 25px 50px 50px 0px; 
                    background: rgb(255,228,225);
                }
                
                .content{
                    margin-left:70px;
                }
                .comment ul{
                    display:flex;
                    
                }
                .comment li{
                    color:black;
                    margin-right:40px;
                    list-style-type: none;
                    display:flex;
                }
            </style>
    </head>
    <body>
        <x-shop-layout>
            <div class="container" style="margin-bottom:70px;">
                
                
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('product')}}">Trang chủ</a></li>
                            <li class="breadcrumb-item"><a href="#">{{$data->c_name}}</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{$data->name}}</li>
                        </ol>
                    </nav>
                    <div id="wp-products">
                        <div class ="detail">
                            <div >
                                <ul id="imageGallery">
                                    <li data-thumb="{{asset('front/image/'.$data->image)}}" data-src="{{asset('front/image/'.$data->image)}}">
                                        <img width="80%" src="{{asset('front/image/'.$data->image)}}" />
                                    </li>
                                    <li data-thumb="{{asset('front/image/'.$data->image_1)}}" data-src="{{asset('front/image/'.$data->image_1)}}">
                                        <img  src="{{asset('front/image/'.$data->image_1)}}" />
                                    </li>
                                    <li data-thumb="{{asset('front/image/'.$data->image_2)}}" data-src="{{asset('front/image/'.$data->image_2)}}">
                                        <img  src="{{asset('front/image/'.$data->image_2)}}" />
                                    </li>
                                </ul>
                            </div>

                            <div style="width:500px;">
                                <div class="content">
                                    <h1 class="name"><b>{{$data->name}}</b></h1>
                                    <div class="price">
                                        @if ($data->discount == null)
                                            <b>{{number_format($data->price)}}.000đ</b> 
                                        @else
                                            <div class="sale-price">
                                                <div class="old-price">{{number_format($data->price)}}.000đ</div> 
                                                <div class="discount"><b>{{number_format($data->discount)}}.000đ</b></div> 
                                            </div> 
                                        @endif
                                    </div>
                                    <div style="border:1px solid #f0f0f0;width:350px;margin-top:10px"></div>
                                    <div class="description" style="margin:20px 0 20px 0;">{{$data->product_title}}</div>
                                    
                                    <div class="buttons" style="display:flex; width: 500px;align-items: baseline;">
                                        <h5 style="margin-top:5px; margin-right:15px;">Số lượng: </h5>
                                        <input type='number' id='product-number' size='3' min="1" value="1" style="height: 30px; width: 50px;">
                                        <button class='btn btn-danger btn-sm mb-1' id='add-to-cart' style="margin-top: 0px;"><b>THÊM VÀO GIỎ HÀNG</b></button>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-8-lg">
                            <div class="mota">
                                <div class="description" style="margin-left: 50px;">
                                    <h5><b>MÔ TẢ SẢN PHẨM</b></h5>
                                    {{$data->content}}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="com">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif
                        
                        <div class="formm">
                            <form action="{{route('comment', $data->id)}}" method="POST">
                                @csrf
                               
                                <div class="form-group" style="width:1000px;">
                                    <lable><h4><b>Bình luận</b></h4></lable><br>
                                    <input type="hidden" value="{{$data->id}}" name="id">
                                    <textarea class="form-control" rows="2" placeholder="Chia sẻ cảm nhận của bạn..." name="comment"></textarea>
                                </div>

                                <button type="submit"  class="btn btn-danger">Gửi Bình luận</button>
                            </form>
                        </div>
                        <br>
                        
                        <div class="comment">
                            @foreach($comments as $comm)
                                <ul>
                                    <li><img src="{{asset('front/image/avatar.jpg')}}" width="40px" alt="" style="margin-right:10px;">     <b>{{$comm->user->name}}</b></li>
                                    <li><div style="text-align:center;"><i class="fa fa-calendar-o"></i> {{$comm->created_at->format('H:i d/m/Y')}}</div></li>
                                    <!-- <li><a href=""><i class="fa fa-trash-o"></i></a></li> -->
                                    
                                </ul>
                                <p style="margin-left:50px;font-size:18px;">{{$comm->comment}}</p>
                            @endforeach
                        </div>
                    </div>
            </div>
             

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
            <script src="front/js/app.js"></script>
            <script src="front/js/sweetalert.min.js"></script>
            <script>
                $(document).ready(function(){
                    $("#add-to-cart").click(function(){
                    id = "{{$data->id}}";
                    num = $("#product-number").val()
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
            <script>
                $(document).ready(function() {
                    $('#imageGallery').lightSlider({
                        gallery:true,
                        item:1,
                        loop:true,//vòng lặp
                        thumbItem:3,
                        slideMargin:0,
                        enableDrag: false,
                        currentPagerPosition:'left',
                        onSliderLoad: function(el) {
                            el.lightGallery({
                                selector: '#imageGallery .lslide'
                            });
                        }   
                    });  
                });
            </script>
        </x-shop-layout>
    </body>
</html>
