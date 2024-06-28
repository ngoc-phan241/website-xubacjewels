<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;
use App\Models\Users;
use App\Exports\ProductExport;
use App\Exports\UsersExport;
use App\Exports\OrderExport;
use Excel;

class ExcelController extends Controller
{
    

    public function exportproduct() {
        return Excel::download(new ProductExport,'products.xlsx');
    }
    
    public function exportuser() {
        return Excel::download(new UsersExport,'users.xlsx');
    }

    public function exportorder() {
        return Excel::download(new OrderExport, 'orders.xlsx');
    }

}
