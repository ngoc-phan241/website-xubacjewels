<x-shop-layout>
    
    <x-slot name='title'>
        Đặt hàng
    </x-slot>
    <style>
        #buy-amount{
            display:flex;
        }
        #buy-amount button{
            width:30px;
            height:30px;
            outline:none;
            background:none;
            border:1px solid #ececec;
            cursor:pointer;
        }
        #buy-amount button:hover{
            background-color:#ececec;
        }
        #buy-amount button {
            color: #909090;
        }
        #buy-amount button:hover {
            color: #4f4f4f;
        }
        #buy-amount .quantity{
            width:35px;
            text-align:center;
            border:1px solid #ececec;
        }
        .comeback{
            width:150px;
            height:30px;
            background-color:#fcadad;
            border-radius:5px;
            text-align:center;
        }
    </style>
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('product')}}">Trang chủ</a></li>
                <li class="breadcrumb-item"><a href="#">Giỏ hàng</a></li>
            </ol>
        </nav>
        
        <div class="main-cart" style="margin-bottom:50px;">
            <div class="title-cart">
                <div class="title-cart main">
                    <h4>Giỏ hàng của bạn</h4>
                    @if($sum!=0)
                    <p class="count-cart">Có <span>{{$sum}}</span> sản phẩm trong giỏ hàng</p>
                    
                </div>
            </div>
           
            <div class="row">
                <div class="col-lg-9">
                    <table style="border: 1px solid #ddd; border-radius:5%;">
                        <thead style="border:1px solid #ddd; text-align:center;height:45px;">
                            <th width="300px">Thông tin sản phẩm</th>
                            <th  width="300px"></th>
                            <th width="150px">Đơn giá</th>
                            <th width="150px">Số lượng</th>
                            <th width="200px">Thành tiền</th>
                            <th width="100px"></th>
                        </thead>
                        <tbody>
                    @php
                        $thanh_tien=0;
                        $Thanh_tien=0;
                        $sum=0;
                        $Sum=0;
                        $tongTien = 0;
                    @endphp
                    @foreach($data as $key=>$row)
                       <tr style="border-bottom:1px #ddd dotted; padding: 15px 10px;text-align:center;">
                            <td>  <img src="{{asset('front/image/'.$row->image)}}" width='150px' height='150px' style="border-radius:5px;">  </td>
                            <td>{{$row->name}}</td>
                            <td align='center'width="100px" >
                                @if($row->discount == null)
                                {{number_format($row->price)}}.000đ
                                @else
                                    <div class="sale-price">
                                        <div class="discount" style="color:red;"><b>{{number_format($row->discount, 0, '.', '.')}}.000đ</b></div> 
                                        <div class="old-price" style="text-decoration: line-through;color:#E0E0E0;">{{number_format($row->price, 0, '.', '.')}}.000đ</div> 
                                    </div> 
                                @endif
                            </td>
                            <td align='center'width="100px">
                                <div id="buy-amount">
                                    <button class="minus-btn decrease" id_san_pham = "{{$row->id}}" 
                                            price="{{$row->price}}" discount="{{$row->discount}}">-</button>
                                    <input class="quantity" type='text' id='quantity-{{$row->id}}' size='3' min="1" value="{{$quantity[$row->id]}}" style="height: 30px; width: 40px;">
                                    <button  class="plus-btn increase" id_san_pham = "{{$row->id}}" 
                                            price="{{$row->price}}" discount="{{$row->discount}}">+</button>
                                </div>
                            </td>
                            @php
                                if($row->discount == null)
                                    {
                                        $thanh_tien =$quantity[$row->id]*$row->price;
                                        $sum += $thanh_tien;
                                    }
                                else
                                    {
                                        $Thanh_tien=$quantity[$row->id]*$row->discount;
                                        $Sum += $Thanh_tien;
                                    }
                            @endphp
                            
                            <td align='center'width="100px" id="price-{{$row->id}}">
                                @if($row->discount == null)
                                    {{number_format($thanh_tien, 0, '.', '.')}}.000đ
                                @else
                                    {{number_format($Thanh_tien, 0, '.', '.')}}.000đ
                                @endif
                            </td>
                            @php
                                $tongTien = $sum + $Sum;
                            @endphp
                            <td align='center'width="100px">
                                <form method='post' action = "{{route('cartdelete')}}" 
                                    onsubmit="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này không?');">
                                        <input type='hidden' value='{{$row->id}}' name='id'>
                                        <input type='submit' class='btn btn-sm btn-danger' value='Xóa'>
                                        {{ csrf_field() }}
                                </form>
                            </td>
                       </tr>
                    @endforeach
                    
                </tbody>
                    </table>
                </div>
            </div>

            <div class="footer-cart">
                <div class="row">
                    <div class="col-lg-6 ">
                        <a href="{{route('product')}}">Tiếp tục mua sắm</a>
                    </div>
                    <div class="col-lg-3 ">
                        <div class="subtotal-price">
                            <div class="sum-price"><b>TỔNG TIỀN: </b></div>
                            <div class="total-price"><b> {{number_format($tongTien, 0, '.', '.')}}.000đ </b></div>
                        </div>
                        <div class="cart-btn">
                            <form method="post" action="{{route('order')}}">
                                <!-- Các input ẩn để truyền dữ liệu sản phẩm và số lượng -->
                                @foreach($data as $key => $row)
                                    <input type="hidden" name="products[{{ $key }}][id]" value="{{$row->id }}">
                                    <input type="hidden" name="products[{{ $key }}][name]" value="{{$row->name }}">
                                    <input type="hidden" name="products[{{ $key }}][quantity]" value="{{$quantity[$row->id]}}">
                                    <input type="hidden" name="products[{{ $key }}][price]" value="{{$row->price}}">
                                @endforeach

                                <!-- Nút thanh toán -->
                                <button type="submit" class="button btn btn-danger" name="checkout"><b>Thanh toán</b></button>
                                {{ csrf_field() }}
                            </form>
                            
                        </div>
                    </div>
                </div>
            </div>
            @else
                <div class="count-cart">Bạn chưa có sản phẩm nào trong giỏ hàng</div>     
                <div class="comeback" style=""><a href="{{route('product')}}">Tiếp tục mua sắm</a></div>  
            @endif
        </div>
        
    </div> 
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
    $(document).ready(function() {
        // Xử lý sự kiện khi nhấn nút tăng
        $('.increase').each(function(){
            $(this).click(function() {
                var idSP = $(this).attr("id_san_pham");
                var quantity = parseInt($('#quantity-'+idSP).val());
                 quantity++;
                 $('#quantity-'+idSP).val(quantity);

                // Gửi yêu cầu AJAX để cập nhật giá trị trong session
                updateSession(quantity,idSP);
                var price = $(this).attr("price");
                var discount = $(this).attr("discount");
                var total = quantity*parseFloat(price);
                if(discount!="")
                    total = quantity*parseFloat(discount);
                 $("#price-"+idSP).html(formatCurrency(total));

                //updatePrice(quantity);
                updateTotalPrice();
            });


        });

        // Xử lý sự kiện khi nhấn nút giảm
        $('.decrease').each(function(){
            $(this).click(function() {
                var idSP = $(this).attr("id_san_pham");
                var quantity = parseInt($('#quantity-'+idSP).val());
                if (quantity > 1) {
                quantity--;
                $('#quantity-'+idSP).val(quantity);

                // Gửi yêu cầu AJAX để cập nhật giá trị trong session
                updateSession(quantity,idSP);
                var price = $(this).attr("price");
                var discount = $(this).attr("discount");
                var total = quantity*parseFloat(price);
                if(discount!="")
                    total = quantity*parseFloat(discount);
                $("#price-"+idSP).html(formatCurrency(total));
                //updatePrice(quantity);
                updateTotalPrice();
                }
            });
        });

        // Hàm gửi yêu cầu AJAX để cập nhật giá trị trong session
        function updateSession(quantity, id) {
            
            // Gửi yêu cầu AJAX để cập nhật giá trị trong session
            $.ajax({
            url: "{{ route('cartad') }}",
            method: 'POST',
            data: {
                "_token": "{{ csrf_token() }}",
                "id": id,
                "quantity": quantity
            },
            beforeSend: function() {
                // Xử lý trước khi gửi yêu cầu (nếu cần)
            },
            success: function(response) {
                // Xử lý phản hồi từ máy chủ (nếu cần)
            },
            error: function(xhr, status, error) {
                // Xử lý lỗi (nếu có)
            }
            });
        }
        });

        function updateTotalPrice() {
            total_price = 0;
            $('.decrease').each(function(){
                var idSP = $(this).attr("id_san_pham");
                var quantity = $("#quantity-"+idSP).val();
                var price = $(this).attr("price");
                var discount = $(this).attr("discount");
                var total = quantity*parseFloat(price);
                if(discount!="")
                    total = quantity*parseFloat(discount);
                total_price += total;
            });
            $(".total-price").html("<b>"+formatCurrency(total_price, 0, '.', '.')+"</b>");
        }

        // Hàm định dạng giá tiền
        function formatCurrency(value) {
            // Định dạng giá tiền theo ý muốn của bạn (ví dụ: 1,000,000)
            // return value.toLocaleString('en-US');
            return value.toFixed(3).replace(/\B(?=(\d{3})+(?!\d))/g, '.') + 'đ';
        }


        
                            
    </script>

</x-shop-layout>

