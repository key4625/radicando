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
    public $item_ordered;
    public $quantity, $quantity_um, $plant_sel_id;
    public $ordine, $nome, $cognome, $email, $tel, $indirizzo, $citta, $data_consegna, $consegna_domicilio, $price;
    public $showProd;
    public $showQuant, $idQuant, $typeQuant;
    public $passo;

    protected $rules = [
        'nome' => 'required'   
    ];

    public function mount()
    {

        //$this->item_ordered = array();
        $this->ordine = array();
        $this->showProd = 0;
        $this->showQuant = 0;
        $this->passo = 0;
        $this->data_consegna = date('Y-m-d');
        $this->consegna_domicilio = 1;
        $this->nome = session()->get('name_order');
        $this->cognome = session()->get('surname_order');
        $this->email = session()->get('name_email');
        $this->tel = session()->get('name_tel');
        $this->indirizzo = session()->get('name_indir');
        $this->citta = session()->get('name_citta');
        $this->citta = session()->get('consegna_domicilio');
        $tmpordered = session()->get('items_in_order');
        //session()->put('items_in_order', null);
        if($tmpordered != null) {
            $this->item_ordered = $tmpordered;
        } else $this->item_ordered = array();
        $this->resetQuantity();
    }
    public function resetInputFields(){
        /*$this->nome = "";
        $this->email = "";
        $this->tel = "";
        $this->indirizzo = "";
        $this->citta = "";*/
        $this->item_ordered = array();  
        $this->ordine = array();
        $this->showMode = false;  
        $this->passo = 0;
        session()->put('items_in_order', null);
        $this->resetQuantity();
      
    }

    public function resetQuantity(){
        $this->showQuant = 0;
        $this->idQuant = 0;
        $this->typeQuant = null;
    }
    public function render()
    {
        $plants_available = Plant::where('vendibile',1)->get();
        /*$plant_filtered = Arr::where( $this->item_ordered, function ($value, $key) {
            return $value['type'] == "vegetable";
        });
        $product_filtered = Arr::where( $this->item_ordered, function ($value, $key) {
            return $value['type'] == "product";
        });*/
        //$plants_available = $plants_available->diff(Plant::whereIn('id', $plant_filtered)->get());    
        $products_available = Product::where('vendibile',1)->get();
        //$products_available = $products_available->diff(Product::whereIn('id', $product_filtered)->get());    
        return view('frontend.livewire.order',['plants_available' => $plants_available, 'products_available' => $products_available]);
    }

    public function viewProd($val){
        $this->showProd = $val;
    }

    public function selProd($item_id,$type,$price_um,$quantity_um)
    {
        $this->showQuant = 1;
        $this->idQuant = $item_id;
        $this->typeQuant = $type;
        $this->quantity = 0;
        
        $arr_quant = explode(',',$quantity_um);
        if($arr_quant[0]!=null){
            $this->quantity_um =$arr_quant[0]; 
        } else $this->quantity_um =$price_um; 
    }

    public function add($item_id,$type,$price, $price_um)
    {
        if($this->quantity != 0){
            /*$findmax = 0;
            if(($this->item_ordered!=null)&&(count($this->item_ordered)>0)){
                foreach($this->item_ordered as $single){
                    if($single['id_num'] > $findmax)  $findmax = $single['id_num'];
                }
            }*/
            //$new_item = array('id_num'=>$findmax+1,'item_id'=>$item_id,'type'=>$type,'quantity'=> $this->quantity, 'quantity_um'=> $this->quantity_um, 'price_um'=> $price_um,'price'=>$price);
            $new_item = array('item_id'=>$item_id,'type'=>$type,'quantity'=> $this->quantity, 'quantity_um'=> $this->quantity_um, 'price_um'=> $price_um,'price'=>$price);
            array_push($this->item_ordered, $new_item);
            session()->put('items_in_order', $this->item_ordered);
            session()->put('name_order', $this->nome);
            session()->put('surname_order', $this->cognome);
            session()->put('name_email', $this->email);
            session()->put('name_tel', $this->tel);
            session()->put('name_indir', $this->indirizzo);
            session()->put('name_citta', $this->citta);
            $this->resetQuantity();
        }
    }
    public function remove($key)
    {
        //$key = array_search( $id, array_column($this->item_ordered, 'id_num')); 
        //dd($key);
        unset( $this->item_ordered[$key]);
        session()->put('items_in_order', $this->item_ordered);
    }

    public function ordina()
    {      
        $this->validate();
        $ordine = new Order();
        $ordine->nome = $this->nome;
        $ordine->cognome = $this->cognome;
        $ordine->email = $this->email;
        $ordine->tel = $this->tel;
        $ordine->indirizzo = $this->indirizzo;
        $ordine->citta = $this->citta;
        $ordine->consegna_domicilio = $this->consegna_domicilio;
        $ordine->data =  $this->data_consegna;
        $ordine->prezzo_tot = 0;
        $ordine->sconto_perc = 0;
        $ordine->tipo_cliente = 'privato';
        $ordine->save();
        session()->put('name_order', $this->nome);
        session()->put('surname_order', $this->cognome);
        session()->put('name_email', $this->email);
        session()->put('name_tel', $this->tel);
        session()->put('name_indir', $this->indirizzo);
        session()->put('name_citta', $this->citta);
      
        foreach ($this->item_ordered as $tmp_item_ordered) {
            if($tmp_item_ordered['type']=="vegetable"){
                $tmp_plant = Plant::where('id',$tmp_item_ordered['item_id'])->first();
                $ordine->plants()->attach($tmp_plant, ['quantity' => $tmp_item_ordered['quantity'], 'quantity_um' => $tmp_item_ordered['quantity_um'],'price_um' => $tmp_item_ordered['price_um'], 'price' => $tmp_item_ordered['price']]);
            
            } else  {
                //$tmp_type = 'App\Models\Product';
                $tmp_prod = Product::where('id',$tmp_item_ordered['item_id'])->first();
                $ordine->products()->attach($tmp_prod, ['quantity' => $tmp_item_ordered['quantity'], 'quantity_um' => $tmp_item_ordered['quantity_um'], 'price_um' => $tmp_item_ordered['price_um'], 'price' => $tmp_item_ordered['price']]);
            
            }  
                
        }  
        $this->resetInputFields();
        $this->passo = 3;
        session()->flash('message', 'Grazie per il tuo ordine!');
    }


}
