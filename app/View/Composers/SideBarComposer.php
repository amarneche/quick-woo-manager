<?php
namespace App\View\Composers;

use App\Models\Category;
use Illuminate\View\View;

class SideBarComposer {
    protected $categories;
    public function __construct(){
        $this->categories = Category::all();
    }

    public function compose (View $view){
        $view->with(['categories'=>$this->categories]);
    }
}