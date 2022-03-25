<?php

namespace App\Http\Livewire\Backend;

use App\Models\Field;
use Illuminate\Support\Arr;
use Livewire\Component;

class FieldSatLivewire extends Component
{
    public $field_id, $field_sel, $layer_id;
    public $gain, $gamma;
    public $fields;
    public $polygon = array();


    public function mount(){
        if(isset($_GET['idField'])){
            if(is_numeric($_GET['idField'])){
                $this->field_id = $_GET['idField'];
            } 
        } 
        $this->fields = Field::treeAll();
        $this->layer_id = "NDVI";
        $this->gain = 1;
        $this->gamma = 1;
    }

    public function render()
    {
       
        
        return view('backend.livewire.field-sat-livewire');
    }

    public function initMapIndexContent(){
        if($this->field_id !=null){
            $this->polygon = array();
           
            $this->field_sel = Field::where('id',$this->field_id)->first();
            array_push($this->polygon,array($this->field_id,json_decode($this->field_sel->points))); 
            
            $this->dispatchBrowserEvent('map-index-created', ['polList' => $this->polygon, 'layerSel'=> $this->layer_id, 'gamma_pam' => $this->gamma, 'gain_pam' => $this->gain]);
        }
        
    }

}
