<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Blog extends Model
{
    use HasFactory;

    protected $fillable = ['title','name','image','description','slug', 'icon', 'page_type'];

    public function setSlugAttribute($value) {
        $this->attributes['slug'] = Str::slug($this->title);
    }
}
