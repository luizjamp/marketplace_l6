<?php

namespace App;

use App\Traits\Slug;
use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Models\Category as ModelsCategory;


class Category extends ModelsCategory
{
    use Slug;

    public function children()
    {
        return $this->hasMany(Category::class,'parent_id');
    }

    public function products()
    {
        return $this->belongsToMany(Product::class,'product_categories');
    }

    public function allProduts()
    {
        $allProducts = collect([]);
        $mainCategoryProducts = $this->products;

        $allProducts = $allProducts->concat($mainCategoryProducts);

        if($this->children->isNotEmpty()){
            foreach ($this->children as $child){
                $allProducts = $allProducts->concat($child->products);
            }
        }
       return $allProducts;
    }


}
