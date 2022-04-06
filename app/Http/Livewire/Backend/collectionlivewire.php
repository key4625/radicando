<?php

namespace App\Http\Livewire\Backend;

use App\Models\Collection;
use Livewire\Component;
use App\Models\Plant;
use App\Models\Order;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;


use function PHPUnit\Framework\isNull;

class collectionlivewire extends Component
{
    public $plant_collected;
    public $quantity_kg, $quantity_num, $plant_name, $plant_image;

    public function mount()
    {
        $this->plant_collected = 0;
    }
    public function resetInputFields(){
        $this->plant_collected = 0;   
    }
    public function render()
    {
        $plants_available = Plant::where('vendibile',1)->get();
        
        //$plants_available = $plants_available->diff(Plant::whereIn('id', $this->plant_collected)->get());    
        return view('backend.livewire.collection',['plants_available' => $plants_available]);
    }

    public function add($plant_id)
    {
        $this->plant_collected = $plant_id;
        $plant = Plant::where('id',$plant_id)->first();
        $this->plant_image= $plant->image;
        $this->plant_name= $plant->nome;
        $this->quantity_num = 0;
        $this->quantity_kg = 0;
    }

    public function raccogli()
    {      
        $collection = new Collection();
        $collection->plant_id = $this->plant_collected;
        $collection->quantity_num = $this->quantity_num;
        $collection->quantity_kg = $this->quantity_kg;
        $collection->save();
        $this->resetInputFields();
        session()->flash('message', 'Raccolto inserito!');
    }


}
