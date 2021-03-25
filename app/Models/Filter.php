<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Filter extends Model
{
    use HasFactory;

    protected $fillable = ['title'];

    public function item(){
        return $this->hasMany(FilterItem::class, 'filter_id');
    }

}
