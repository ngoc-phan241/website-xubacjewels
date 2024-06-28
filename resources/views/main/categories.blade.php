<x-shop-layout>
    <div class="container">
        <div id="wp-products" style="margin-bottom:50px">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('product')}}">Trang chủ</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{$namecate->c_name}}</li>
            </ol>
        </nav>
            <div class="sale-hot">
                <div class='list-product'>
                        @foreach($data as $row)
                            <div class="product">
                                <a class="item"  href="{{url('categories/detail/'.$row->id)}}">
                                    @if ($row->discount != null)
                                        <span class="badge rounded-pill text-bg-danger">-{{$row->percent}}%</span>
                                    @endif                           
                                    <img src="{{asset('front/image/'.$row->image)}}" width='150px' height='150px'><br>
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
                                    <button class="btn btn-danger btn-sm mb-1 add-product" product_id="{{$row->id}}">
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
</x-shop-layout>