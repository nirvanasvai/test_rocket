<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    public $table = 'images';

    protected $fillable = ['image','product_id', 'product_article'];

    public function addImage($arImage, $productId)
    {
        if ($arImage) {
            foreach ($arImage as $image)
            {
                $ar[] = [
                  'image' => $image,
                  'product_id' => $productId,

                ];
            }
            $this->query()->insert($ar);
        }

    }


}
