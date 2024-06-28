<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model{
    use HasFactory;

    protected $fillable = ['product_id','blog_id','user_id', 'comment'];

    public function user(){
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}