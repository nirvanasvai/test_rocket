<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CallBackUrl extends Model
{
    use HasFactory;

    protected $fillable = ['name','email','phone','url','product_name','comment', 'product_id'];
    public function product()
    {
        return $this->hasOne(Product::class, 'id','product_id');
    }
}
