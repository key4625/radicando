<?php

namespace App\Http\Livewire\Backend;

use App\Models\Cultivation;
use App\Models\Field;
use Livewire\Component;
use App\Models\Plant;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Livewire\WithPagination;

use function PHPUnit\Framework\isNull;

class cultivationslivewire extends Component
{
 
    public $plants, $fields;
    //public $cultivations;
    public $plant_id, $field_id;
    public $field_sel;
    public $cult_id, $varieta,$sigla_fila, $larghezza, $lunghezza, $data_inizio, $data_fine, $innesto;
    public $points;
    public $mostraTutti = false;
    public $polygons = array();
    public $superficie_tot;
    protected $listeners = ['addPolygonFromMap','setAreaMq','delete'];

    use WithPagination;

    protected $rules = [
        'plant_id' => 'required',
        'field_id' => 'required'   
    ];
    public function mount()
    {
      $this->plants = Plant::orderBy('nome')->get();
      $this->fields = Field::orderBy('name')->get();
      $this->data_inizio = date("Y-m-d");
    }
    public function resetInputFields(){
        $this->cult_id = null;
        $this->plant_id = null;
        $this->field_id = null;
        $this->varieta = null;
        $this->sigla_fila = null;
        $this->lunghezza = null;
        $this->larghezza = null;
        $this->data_fine = null;
        $this->innesto = null;
        $this->data_inizio = date("Y-m-d");
        $this->points = array();    
        //$this->cultivations = Cultivation::all();
    }
    public function render()
    {
        $this->polygons = array();
        $this->field_sel =  Field::where('id',$this->field_id)->first();
        if($this->field_id!=null){
            array_push($this->polygons,array($this->field_sel->id,json_decode($this->field_sel->points)));
            $this->refreshMapContent();
        }
        if($this->mostraTutti){
            $cultiv = Cultivation::orderby('data_inizio', 'desc')->paginate(25);
        } else {
            $cultiv = Cultivation::where('data_fine', '>',NOW())->paginate(25);
        }
        //$this->cultivations = Cultivation::orderby('data_inizio', 'desc')->paginate(25);
        return view('backend.livewire.cultivations',[
            'cultivations' => $cultiv ,
        ]);
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
        $this->superficie_tot = intval($totArea);
    }

    public function initMapContent(){
        $this->dispatchBrowserEvent('map-created', ['polList' => $this->polygons]);
    }

    public function refreshMapContent(){
        if($this->field_id!=null){
            $this->dispatchBrowserEvent('map-updated', ['polList' => $this->polygons]);
        }
    }
    public function setCultivation($cult_id){
        $cultiv_sel = Cultivation::find($cult_id);
        $this->cult_id = $cult_id;
        $this->plant_id = $cultiv_sel->plant_id;
        $this->field_id = $cultiv_sel->field_id;
        $this->varieta = $cultiv_sel->varieta;
        $this->sigla_fila = $cultiv_sel->sigla_fila;
        $this->lunghezza = $cultiv_sel->lunghezza;
        $this->larghezza = $cultiv_sel->larghezza;
        $this->data_inizio = $cultiv_sel->data_inizio;
        $this->data_fine = $cultiv_sel->data_fine;
        $this->innesto = $cultiv_sel->innesto;
        $this->points = json_decode($cultiv_sel->innesto);
    }
    public function saveCultivation(){
        $this->validate();
        if($this->cult_id!=null){
            $newCultivation = Cultivation::find($this->cult_id);
        } else  $newCultivation = new Cultivation();
      
        $newCultivation->plant_id = $this->plant_id;
        $newCultivation->field_id = $this->field_id;
        $newCultivation->varieta = $this->varieta;
        $newCultivation->sigla_fila = $this->sigla_fila;
        $newCultivation->lunghezza = $this->lunghezza;
        $newCultivation->larghezza = $this->larghezza;
        $newCultivation->data_inizio = $this->data_inizio;
        $newCultivation->data_fine = $this->data_fine;
        $newCultivation->innesto = $this->innesto;
        $newCultivation->points = json_encode($this->points);
        $newCultivation->save();
        $this->resetInputFields();
        session()->flash('message', 'Coltivazione salvata');
    }

    public function delete($id)
    {
        $cultivation = Cultivation::findOrFail($id);
        
        Cultivation::find($id)->delete();
        $this->dispatchBrowserEvent('cultivation-deleted',['cult_name'=>$cultivation->plant->name]);
    }

 


}
