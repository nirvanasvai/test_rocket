<?php

namespace App\Models;

use App\Services\Admin\AboutService;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class About extends Model
{
    use HasFactory;

    public $table = 'abouts';

    protected $fillable = [
        'image','description','advantages','title_name','meta_title','meta_description','meta_keyword','block_image','icon','page_type','slug'
    ];

    // public function setSlugAttribute($value) {
    //     $this->attributes['slug'] = Str::slug($this->title_name);
    // }

    public function updateAbout($request, $id)
    {
        $about = About::query()->find($id);
        //dd($request->all());
        if (isset($request->block_image)) {
            $about->block_image = $request->block_image->store('/about');
        }

        if (isset($request->image)) {
            $about->image = $request->image->store('/about');
        }

        if (isset($request->icon)) {
            $about->icon = $request->icon->store('/about/icon');
        }
        if (isset($request->page_type)) {
            $about->page_type = $request->get('page_type');
        }
        $about->description = $request->get('description');
        $about->advantages = $request->get('advantages');
        $about->title_name = $request->get('title_name');
        $about->meta_title = $request->get('meta_title');
        $about->meta_description = $request->get('meta_description');

        return $about;
    }

//    public function childrenImgAbout(){
//        return $this->hasMany(Image::class,'about_id', 'id');
//    }

}
