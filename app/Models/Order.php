<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Order extends Model
{
    
    protected $table = 'orders';
    public static function getOrders() {
        $records = DB::table('orders')
            ->join('order_detail', 'orders.id_order', '=', 'order_detail.id_order')
            ->join('users', 'orders.user_id', '=', 'users.id')
            ->join('product', 'order_detail.product_id', '=', 'product.id')
            ->select('orders.id_order', 
                    'users.name as customer_name',
                    'users.phone',
                    'users.email',
                    'users.address',
                    DB::raw('GROUP_CONCAT(product.name SEPARATOR ", ") as product_names'),
                    DB::raw('GROUP_CONCAT(order_detail.quantity SEPARATOR ", ") as quantities'),
                    DB::raw('SUM(order_detail.price) as total_price'),
                    'orders.date', 
                    'orders.status', 
                    'orders.payments')
            ->groupBy('orders.id_order', 'users.name', 'users.phone','users.email','users.address','orders.date', 'orders.status', 'orders.payments')
            ->orderBy('orders.id_order', 'asc') 
            ->get();
        
        return $records;
    }
    
}

