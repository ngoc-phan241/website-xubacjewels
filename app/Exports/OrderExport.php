<?php

namespace App\Exports;

use App\Models\Order;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class OrderExport implements FromCollection,WithHeadings
{
    public function headings():array {
        return [
            "Mã đơn hàng", 
            "Tên khách hàng",
            "Số điện thoại",
            "Email",
            "Địa chỉ",
            "Sản phẩm",
            "Số lượng",
            "Tổng tiền",
            "Ngày đặt", 
            "Trạng thái", 
            "Hình thức thanh toán",
        ];
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Order::getOrders();
    }
}
