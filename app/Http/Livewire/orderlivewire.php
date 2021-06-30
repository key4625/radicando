<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Plant;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;


use function PHPUnit\Framework\isNull;

class orderlivewire extends Component
{
    public $plant_ordered;
    public $quantity_kg, $quantity_num, $plant_sel_id;
    public $ordine, $nome, $email, $tel;

    protected $rules = [
        'nome' => 'required'   
    ];

    public function mount()
    {
        $this->plant_ordered = array();
        $this->ordine = array();
    }
    public function resetInputFields(){
        $this->nome = "";
        $this->email = "";
        $this->tel = "";
        $this->plant_ordered = array();   
        $this->ordine = array();
        $this->showMode = false;  
       
    }
    public function render()
    {
        $plants_available = Plant::where('vendibile',1)->get();
        $plants_available = $plants_available->diff(Plant::whereIn('id', $this->plant_ordered)->get());    
        return view('frontend.livewire.order',['plants_available' => $plants_available]);
    }

    public function add($plant_id)
    {
        array_push($this->plant_ordered, $plant_id);
        $this->quantity_num[$plant_id] = 0;
        $this->quantity_kg[$plant_id] = 0;
    }
    public function remove($plant_id)
    {
        $key = array_search( $plant_id, $this->plant_ordered); 
        unset( $this->plant_ordered[$key]);
        $this->quantity_num[$plant_id] = 0;
        $this->quantity_kg[$plant_id] = 0;
    }

    public function ordina()
    {      
        $this->validate();
        $ordine = new Order();
        $ordine->nome = $this->nome;
        $ordine->email = $this->email;
        $ordine->tel = $this->tel;
        $ordine->save();
      
        foreach ($this->quantity_kg as $key => $value) {
            if(($this->quantity_kg[$key]!=0)||($this->quantity_num[$key]!=0)){
                $price_kg = Plant::where('id',$key)->first()->price_kg;
                if($price_kg == null) $price_kg = 0;
                $ordine->plants()->attach($key, ['quantity_kg' => $this->quantity_kg[$key], 'quantity_num' => $this->quantity_num[$key], 'price_kg' => $price_kg]);
            }
        }  
        $this->resetInputFields();
        session()->flash('message', 'Grazie per il tuo ordine!');
    }


}
