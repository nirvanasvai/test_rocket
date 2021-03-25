<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FiltersRelations extends Model
{
    use HasFactory;

    protected $table = 'filters_relations';

    protected $fillable = ['product_id', 'filter_id'];

    public function filter(){
        return $this->hasOne(Filter::class, 'id', 'filter_id');
    }
}
