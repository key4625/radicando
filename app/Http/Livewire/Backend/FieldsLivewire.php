<?php

namespace App\Http\Livewire\Backend;

use App\Models\Field;
use Illuminate\Support\Arr;
use Livewire\Component;
use Livewire\WithPagination;

class FieldsLivewire extends Component
{
    use WithPagination;
    protected $listeners = ['delete','addPointFromMap','addPolygonFromMap','setAreaMq','toggleUpdate'];
    public $field_id, $name, $location, $points = array(), $mq;
    public $polygons = array();
    public $editMode = false;
    public $showMode = false;

    public function resetInputFields(){       
        $this->editMode = false;   
        $this->field_id = null;
        $this->name = "";
        $this->location = "";
        $this->points = array();
        $this->mq = "";
    }

    public function render()
    {
        $this->polygons = array();
        foreach(Field::where('parent_id',0)->get() as $tmp_field){
            array_push($this->polygons,array($tmp_field->id,json_decode($tmp_field->points)));
        }
        return view('backend.livewire.fields-livewire', ['fields' => Field::where('parent_id',0)->orderby('created_at')->paginate(25)]);
    }

    public function toggleInsert(){
        $this->editMode = true; 
        $this->showMode = false;      
    }

    public function toggleUpdate($field_selected_id) {
        $field_updating = Field::find($field_selected_id);
        $this->field_id = $field_updating->id;
        $this->name = $field_updating->name;
        $this->location = $field_updating->location;
        $this->points = json_decode($field_updating->points);
        $this->mq = $field_updating->mq;
        $this->showMode = false;    
        $this->editMode = true;
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
    /*public function addPointFromMap($cords){
        $new_point = array($cords['lat'],$cords['lng']);
        array_push($this->points,$new_point);
        $this->refreshMapContent();
    }*/

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

    public function store()
    {
        $validatedDate = $this->validate([
            'name' => 'required',  
        ]);
        if ($this->field_id == null){
            $field = new Field;
        } else {
            $field = Field::find($this->field_id); 
        }
        $field->name = $this->name;
        $field->location = $this->location;
        $field->points = json_encode($this->points);
        $field->mq = $this->mq;
        $field->save();
        $this->resetInputFields();     
        session()->flash('message', 'Terreno aggiornato con successo.');
        
    }



    public function initMapContent(){
        if(($this->editMode)||($this->showMode)){
            $this->dispatchBrowserEvent('map-created', ['pointList' => $this->points]);
        }
    }

    public function initMapIndexContent(){
        if((!$this->editMode)&&(!$this->showMode)){
            $this->dispatchBrowserEvent('map-index-created', ['polList' => $this->polygons]);
        }
    }

    public function refreshMapContent(){
        if(($this->editMode)||($this->showMode)){
            $this->dispatchBrowserEvent('map-updated', ['pointList' => $this->points]);
        }
    }

    public function delete($id)
    {
        $field = Field::findOrFail($id);
        
        Field::find($id)->delete();
        $this->dispatchBrowserEvent('field-deleted',['field_name'=>$field->name]);
    }

}
