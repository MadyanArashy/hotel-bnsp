<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Form extends Component
{
    public $jenisKamars;
    /**
     * Create a new component instance.
     */
    public function __construct($jenisKamars)
    {
         $this->jenisKamars = $jenisKamars;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.form');
    }
}
