<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Users extends Model
{
    protected $table = 'users';
    public static function getUsers() {
        $records = DB::table('users')
                        ->select("id","name","email","phone","address")
                        ->where('roles','0')
                        ->orderBy('id','asc')
                        ->get()->toArray();
        return $records;
    }
}
