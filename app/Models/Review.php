<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = ['name','last_name','image','review','rating','product_id', 'status'];

    public function product()
    {
        return $this->hasOne(Product::class, 'id','product_id');
    }


}
