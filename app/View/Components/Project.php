<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Project extends Component
{
    public $title;
    public $desc;
    public $technology;
    public $link;
    public $dur;
    public $img1;
    public $img2;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($title,
                                $desc,
                                $technology,
                                $link,
                                $dur,
                                $img1,
                                $img2
    )
    {
        $this->title = $title;
        $this->technology = $technology;
        $this->link = $link;
        $this->dur = $dur;
        $this->img1 = $img1;
        $this->img2 = $img2;
        $this->desc = $desc;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.project');
    }
}
