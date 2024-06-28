
<x-admin-layout>
    <style>
        .table-container {
   
    overflow-y: auto; /* Tạo thanh cuộn dọc nếu bảng vượt quá chiều cao */
}

.custom-table {
    width: 100%; /* Chiều rộng của bảng */
    border-collapse: collapse; /* Gộp đường viền của các ô */
}

.custom-table th,
.custom-table td {
    border: 1px solid #dddddd; /* Định dạng đường viền cho các ô */
    padding: 8px; /* Đặt khoảng cách bên trong các ô */
    text-align: left; /* Canh lề văn bản của các ô */
}

.custom-table th {
    background-color: #f2f2f2; /* Màu nền cho tiêu đề bảng */
}
    </style>
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
        <div>
        <div style='text-align:center;font-weight:bold;color:#15c;'><h2>QUẢN LÝ ĐƠN HÀNG</h2></div>
        <div style="margin:10px; text-align: right;">
        <form action="{{route('exportorder')}}" method="GET">
            <button type="submit" class="btn btn-primary">Xuất file</button>
        </form>
    </div>
   <div class="table-container">
   <table class='table table-striped table-bordered' id="order-table">
        <thead style=" text-align:center;height:45px;">
            <tr>
                <th width="80px">ID Đơn hàng</th>
                <th>Tên khách hàng</th>
                <!--<th>Sản phẩm - Số lượng</th>-->
                <th  width="80px">Thành tiền</th>
                <th>Ngày đặt</th>
                <th>Hình thức thanh toán</th>
                <th>Trạng thái</th>
                <th>Chi tiết</th>
                <th>Xóa</th>
            </tr>
        </thead>
        <tbody style=" text-align:center;">
        
            @foreach($orders as $order)
                <tr>
                    <td width="80px">{{ $order->id_order_1 }}</td>
                    <td>{{ $order->customer_name }}</td>
                    <!--<td>
                        <ul>
                            @foreach($order->products as $product)
                                <li>{{ $product->product_name }} - {{ $product->quantity }}</li>
                            @endforeach
                        </ul>
                    </td>-->
                    <td width="80px">{{ number_format($order->total_price, 0, '.', '.') }}.000đ</td>
                    <td>{{ $order->date }}</td>
                    <td>{{ $order->payments }}</td>
                    <td>{{ $order->status }}</td>
                    <td style="width:70px;"> 
                        <form method="GET" action="{{route('order_edit')}}">
                        <input type='hidden' value='{{$order->id_order_1}}' name='id_order_1'>
                            @foreach($order->products as $product)
                                <input type='hidden' value='{{$product->product_name}}' name='product_name'>
                                <input type='hidden' value='{{$product->quantity}}' name='quantity'> 
                                
                            @endforeach
                        <input type='hidden' value='{{$order->customer_name}}' name='customer_name'> 
                        <input type='hidden' value='{{$order->user_id}}' name='user_id'>
                        <input type='hidden' value='{{$order->status}}' name='status'> 
                        <input type='hidden' value='{{$order->date}}' name='date'>
                        <input type='hidden' value='{{$order->payments}}' name='payments'>
                        <input type='hidden' value='{{$order->total_price}}' name='total_price'> 
                            @csrf
                        <button type="submit" class="btn btn-primary">Chi tiết</button>
                        </form>
                    </td>
                    
                    <td>
                    <form method='post' action = "{{route('order_delete')}}" 
                        onsubmit="return confirm('Bạn có chắc chắn muốn xóa đơn hàng này không?');">
                            <input type='hidden' value='{{$order->id_order_1}}' name='id'>
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

    <script>
        $(document).ready(function(){
            $("#order-table").DataTable(
                {
                    responsise: true, //sự co giãn-->
                    "bStateSave": true
                }
            );
        });
    </script>
</x-admin-layout>
