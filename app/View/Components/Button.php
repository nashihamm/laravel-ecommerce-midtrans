<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Button extends Component
{
    public $type;
    public $class;
    public $text;
    public $variant;

    public function __construct($type = 'button', $class = '', $text = '', $variant = 'primary')
    {
        $this->type = $type;
        $this->class = $class;
        $this->text = $text;
        $this->variant = $variant;
    }

    public function render()
    {
        return view('components.button');
    }
}
