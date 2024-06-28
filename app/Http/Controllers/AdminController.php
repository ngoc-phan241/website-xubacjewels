<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class AdminController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    
    public function dashboard()
    {
        $product_count = DB::table('product')->count();;
        $order_count = DB::table('orders')->count();
        $user_count = DB::table('users')->where('roles', 0)->count();
        $cate_count = DB::table('categories')->count();

        // Lấy tổng doanh thu và kiểm tra nếu kết quả không rỗng
        $revenue_result = DB::select("SELECT SUM(total_price) as total_revenue FROM orders;");
        $revenue = !empty($revenue_result) ? $revenue_result[0]->total_revenue : 0;

        $order = DB::table('orders')
                ->orderBy('date', 'desc')
                ->limit(10)
                ->get();  

        $static = DB::table('order_detail as od')
        ->join('product as p', 'od.product_id', '=', 'p.id')
        ->select('p.name', DB::raw('SUM(od.quantity) as total_quantity'))
        ->groupBy('p.name')
        ->orderBy('p.name', 'asc')
        ->get();

        $static_1= DB::select("SELECT u.name,  COUNT(od.id_order) AS order_count FROM orders od JOIN users u ON od.user_id = u.id GROUP BY u.name ORDER BY u.name ASC;");
    
        return view("admin.qldashboard", compact('product_count','order_count', 'user_count','revenue', 'order', 'cate_count','static','static_1'));
    }
}
