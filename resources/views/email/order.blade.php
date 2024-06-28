
<h2>Xin chào {{$c_name}}</h2>
    <p>
        <b>Bạn đã đặt hàng thành công tại cửa hàng Xứ Bạc Jewels của chúng tôi</b>
    </p>
    <h4>Thông tin đơn hàng của bạn</h4>
    <p> Tên khách hàng: {{$c_name}} <p>
    <p> Số điện thoại: {{$c_phone}} <p>
    <p> Địa chỉ: {{$c_address}} <p>
    <p> Ngày đặt hàng: {{$date}} <p>
    <p> Phương thức thanh toán: {{$payments}} <p>
    <h4>Chi tiết sản phẩm</h4>
    <table width="600" cellspacing="0" cellpadding="10" border="1" >
        <thead style="border:1px solid #ddd; text-align:center;height:45px;">
            <th width="400px">Thông tin sản phẩm</th>
            <th width="100px">Số lượng</th>
            <th width="100px">Đơn giá</th>
        </thead>
        <tbody style="border:1px solid #ddd; text-align:center;height:45px;">
            @foreach($data as $key => $row)
                <tr style="padding: 10px;">
                    <td style="width: 400px;">{{$row->name}}</td>
                    <td style="width: 100px;">{{$quantity[$key]}} </td>
                    <td style="width: 100px;">
                        @if($row->discount == null)
                            {{number_format($row->price)}}.000đ
                        @else
                            <div class="sale-price" style="width: 80px;">
                                <div class="discount" style="color: red;"><b>{{number_format($row->discount, 0, '.', '.')}}.000đ</b></div>
                                <div class="old-price" style="text-decoration: line-through; color: #E0E0E0;">{{number_format($row->price, 0, '.', '.')}}.000đ</div>
                            </div>
                        @endif
                    </td>
                </tr>
            @endforeach
                
        </tbody>
    </table>
    <p style="margin-left:400px; "><b>Phí vận chuyển: 25.000đ</b></p>
    <p style="margin-left:400px; "><b>Tổng tiền: {{ number_format($total_price, 0, '.', '.') }}.000đ</b></p>
    @if(trim($payments) == "Chuyển khoản qua ngân hàng")
        <p>Quý khách có thể thanh toán chuyển khoản từ tài khoản cá nhân của mình đến tài khoản của Xứ Bạc</p> 
        <h4>Thông tin chuyển khoản</h4> 
            <li>Tên ngân hàng: Timo by Ban Viet Bank</li>
            <li>Số tài khoản: 9021750780892</li> 
            <li>Người thụ hưởng: PHAN HUYNH HONG NGOC</li>
        <b>Nội dung chuyển khoản:</b> Tên khách hàng - Số điện thoại đặt hàng <br> 
        <p>Nếu trong vòng 24h khách hàng chưa chuyển khoản cho cửa hàng thì cửa hàng sẽ tự động hủy đơn của quý khách.</p>
    @endif
    <p><h4><i>Cảm ơn bạn đã đến với Xứ Bạc Jewels!</i></4></p>

    <p>Mọi thắc mắc liên hệ Xứ Bạc Jewels qua:</p>
    <li><b>Địa chỉ: </b> S10.06.01S19 Origami Vinhomes Grand Park, Quận 9, Thủ Đức, HCM.</li>
    <li><b>Hotline: </b>097 585 43 25</li>
    <li><b>Email: </b></b> xubac1010@gmail.com</li>
