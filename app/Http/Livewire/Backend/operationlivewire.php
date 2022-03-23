<?php

namespace App\Http\Livewire\Backend;

use App\Models\Cultivation;
use App\Models\Field;
use App\Models\Operation;
use App\Models\Operationtype;
use Livewire\Component;

class operationlivewire extends Component
{
    public $editMode = false;
    public $cultivation_id, $operationtype_id = null, $field_id, $name,$description,$tool,$surface,$quantity, $duration  ,$date_start, $date_end;
    public $operationtype_selected;
    public $operationtypes, $fields, $cultivations;

    public function mount(){
        $this->operationtypes = Operationtype::where('visible',1)->get();
        $this->date_start = date("Y-m-d");
        $this->date_end = date("Y-m-d");
        $this->fields = Field::treeAll();
        $this->cultivations = Cultivation::filtra_attive()->get();
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
    public function setOtype($id_type){
        $this->operationtype_id = $id_type;
        $this->operationtype_selected = Operationtype::find($id_type);
    }
    public function saveOperation()
    {
        $new_operation = Operation::create([
            'cultivation_id' => $this->cultivation_id,
            'operationtype_id' => $this->operationtype_id,
            'field_id' => $this->field_id,
            'name' => $this->name,
            'description' => $this->description,
            'tool' => $this->tool,
            'surface' => $this->surface,
            'quantity' => $this->quantity,
            'duration' => $this->duration,
            'date_start' => $this->date_start,
            'date_end' => $this->date_end,
        ]);
        $this->resetInputFields();
        session()->flash('message', 'Operazione inserita');
    }
}
