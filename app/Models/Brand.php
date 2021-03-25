<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Brand extends Model
{
    use HasFactory;
    public $table = 'brands';
    protected $fillable = [
        'name','image','slug','description','title_name','meta_title','meta_description'
    ];

    // public function setSlugAttribute($value) {
    //     $this->attributes['slug'] = Str::slug($this->title_name);
    // }

    public function brandProduct()
    {
        $this->hasMany(Product::class);
    }


}
