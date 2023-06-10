<?php

namespace App\View\Components\forms;

use Illuminate\View\Component;

class input extends Component
{
    
    public $title = "";
    public $name = "";
    public $required = "";
    public $id = "";
    public $type = "";
    public $class= "";
    public $value="";
    
    public function __construct($title,$name,$required,$id,$type,$class,$value=0)
    {
        $this->title = $title;
        $this->name = $name;
        $this->required = $required;
        $this->id = $id;
        $this->type = $type;
        $this->class = $class;
        $this->value = $value;
    }

    public function render()
    {
        return view('components.forms.input');
    }
}
