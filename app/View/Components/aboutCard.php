<?php

namespace App\View\Components;

use Illuminate\View\Component;

class aboutCard extends Component
{
    public $title;
    public $content1;
    public $content2;
    public $pFloatDir;
    public $imgFloatDir;
    public $imgSrc;

    /**
     * Create a new component instance.
     *
     * @return void
    */

    public function __construct(
        $title,
        $content1,
        $pFloatDir="float-left ml-3",
        $imgFloatDir="float-left",
        $imgSrc="b",
        $content2="Default Content")
    {
        $this->title = $title;
        $this->content1 = $content1;
        $this->content2 = $content2;
        $this->pFloatDir = $pFloatDir;
        $this->imgFloatDir = $imgFloatDir;
        $this->imgSrc = $imgSrc;
    }

    public function imgPassed() {
        return $this->imgSrc != 'b';
    }

    public function content2Passed() {
        return $this->content2 == 'Default Content';
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
    */

    public function render()
    {
        return view('components.aboutCard');
    }
}
