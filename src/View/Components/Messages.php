<?php

namespace Nerdbrygg\SimpleSMS\View\Components;

use Illuminate\View\Component;
use Nerdbrygg\SimpleSMS\SMS;

class Messages extends Component
{
    public $title;

    public $messages;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($title = null)
    {
        $this->title = $title;

        $this->messages = SMS::latest()->take(10)->get();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('nerdbrygg::components.messages');
    }
}
