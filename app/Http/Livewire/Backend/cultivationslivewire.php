<?php

namespace App\Http\Livewire\Backend;

use App\Models\Field;
use Livewire\Component;
use App\Models\Plant;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;


use function PHPUnit\Framework\isNull;

class cultivationslivewire extends Component
{
 
    public $plants, $fields;
    public $plant_id, $field_id;
    public $field_sel;
    public $varieta;
    public $points;
    public $polygons = array();
    public $mq;
    protected $listeners = ['addPolygonFromMap','setAreaMq'];
    public function mount()
    {
      $this->plants = Plant::orderBy('nome')->get();
      $this->fields = Field::orderBy('name')->get();
    }
    public function resetInputFields(){
      
       
    }
    public function render()
    {
        $this->polygons = array();
        $this->field_sel =  Field::where('id',$this->field_id)->first();
        if($this->field_id!=null){
            array_push($this->polygons,array($this->field_sel->id,json_decode($this->field_sel->points)));
            $this->refreshMapContent();
        }
        return view('backend.livewire.cultivations');
    }

    public function addPolygonFromMap($layer){
        //dd($layer);
        $this->points = array();
        foreach($layer[0] as $tmp_point){
            $new_point = array($tmp_point['lat'],$tmp_point['lng']);
            array_push($this->points,$new_point);
        }
    }

    public function setAreaMq($totArea){
        $this->mq = intval($totArea);
    }

    public function initMapContent(){
        $this->dispatchBrowserEvent('map-created', ['polList' => $this->polygons]);
    }

    public function refreshMapContent(){
        if($this->field_id!=null){
            $this->dispatchBrowserEvent('map-updated', ['polList' => $this->polygons]);
        }
    }

 


}
