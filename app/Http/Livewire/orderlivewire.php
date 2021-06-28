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
        'nome' => 'required',
        'email' => 'email',
        'tel' => 'required'
    ];

    public function mount()
    {
        $this->plant_ordered = array();
        $this->ordine = array();
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
    public function ordina()
    {      
        $this->validate();
        $ordine = new Order();
        $ordine->nome = $this->nome;
        $ordine->email = $this->email;
        $ordine->tel = $this->tel;
        $ordine->save();
        foreach ($this->quantity_kg as $key => $value) {
            $ordine->plants()->attach($key, ['quantity_kg' => $this->quantity_kg[$key], 'quantity_num' => $this->quantity_num[$key]]);
            //1, ['products_amount' => 100, 'price' => 49.99]
            //array_push($this->ordine, array($key, Plant::find($key)->nome, $this->quantity_kg[$key], $this->quantity_num[$key]));
        }
        //$ordine->save();
        //dd($this->ordine);
      
       
       
    }


}
