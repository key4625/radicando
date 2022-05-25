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
    public $quantity, $quantity_type, $plant_sel_id;
    public $ordine, $nome, $email, $tel;
    public $showProd;
    public $showQuant, $idQuant, $typeQuant;

    protected $rules = [
        'nome' => 'required'   
    ];

    public function mount()
    {
        $this->product_ordered = array();   
        $this->plant_ordered = array();
        //$this->item_ordered = array();
        $this->ordine = array();
        $this->showProd = 0;
        $this->showQuant = 0;
        $this->nome = session()->get('name_order');
        $this->email = session()->get('name_email');
        $this->tel = session()->get('name_tel');
        $tmpordered = session()->get('items_in_order');
        if($tmpordered != null) {
            $this->item_ordered = $tmpordered;
        } else $this->item_ordered = array();
        $this->resetQuantity();
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
        session()->put('items_in_order', null);
        $this->resetQuantity();
      
    }
    public function resetQuantity(){
        $this->showProd = 0;
        $this->showQuant = 0;
        $this->idQuant = 0;
        $this->typeQuant = null;
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

    public function selProd($item_id,$type)
    {
        $this->showQuant = 1;
        $this->idQuant = $item_id;
        $this->typeQuant = $type;
        $this->quantity = 0;
        $this->quantity_type = "pz";
    }
    public function add($item_id,$type,$price)
    {
        $new_item = array('id'=>count($this->item_ordered),'item_id'=>$item_id,'type'=>$type,'quantity'=> $this->quantity, 'quantity_type'=> $this->quantity_type,'price'=>$price);
        array_push($this->item_ordered, $new_item);
        session()->put('items_in_order', $this->item_ordered);
        session()->put('name_order', $this->nome);
        session()->put('name_email', $this->email);
        session()->put('name_tel', $this->tel);
        $this->resetQuantity();
    }
    public function remove($id,$type)
    {
        $key = array_search( $id, array_column($this->item_ordered, 'id')); 
        unset( $this->item_ordered[$key]);
        session()->put('items_in_order', $this->item_ordered);
    }

    public function ordina()
    {      
        $this->validate();
        $ordine = new Order();
        $ordine->nome = $this->nome;
        $ordine->email = $this->email;
        $ordine->tel = $this->tel;
        $ordine->save();
        session()->put('name_order', $this->nome);
        session()->put('name_email', $this->email);
        session()->put('name_tel', $this->tel);
      
        foreach ($this->item_ordered as $tmp_item_ordered) {
            if($tmp_item_ordered['type']=="vegetable"){
                //$tmp_type = 'App\Models\Plant';
                $ordine->plants()->attach($tmp_item_ordered['item_id'], ['quantity_kg' => $tmp_item_ordered['quantity'], 'quantity_num' => $tmp_item_ordered['quantity'], 'price_kg' => $tmp_item_ordered['price']]);
            
            } else  {
                //$tmp_type = 'App\Models\Product';
                $ordine->products()->attach($tmp_item_ordered['item_id'], ['quantity_kg' => $tmp_item_ordered['quantity'], 'quantity_num' => $tmp_item_ordered['quantity'], 'price_kg' => $tmp_item_ordered['price']]);
            
            }  
                
        }  
        $this->resetInputFields();
        session()->flash('message', 'Grazie per il tuo ordine!');
    }


}
