<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Product extends Model
{
    protected $table = 'product';
    public static function getProducts() {
        $records = DB::table('product')
                        ->select("id","name","categories","price","discount")
                        ->orderBy('id','asc')
                        ->get()->toArray();
        return $records;
    }
}