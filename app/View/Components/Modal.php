<?php

namespace App\View\Components;

use Closure;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;
class Modal extends Component
{
    public $id;
    public $title;

    public function __construct($id = 'modal', $title = null)
    {
        $this->id = $id;
        $this->title = $title;
    }

    public function render()
    {
        return view('components.modal');
    }
}