<x-admin-layout>
    @if ($errors->any())
        <div style='color:red;width:30%; margin:0 auto'>
            <div>{{ __('Whoops! Something went wrong.') }}</div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
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
        <form action="{{ route('order_save') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div style='text-align:center;font-weight:bold;color:#15c;'>CHI TIẾT THÔNG TIN ĐƠN HÀNG</div>

            <label for="name">Tên khách hàng</label>
            <input type='text' class='form-control form-control-sm' name='name' id="name" value="{{ $user->name ?? '' }}">

            <label for="phone">Số điện thoại</label>
            <input type='text' class='form-control form-control-sm' name='phone' id="phone" value="{{ $user->phone ?? '' }}">

            <label for="address">Địa chỉ</label>
            <input type='text' class='form-control form-control-sm' name='address' id="address" value="{{ $user->address ?? '' }}">

            <label for="email">Email</label>
            <input type='text' class='form-control form-control-sm' name='email' id="email" value="{{ $user->email ?? '' }}">

            <label for="product_info">Thông tin sản phẩm (Tên sản phẩm - Số lượng, mỗi sản phẩm một dòng)</label>
            <textarea class='form-control form-control-sm' name='product_info' id="product_info" rows="5">@foreach($orderDetails as $detail){{ $detail->product_name }} - {{ $detail->quantity }}&#13;&#10;@endforeach</textarea>

            <label for="total_price">Tổng tiền</label>
            <input type='text' class='form-control form-control-sm' name='total_price' id="total_price" value="{{number_format( $order->total_price ?? '') }}">000đ

            <label for="status">Tình trạng đơn hàng</label>
            <select class='form-control form-control-sm' name='status' id="status">
                <option value="Người bán đang chuẩn bị hàng" {{ (isset($order->status) && $order->status == 'Người bán đang chuẩn bị hàng') ? 'selected' : '' }}>Người bán đang chuẩn bị hàng</option>
                <option value="Đang giao hàng" {{ (isset($order->status) && $order->status == 'Đang giao hàng') ? 'selected' : '' }}>Đang giao hàng</option>
                <option value="Giao hàng thành công" {{ (isset($order->status) && $order->status == 'Giao hàng thành công') ? 'selected' : '' }}>Giao hàng thành công</option>
                <option value="Hủy đơn hàng" {{ (isset($order->status) && $order->status == 'Hủy đơn hàng') ? 'selected' : '' }}>Hủy đơn hàng</option>
            </select>

            <label for="payments">Hình thức thanh toán</label>
            <select class='form-control form-control-sm' name='payments' id="payments">
                <option value="Chuyển khoản qua ngân hàng" {{ (isset($order->payments) && $order->payments == 'Chuyển khoản qua ngân hàng') ? 'selected' : '' }}>Chuyển khoản qua ngân hàng</option>
                <option value="Thanh toán khi nhận hàng" {{ (isset($order->payments) && $order->payments == 'Thanh toán khi nhận hàng') ? 'selected' : '' }}>Thanh toán khi nhận hàng</option>
            </select>

            <input type='hidden' value="{{ $user->id }}" name='id'>
            <input type='hidden' value="{{ $order->id_order }}" name='id_order'>

            <div style='text-align:center;'>
                <input type='submit' class='btn btn-primary mt-1' value='Lưu'>
            </div>
            <pre>

            
        </form>
    </div>
</x-admin-layout>
