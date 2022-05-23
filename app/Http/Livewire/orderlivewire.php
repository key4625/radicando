<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Plant;
use App\Models\Order;
use App\Models\Product;
use Arr;
use Illuminate\Support\Facades\Auth;


use function PHPUnit\Framework\isNull;

class orderlivewire extends Component
{
    public $plant_ordered,  $product_ordered, $item_ordered;
    public $quantity_kg, $quantity_num, $plant_sel_id;
    public $ordine, $nome, $email, $tel;
    public $showProd;

    protected $rules = [
        'nome' => 'required'   
    ];

    public function mount()
    {
        $this->product_ordered = array();   
        $this->plant_ordered = array();
        $this->item_ordered = array();
        $this->ordine = array();
        $this->showProd = 0;
    }
    public function resetInputFields(){
        $this->nome = "";
        $this->email = "";
        $this->tel = "";
        $this->plant_ordered = array();   
        $this->product_ordered = array(); 
        $this->item_ordered = array();  
        $this->ordine = array();
        $this->showMode = false;  
        $this->showProd = 0;
       
    }
    public function render()
    {
        $plants_available = Plant::where('vendibile',1)->get();
        $plant_filtered = Arr::where( $this->item_ordered, function ($value, $key) {
            return $value['type'] == 1;
        });
        $product_filtered = Arr::where( $this->item_ordered, function ($value, $key) {
            return $value['type'] == 2;
        });
        $plants_available = $plants_available->diff(Plant::whereIn('id', $plant_filtered)->get());    
        $products_available = Product::where('vendibile',1)->get();
        $products_available = $products_available->diff(Product::whereIn('id', $product_filtered)->get());    
        return view('frontend.livewire.order',['plants_available' => $plants_available, 'products_available' => $products_available]);
    }

    public function viewProd($val){
        $this->showProd = $val;
    }

    public function add($item_id,$type)
    {
        $new_item = array('id'=>count($this->item_ordered),'item_id'=>$item_id,'type'=>$type,'quantity_num'=>0,'quantity_kg'=>0);
        array_push($this->item_ordered, $new_item);
        //$this->quantity_num[$plant_id] = 0;
        //$this->quantity_kg[$plant_id] = 0;
    }
    public function remove($id,$type)
    {
        $key = array_search( $id, array_column($this->item_ordered, 'id')); 
        unset( $this->item_ordered[$key]);
        //$this->quantity_num[$plant_id] = 0;
        //$this->quantity_kg[$plant_id] = 0;
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
