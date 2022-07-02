<?php

namespace App\View\Components;

use Illuminate\View\Component;

class CategoryTableRow extends Component
{
    public $category;

    public $level;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($category, $level)
    {
        $this->category = $category;
        $this->level = $level;
    }


    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.category-table-row');
    }
}
