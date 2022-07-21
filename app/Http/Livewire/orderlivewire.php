<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Plant;
use App\Models\Order;
use App\Models\Product;
use App\Models\Setting;
use Arr;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Mail;

use function PHPUnit\Framework\isNull;

class orderlivewire extends Component
{
    public $item_ordered;
    public $quantity, $quantity_um, $plant_sel_id;
    public $ordine, $nome, $cognome, $email, $tel, $indirizzo, $citta, $data_consegna, $consegna_domicilio, $notes, $price, $ordine_tot;
    public $ordine_non_completo = false;
    public $showProd;
    public $showQuant, $idQuant, $typeQuant;
    public $passo;
    public $array_date_possibili;

    protected $rules = [
        'nome' => 'required' ,  
        'cognome' => 'required',
        'citta' =>'required_if:consegna_domicilio,1',
        'data_consegna' => 'required'
    ];

    public function mount()
    {

        //$this->item_ordered = array();
        
        $this->ordine = array();
        $this->showProd = 1;
        $this->showQuant = 0;
        $this->passo = 0;
        $this->data_consegna = null;
        $this->consegna_domicilio = 1;
        $this->nome = session()->get('order_name');
        $this->cognome = session()->get('order_surname');
        $this->email = session()->get('order_email');
        $this->tel = session()->get('order_tel');
        $this->indirizzo = session()->get('order_indir');
        $this->citta = session()->get('order_citta');
        $this->notes = session()->get('order_notes');
        $tmpordered = session()->get('items_in_order');
        //session()->put('items_in_order', null);
        if($tmpordered != null) {
            $this->item_ordered = $tmpordered;
        } else $this->item_ordered = array();
        $this->calc_date_possibili();
        
        
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
        $this->data_consegna = null;
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
        $plants_available = Plant::where('vendibile',1)->orderby('priority','asc')->orderby('nome','asc')->get();
       
        /*$plant_filtered = Arr::where( $this->item_ordered, function ($value, $key) {
            return $value['type'] == "vegetable";
        });
        $product_filtered = Arr::where( $this->item_ordered, function ($value, $key) {
            return $value['type'] == "product";
        });*/
        //$plants_available = $plants_available->diff(Plant::whereIn('id', $plant_filtered)->get());    
        $products_available = Product::where('vendibile',1)->orderby('priority','asc')->orderby('name','asc')->get();
        $this->ricalcola_tot();
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
            session()->put('order_name', $this->nome);
            session()->put('order_surname', $this->cognome);
            session()->put('order_email', $this->email);
            session()->put('order_tel', $this->tel);
            session()->put('order_indir', $this->indirizzo);
            session()->put('order_citta', $this->citta);
            session()->put('order_notes', $this->notes);
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
    public function ricalcola_tot() {
        $this->ordine_tot = 0;
        $this->ordine_non_completo = false;
        foreach ($this->item_ordered as $tmp_item_ordered) {
            if($tmp_item_ordered['quantity_um']==$tmp_item_ordered['price_um']) {
                $this->ordine_tot +=  $tmp_item_ordered['quantity']* $tmp_item_ordered['price'];
            } else {
                $this->ordine_non_completo = true;
            }
        }
        if( $this->ordine_non_completo) $this->ordine_tot = 0;
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
        $ordine->prezzo_tot = $this->ordine_tot;
        $ordine->notes = $this->notes;
        $ordine->sconto_perc = 0;
        $ordine->tipo_cliente = 'privato';
        $ordine->save();
        session()->put('items_in_order', $this->item_ordered);
        session()->put('order_name', $this->nome);
        session()->put('order_surname', $this->cognome);
        session()->put('order_email', $this->email);
        session()->put('order_tel', $this->tel);
        session()->put('order_indir', $this->indirizzo);
        session()->put('order_citta', $this->citta);
        session()->put('order_notes', $this->notes);
        
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
        $this->inviaMail($ordine);
        session()->flash('message', 'Grazie per il tuo ordine!');
    }

    public function inviaMail($ordine){
        $details  = [
            'ordine' => $ordine
        ];
        \Mail::to($ordine->email)->send(new \App\Mail\ConfermaOrdineMail($details));
    }
    public function calc_date_possibili() {
        $this->array_date_possibili = array();
        $settings = Setting::all()->pluck('value','name');
        for($i=$settings['order_close_from_day']; $i<=$settings['order_open_from_day']; $i++){
            $data_tmp = Carbon::now()->addDays($i);
            if($settings['order_day_1'] == "on"){
                if($data_tmp->dayOfWeek == 1){
                    array_push($this->array_date_possibili, array($data_tmp->toDateString(),$data_tmp->translatedFormat('l j F')));
                }
            }
            if($settings['order_day_2'] == "on"){
                if($data_tmp->dayOfWeek == 2){
                    array_push($this->array_date_possibili, array($data_tmp->toDateString(),$data_tmp->translatedFormat('l j F')));
                }
            }
            if($settings['order_day_3'] == "on"){
                if($data_tmp->dayOfWeek == 3){
                    array_push($this->array_date_possibili, array($data_tmp->toDateString(),$data_tmp->translatedFormat('l j F')));
                }
            }
            if($settings['order_day_4'] == "on"){
                if($data_tmp->dayOfWeek == 4){
                    array_push($this->array_date_possibili, array($data_tmp->toDateString(),$data_tmp->translatedFormat('l j F')));
                }
            }
            if($settings['order_day_5'] == "on"){
                if($data_tmp->dayOfWeek == 5){
                    array_push($this->array_date_possibili, array($data_tmp->toDateString(),$data_tmp->translatedFormat('l j F')));
                }
            }
            if($settings['order_day_6'] == "on"){
                if($data_tmp->dayOfWeek == 6){
                    array_push($this->array_date_possibili, array($data_tmp->toDateString(),$data_tmp->translatedFormat('l j F')));
                }
            }
            if($settings['order_day_7'] == "on"){
                if($data_tmp->dayOfWeek == 0){
                    array_push($this->array_date_possibili, array($data_tmp->toDateString(),$data_tmp->translatedFormat('l j F')));
                }
            }
        }
    }

}
