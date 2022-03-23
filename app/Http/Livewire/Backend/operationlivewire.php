<?php

namespace App\Http\Livewire\Backend;

use App\Models\Operationtype;
use Livewire\Component;

class operationlivewire extends Component
{
    public $editMode = false;
    public $cultivation_id, $operationtype_id, $field_id, $name,$description,$tool,$surface,$quantity, $duration  ,$date_start, $date_end;
    public $operationtypes;
    public function mount(){
        $this->operationtypes = Operationtype::where('visible',1)->get();
    }
    public function resetInputFields(){
        $this->cultivation_id = null;
        $this->operationtype_id = null;
        $this->field_id = null;
        $this->name = null;
        $this->description = null;
        $this->tool = null;
        $this->surface = null;
        $this->quantity = null;
        $this->duration = null;
        $this->date_start = date("Y-m-d");
        $this->date_end = date("Y-m-d");
        $this->editMode = false;     
        //$this->cultivations = Cultivation::all();
    }

    public function render()
    {
        return view('backend.livewire.operations');
    }

    public function toggleEdit(){
        if($this->editMode){
            $this->editMode = false; 
            $this->resetInputFields();
        } else {
            $this->editMode = true; 
        }  
    }
}
