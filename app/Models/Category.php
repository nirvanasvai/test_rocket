<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'sub_title', 'parent_id','slug','description','image', 'status','description_short'];

    public function setSlugAttribute($value) {
        $this->attributes['slug'] = Str::slug( $this->title);
    }

    public static function store($request)
    {
        $category = self::query()
            ->create([
                'title' => $request->title,
                'sub_title' => $request->sub_title,
                'parent_id' => $request->parent,
                'image'=>$request
            ]);
        self::badQueryBd($category);
    }

    public static function getCategory($id)
    {
        $Name = self::query()
            ->find($id);
        self::badQueryBd($Name);
        return $Name;
    }

    public static function getNames()
    {
        $names = self::query()->get();
        self::badQueryBd($names);
        return $names;
    }

    public static function badQueryBd($query)
    {
        if ($query == null) {
            return redirect()
                ->route('category')
                ->with('warning', 'Ошибка при запросе к бд');
        }
        return true;
    }

    public static function destroyCategory($id)
    {
        $category = self::query()
            ->where('id', $id)
            ->first();
        $childen = self::query()
            ->where('parent_id', $category->id)
            ->update(['parent_id' => null]);
        self::query()->where('id', $id)->delete();
    }


    public function scopeLastCategories($query, $count)
    {
        return $query->orderBy('created_at', 'desc')
            ->take($count)
            ->get();
    }


    public function childs()
    {
        return $this->hasMany(Category::class, 'parent_id','id');
    }
    public function parent()
    {
        return $this->hasOne(Category::class,'id', 'parent_id');
    }
    public function products()
    {
        return $this->hasMany(Product::class,'category_id', 'id');
    }
}
