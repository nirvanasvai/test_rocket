<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FilterItem extends Model
{
    use HasFactory;

    protected $fillable = ['title_item','filter_id'];

    public function itemProduct(){
        return $this->hasMany(FiltersRelations::class, 'filter_id');
    }
    
    public function parentFilter(){
        return $this->hasMany(Filter::class, 'id','filter_id');
    }

}
