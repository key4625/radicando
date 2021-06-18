<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Plant;
use Illuminate\Support\Facades\Auth;


use function PHPUnit\Framework\isNull;

class Order extends Component
{
    public $plant_ordered;

    public function mount()
    {
        $this->plant_ordered = array();
    }
    public function resetInputFields(){
        $this->showMode =false;
     
    }
    public function render()
    {
        $plants_available = Plant::all();
        $plants_available = $plants_available->diff(Plant::whereIn('id', $this->plant_ordered)->get());
        
        return view('frontend.livewire.order',['plants_available' => $plants_available]);
    }

    public function add($plant_id)
    {
        //dd($this->plant_ordered);
        //$plant = Plant::find($plant_id);
        array_push($this->plant_ordered, $plant_id);
        //dd($this->plant_ordered);
    }


}
