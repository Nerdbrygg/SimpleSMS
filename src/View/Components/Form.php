<?php

namespace Nerdbrygg\SimpleSMS\View\Components;

use Illuminate\View\Component;

class Form extends Component
{
    public $title;

    public $source;

    /**
     * Create a new component instance.
     *
     *
     * @return void
     */
    public function __construct($title = null, bool $source = true)
    {
        $this->title = $title;
        $this->source = $source;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('nerdbrygg::components.form');
    }
}
