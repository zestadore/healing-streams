<?php

namespace App\View\Components\layout;

use Illuminate\View\Component;

class destination extends Component
{
    public $destinations = [],$key;
    public $checkInDate;
    public function __construct($destinations,$date,$key)
    {
        $this->destinations=$destinations[0];
        $this->checkInDate=$date;
        $this->key=$key;
    }

    public function render()
    {
        return view('components.layout.destination');
    }
}
