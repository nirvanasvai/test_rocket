<?php
namespace App\Services\Filters;

use Highlight\Highlighter;
use Illuminate\Http\Request;

class ProductService
{
    public function foreachCategorySelected($inputCategories = null, $allCategories)
    {
        foreach ($allCategories as $mainCategory)
        {
            foreach($mainCategory->parentCategoryTo as $childenCat)
            {
                if(isset($childenCat->id) and $inputCategories != null)
                {
                    if(in_array($childenCat->id, $inputCategories))
                    {
                        $childenCat->selected = 'selected';
                    }
                }
            }

        }
        return $allCategories;
    }


    public function hl($code)
    {
//        $code = str_replace(['&gt;', '<pre>', '</pre>'], ['>', '', ''], $code);
        $hl = new Highlighter();
        $hl->setAutodetectLanguages(array('php', 'javascript', 'css', 'html'));
        $highlighted = $hl->highlightAuto($code);
//        echo "<pre><code class=\"hljs {$highlighted->language}\">";
//        echo $highlighted->value;
//        echo "</code></pre>";
        return "<pre><code class=\"hljs {$highlighted->language}\">".($highlighted->value)."</code></pre>";
    }

}
