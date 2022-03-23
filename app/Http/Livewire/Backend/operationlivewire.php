<?php

namespace App\Http\Livewire\Backend;

use App\Models\Cultivation;
use App\Models\Field;
use App\Models\Operation;
use App\Models\Operationtype;
use Livewire\Component;
use Livewire\WithPagination;

class operationlivewire extends Component
{
    use WithPagination;
    public $editMode = false;
    public $operation_id, $cultivation_id, $operationtype_id = null, $field_id, $name,$description,$tool,$surface,$quantity, $duration  ,$date_start, $date_end;
    public $operationtype_selected;
    public $operationtypes, $fields, $cultivations;
    public $operations;

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
        $actual_operations = Operation::paginate(25);
        return view('backend.livewire.operations',[
            'actual_operations' => $actual_operations,
        ]);
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
    public function setOperation($id){
        $this->operation_id = $id;
        $this->editMode = true;
        $tmp_op = Operation::find($id);
        $this->cultivation_id = $tmp_op->cultivation_id;
        $this->operationtype_id = $tmp_op->operationtype_id;
        $this->operationtype_selected = $tmp_op->operationtype;
        $this->field_id = $tmp_op->field_id;
        $this->name = $tmp_op->name;
        $this->description = $tmp_op->description;
        $this->tool = $tmp_op->tool;
        $this->surface = $tmp_op->surface;
        $this->quantity = $tmp_op->quantity;
        $this->duration = $tmp_op->duration;
        $this->date_start = $tmp_op->date_start;
        $this->date_end = $tmp_op->date_end;
    }
    public function saveOperation()
    {
        if($this->operation_id==null){
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
        } else {
            $new_operation = Operation::find($this->operation_id);
            $new_operation->cultivation_id = $this->cultivation_id;
            $new_operation->operationtype_id = $this->operationtype_id;
            $new_operation->field_id = $this->field_id;
            $new_operation->name = $this->name;
            $new_operation->description = $this->description;
            $new_operation->tool = $this->tool;
            $new_operation->surface = $this->surface;
            $new_operation->quantity = $this->quantity;
            $new_operation->duration = $this->duration;
            $new_operation->date_start = $this->date_start;
            $new_operation->date_end = $this->date_end;
            $new_operation->save();
        }
        $this->resetInputFields();
        session()->flash('message', 'Operazione inserita');
    }
}
