<?php

namespace App\Http\Livewire\Backend;

use App\Models\Field;
use Livewire\Component;
use Illuminate\Support\Arr;

class lotslivewire extends Component
{
 
    public $fields;
    //public $cultivations;
    public $field_sel;
    public $field_id,$parent_id, $name, $location, $length = 0, $width = 0, $points = array(), $mq;
    public $mostraTutti = false;
    public $polygons = array();
    public $editMode = false;   
    protected $listeners = ['addPolygonFromMap','setAreaMq','delete','setLots'];

    //use WithPagination;

    protected $rules = [
        'name' => 'required'   
    ];
    public function mount()
    {
      $this->fields = Field::where('parent_id',0)->orderby('name')->get();
    }
    public function resetInputFields(){
        $this->field_id = null;
        $this->parent_id = null;
        $this->name = null;
        $this->location = null;
        $this->length = 0;
        $this->width = 0;
        $this->points = array();  
        $this->editMode = false;     
        //$this->cultivations = Cultivation::all();
    }
    public function render()
    {       
        $this->polygons = array();
        if($this->parent_id != null){
            $fields_tmp = Field::select('*')->where('parent_id',$this->parent_id)->orwhere('id',$this->parent_id)->get();
        } else $fields_tmp = Field::all();
     
        foreach($fields_tmp as $field_tmp){
            if($field_tmp->actual_cultivation() != null) { 
                $img_cult = $field_tmp->actual_cultivation()->cultivable->icon; 
                $color_cult = $field_tmp->actual_cultivation()->cultivable->color; 
                $border_color_cult = $field_tmp->actual_cultivation()->cultivable->border_color; 
                array_push($this->polygons,array($field_tmp->id,json_decode($field_tmp->points),$img_cult, $color_cult, $border_color_cult)); 
            } else { 
                if($field_tmp->parent_id==0){
                    array_push($this->polygons,array($field_tmp->id,json_decode($field_tmp->points),null, "#c3c3c3", "#c3c3c3"));      
                } else  {
                    array_push($this->polygons,array($field_tmp->id,json_decode($field_tmp->points),null, "#3388ff", "#3388ff"));  
                }   
            }
        }
        
        if($this->editMode){
            $this->refreshMapContent();
        }
        //$this->cultivations = Cultivation::orderby('data_inizio', 'desc')->paginate(25);
        return view('backend.livewire.lots',[
            'fields' => $fields_tmp ,
        ]);
    }

    public function toggleEdit(){
        if($this->editMode){
            $this->initIndexMapContent();
            $this->editMode = false; 
            $this->resetInputFields();
        } else {
            $this->initMapContent();
            $this->editMode = true; 
        }
        //$this->showMode = false;      
    }

    public function addPoint() 
    {
        $new_point = array(00.00,00.00);
        array_push($this->points,$new_point);
        $this->refreshMapContent();
    }

    public function removePoint($key) 
    {
        $tmp_arr = Arr::except($this->points, $key);
        $this->points = array();
        foreach($tmp_arr as $tmp_point)
        {
            array_push($this->points,$tmp_point);
        }
        $this->refreshMapContent();
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

    public function initIndexMapContent(){
        if((!$this->editMode)){
            $this->dispatchBrowserEvent('map-index-created', ['polList' => $this->polygons]);
        }
    }

    public function initMapContent(){
        $this->dispatchBrowserEvent('map-created', ['polList' => $this->polygons]);
    }

    public function refreshMapContent(){
        $this->dispatchBrowserEvent('map-updated', ['polList' => $this->polygons,'pointList' => $this->points]);      
    }

    public function setLots($field_id){
        $this->editMode = true;
        $this->initMapContent();
        $this->field_sel = Field::find($field_id);
        $this->field_id = $field_id;
        $this->parent_id = $this->field_sel->parent_id;
        $this->name = $this->field_sel->name;
        $this->location = $this->field_sel->location;
        $this->mq = $this->field_sel->mq;
        $this->length = $this->field_sel->length;
        $this->width = $this->field_sel->width;
        $this->points = json_decode($this->field_sel->points);
    }

    public function saveLot(){
        $this->validate();
        if($this->field_id!=null){
            $newField = Field::find($this->field_id);
        } else  $newField = new Field();
      
        //$newField->field_id = $this->field_id;
        $newField->name = $this->name;
        $newField->location = $this->location;
        $newField->length = $this->length;
        $newField->width = $this->width;
        $newField->parent_id = $this->parent_id;
        $newField->mq = $this->mq;
        $newField->points = json_encode($this->points);
        $newField->save();
        $this->resetInputFields();
        session()->flash('message', 'Lotto salvato');
    }

    public function delete($id)
    {
        $field = Field::findOrFail($id);
        
        Field::find($id)->delete();
        $this->dispatchBrowserEvent('field-deleted',['field_name'=>$field->name]);
    }

 


}
