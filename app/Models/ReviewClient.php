<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReviewClient extends Model
{
    use HasFactory;

    protected $fillable = ['name','last_name','rating','status','product_id','review','image'];
}
