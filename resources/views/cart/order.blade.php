<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Xứ Bạc Jewels</title>
        <!-- Google Font -->
        <link href="https://fonts.googleapis.com/css?family=Muli:300,400,500,600,700,800,900&display=swap" rel="stylesheet">

        <!-- bootstrap -->
    
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
            
        <!--<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>-->
        
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

        <!-- Css Styles -->
        <link rel="stylesheet" href="{{asset('front/css/bootstrap.min.css')}}" type="text/css">
        <link rel="stylesheet" href="{{asset('front/css/font-awesome.min.css')}}" type="text/css">
        <link rel="stylesheet" href="{{asset('front/css/themify-icons.css')}}" type="text/css">
        <link rel="stylesheet" href="{{asset('front/css/elegant-icons.css')}}" type="text/css">
        <link rel="stylesheet" href="{{asset('front/css/owl.carousel.min.css')}}" type="text/css">
        <link rel="stylesheet" href="{{asset('front/css/nice-select.css')}}" type="text/css">
        <link rel="stylesheet" href="{{asset('front/css/jquery-ui.min.css')}}" type="text/css">
        <link rel="stylesheet" href="{{asset('front/css/slicknav.min.css')}}" type="text/css">
        <link rel="stylesheet" href="{{asset('front/css/style.css')}}" type="text/css">  
        <link rel="stylesheet" href="{{asset('front/css/sweetalert.css')}}" type="text/css">
        <link rel="stylesheet" href="{{asset('front/css/main.css')}}" type="text/css">
    <style>
        .container {
        display: flex;
        justify-content: center;
        margin-bottom: 10px;
        }

        .customer-info, .order-info {
            max-width: 50%;
            height: 90%;
            padding: 20px;
            box-sizing: border-box;
            overflow-x: auto; /* Đảm bảo thanh cuộn ngang nếu nội dung vượt quá */
        }

        .customer-info {
            margin-right: 20px;
        }

        .order-info {
            margin-left: 20px;
        }

        .customer-info form,
        .order-info table {
            max-width: 100%;
        }

        .customer-info label,
        .customer-info input,
        .customer-info select,
        .customer-info button {
            display: block;
            margin-bottom: 5px;
        }

        .order-info .order-summary {
            margin-top: 20px;
        }

        .product-table {
            width: 100%;
            border-collapse: collapse;
        }

        .product-table th, .product-table td {
            border-bottom: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        .product-table th {
            background-color: transparent;
        }

        .customer-info select {
            display: inline-block;
            vertical-align: middle;
        }
        .vertical-divider {
            border-left: 1px solid #ddd; /* Màu và độ dày của đường ngăn cách */
            height: 100%; /* Chiều cao bằng chiều cao của phần tử cha */
            margin: 0 20px; /* Khoảng cách giữa đường ngăn cách và các phần khác */
        }
        .order-summary select {
                float: right; /* Đặt ô select sang phải */
                width: 50%; /* Đặt kích thước cho ô select */
        }
        .order-summary input {
            float: right; /* Đặt ô select sang phải */
            width: 50%; /* Đặt kích thước cho ô select */
        }
        .customer-info button {
            background-color: #009900; /* Màu xanh lá cây nhạt */
            border: none; /* Loại bỏ viền */
            font-weight: bold;
            cursor: pointer; /* Biểu tượng con trỏ khi di chuột qua nút */
            
        }

        .order-info button[type="submit"] {
            background-color:#009900; /* Màu xanh lá cây nhạt khi di chuột qua */
            border: none;
            cursor: pointer;
            font-weight: bold;
        }
        p {
            margin-bottom: 10px; /* Đặt margin dưới của mỗi phần tử <p> là 10px */
        }
        .logo li{
            list-style-type: none;
        }
        .infor-cus{
            margin-top:15px;
        }
        .td-tt{
            text-align:center;
        }
        .sum-td{
            width: 75%;
            float: left;
            padding: 8px;
        }
        .total-price{
            padding: 8px;
        }
        .radio-input {
            display: table;
            box-sizing: border-box;
            border: 1px solid #333;
            height:40px;
            text-align:center;
        }
        .radio-label {
            cursor: pointer;
            vertical-align: middle;
            display: table-cell;
            width: 100%;
        }
            </style>
    </head>
    <body>
        <div class="container">
            <div class="row" style="width:1100px;margin:40px 0 40px 0;">
                <!--<div class="page-order" style="width:1400px;">-->
                
                        <div class="col-xl-7">
                            <div class="logo" style=" display:flex;">
                                <li><img src="{{asset('front/image/logo.jpg')}}" width="150px" alt=""></li>
                                <li><img src="{{asset('front/image/slogan.jpg')}}" width="auto" height="100px" alt=""></li>
                            </div>
                            <div class="infor-cus">
                                <div class="td-tt">
                                    <b><h4>THÔNG TIN MUA HÀNG</h4></b>
                                </div>
                                <div>
                                <form action="{{route('ordersave')}}" method="POST" style="margin-bottom:30px; margin-top: 20px;">
                                        <label><b>Họ và tên</b></label>
                                        <input type='text' class='form-control form-control-sm' id="name" name="name"  value="{{$user->name}}" required> 
                                        
                                        <label><b>Số điện thoại</b></label>
                                        <input type='text' class='form-control form-control-sm' id="phone" name="phone"  value="{{$user->phone}}" required >

                                        <label><b>Email</b></label>
                                        <input type='text' class='form-control form-control-sm' id="email" name="email"  value="{{$user->email}}"required>

                                        <label><b>Địa chỉ</b></label>
                                        <textarea  style="resize: none"  id='content' class="form-control" rows="2" id="address"  name='address' value="{{$user->address}}" required>{{$user->address}}</textarea>
                                       
                                        <label></label>
                                        <textarea  style="resize: none"  id='note' class="form-control" rows="3" placeholder="Ghi chú (Tùy chọn)" name='notee'></textarea>
                                        <input type ='hidden'  value="{{$user->id}}"name='id'>
                                        {{ csrf_field() }}
                                        
                                   
                                </div>
                            </div>
                            <div class="infor-cus">
                                <div >
                                    <b>Phí Vận chuyển</b>
                                </div>
                                <div style="border:1px solid #333; text-align:center;border-radius:7px;">
                                    Giao hàng tận nơi 25.000đ
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-5">
                            <div >
                                <b><h4>ĐƠN HÀNG </h4></b>
                            </div>
                            <div>
                                @php
                                    $tongTien = 0;
                                    $discount= 0;
                                    $tongTien1=0;
                                    $sum=0;
                                    $Sum=0;
                                    $total=0;
                                @endphp
                                <table style="width:428px;">
                                    @foreach($data as $key=>$row)
                                        <tr style="border-bottom: 1px solid #333;padding:10px;">
                                            <td width="90px">  <img src="{{asset('front/image/'.$row->image)}}" width='90px' height='90px' style="border-radius:5px;">  </td>
                                            <td width="180px;">{{$row->name}}</td>
                                            <td width="35px;">{{$quantity[$row->id]}} x</td>
                                            <td style ="width:80px;" >
                                                @if($row->discount == null)
                                                    {{number_format($row->price)}}.000đ
                                                @else
                                                    <div class="sale-price" style ="width:80px;">
                                                        <div class="discount" style="color:red;width:150px;width:80px;"><b>{{number_format($row->discount, 0, '.', '.')}}.000đ</b></div> 
                                                        <div class="old-price" style="text-decoration: line-through;color:#E0E0E0;width:150px;width:80px;">{{number_format($row->price, 0, '.', '.')}}.000đ</div> 
                                                    </div> 
                                                @endif
                                            </td>
                                        </tr>
                                        @php
                                            if( $row->discount == null){
                                                $tongTien += ($row->price * $quantity[$row->id]);
                                                $sum+=$tongTien;
                                            }else{
                                                $discount += ($row->discount * $quantity[$row->id]);
                                                $Sum+=$discount;

                                            }
                                        @endphp
                                    @endforeach
                                </table>
                                @php
                                    $vanchuyen=25;
                                    $tongTien1= $tongTien + $discount;
                                @endphp
                            </div>

                            <div>

                                <div class="sum-td"><b>Tạm tính: </b></div>
                                <div class="total-price">{{number_format($tongTien1, 0, '.', '.')}}.000đ</div>

                                <div class="sum-td"><b>Phí vận chuyển: </b></div>
                                <div class="total-price"> {{number_format($vanchuyen)}}.000đ</div>
                                        @php
                                            $total=$tongTien1+$vanchuyen;
                                        @endphp
                            </div>
                            <div style="border:0.5px solid #333;"></div>
                            <div>
                                <div class="sum-td"><h5><b>Tổng cộng: </b></h5></div>
                                <div class="total-price"><b>{{number_format($total, 0, '.', '.')}}.000đ</b></div>
                                
                            </div>

                            <div> 
                                
                                    <div class="order-summary">
                                        <div class="pttt" style="align-items: center;display: flex">
                                            <label for="payment_method"><strong>Phương thức thanh toán:</strong></label>
                                            <select style="width:230px;height:40px;overflow: auto;border-radius:7px;text-align:left;" id="payment_method" name="payment_method" onclick="showPaymentInfo()">
                                                <option value="Thanh toán khi nhận hàng">Thanh toán khi nhận hàng</option>
                                                <option value="Chuyển khoản qua ngân hàng">Chuyển khoản qua ngân hàng</br>
                                            </select>
                                        </div>
                                        <div id="bankTransferInfo" style="display:none;"></div>
                                        <input type="hidden" id="total_amount" name="total_amount" value="{{number_format($total, 0, '.', '.')}}.000đ"></br>
                                        <input type ='hidden'  value="{{$user->id}}" name='id'>
                                        <input type ='hidden' value='{{$total}}' name='total'>
                                        {{ csrf_field() }}
                                        <button type="submit" class="button btn btn-default">Đặt hàng</button>
                                    </div>
                                </form
                            </div>
                        </div>
            </div> <!-- -->
        </div>

        <script>
        
        /*<!--<button style="text-align:center;" type="button" class='btn btn-primary mt-1' onclick="batNutDatHang()">Lưu thông tin</button>-->
          onclick="return kiemTraDatHang()" id="datHangButton"
        // Ban đầu, tắt nút "Đặt hàng"
        document.getElementById("datHangButton").disabled = true;

        function batNutDatHang() {
            // Bật nút "Đặt hàng" khi người dùng bấm nút "Lưu thông tin"
            document.getElementById("datHangButton").disabled = false;
        }

        function kiemTraDatHang() {
            // Kiểm tra xem nút "Lưu thông tin" đã được bấm chưa
            if (document.getElementById("datHangButton").disabled) {
                alert("Vui lòng lưu thông tin khách hàng trước khi đặt hàng!");
                return false;
            }
            return true;
        }*/

        function showPaymentInfo() {
            var paymentMethod = document.getElementById("payment_method").value;
            var bankTransferInfo = document.getElementById("bankTransferInfo");

            // Ẩn thông tin chuyển khoản trước khi hiển thị thông tin mới
            bankTransferInfo.style.display = "none";

            if (paymentMethod === "Chuyển khoản qua ngân hàng") {
                // Nếu chọn phương thức chuyển khoản qua ngân hàng
                // Hiển thị thông tin chuyển khoản
                bankTransferInfo.innerHTML = "<p>Quý khách có thể thanh toán chuyển khoản từ tài khoản cá nhân của mình đến tài khoản của Xứ Bạc:</p> <h5>Thông tin chuyển khoản</h5> <li>Tên ngân hàng: Timo by Ban Viet Bank</li><li>Số tài khoản: 9021750780892</li> <li>Người thụ hưởng: PHAN HUYNH HONG NGOC</li><b>Nội dung chuyển khoản:</b> Tên khách hàng - Số điện thoại đặt hàng <br> <img src='front/image/ttck.jpg'> <p>Nếu trong vòng 24h khách hàng chưa chuyển khoản cho cửa hàng thì cửa hàng sẽ tự động hủy đơn của quý khách.</p> ";
                bankTransferInfo.style.display = "block";
            } else {
                // Nếu chọn phương thức thanh toán khi nhận hàng, không cần hiển thị thông tin
                bankTransferInfo.innerHTML = "<p>Bạn có thể nhận hàng và kiểm tra hàng rồi thanh toán 100% giá trị đơn hàng cho đơn vị vận chuyển.</p>";
                bankTransferInfo.style.display = "block";
            }
        }
        </script>
    </body>
</html>
