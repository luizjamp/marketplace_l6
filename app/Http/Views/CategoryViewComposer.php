<?php


namespace App\Http\Views;


use App\Category;

class CategoryViewComposer
{
    private $category;

    public function __construct(Category $category)
    {
        $this->category = $category;
    }


    public function compose($view)
    {
        $categories = Category::whereNull('parent_id')->get();

        //return $view->with('categories',$this->category->all(['name','slug']));

        return $view->with('categories',$categories->all(['name','slug']));

    }
}
