<?php

namespace App\View\Components;

use Illuminate\View\Component;

class CategorySelectOption extends Component
{

    public $category;

    public $level;

    public $post;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($category, $level, $post = null)
    {
        $this->category = $category;
        $this->level = $level;
        $this->post = $post;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.category-select-option');
    }
}
