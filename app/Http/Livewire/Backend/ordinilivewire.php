<?php

namespace App\Http\Livewire\Backend;

use Livewire\Component;
use App\Models\Plant;
use App\Models\Order;
use App\Models\Product;
use Arr;
use Carbon\Carbon;
use DB;
use Illuminate\Support\Facades\Auth;
use Livewire\WithPagination;

use function PHPUnit\Framework\isNull;

class ordinilivewire extends Component
{
    public $sel_order;
    public $showMode;
    public $confirming;
    public $quantity, $quantity_um, $price, $price_um;
    public $ordine, $nome, $cognome, $indirizzo, $consegna_domicilio,$citta, $email, $tel, $notes, $data, $ora, $prezzo_tot, $prezzo_tot_consigliato, $prezzo_tot_consigliato_scontato, $tipo_cliente, $sconto_perc, $evaso, $pagato;
    public $item_ordered;
    public $showProd;
    public $showQuant, $idQuant, $typeQuant;
    public $filter_consegnato, $filter_pagato, $filter_data, $filter_data_al;
    public $showPrintDiv = false;
    public $sortedby, $sortdir ;
    public $totaleDifferente;
    public $sel_stampa;
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    protected $rules = [
        'nome' => 'required',  
        'cognome' => 'required'      
    ];

    protected $listeners = ['prezzo_da_ricalcolare' => 'ricalcolaPrezzo'];

    public function mount()
    {
        $this->showMode = 0;
        $this->showProd = 0;
        $this->consegna_domicilio = 1;
        $this->filter_consegnato = "da_consegnare";
        $this->filter_pagato = "tutti";
        $this->filter_data = null;
        $this->filter_data_al = null;
        $this->item_ordered = array();
        $this->sel_stampa = 0;
    }
    public function resetInputFields(){
        $this->item_ordered = array(); 
        $this->showMode = 0;
        $this->nome = null;
        $this->notes = null;
        $this->cognome = null;
        $this->email = null;
        $this->tel = null;
        $this->indirizzo = null;
        $this->citta = null;
        $this->item_ordered = array();   
        $this->showProd = 0;
        $this->prezzo_tot = null;
        $this->prezzo_tot_consigliato = null;
        $this->tipo_cliente = "normale";
    }
    public function resetQuantity(){
        $this->showQuant = 0;
        $this->idQuant = 0;
        $this->typeQuant = null;
    }
    public function render()
    { 
        if( $this->showMode ==1 ) $this->ricalcolaPrezzo();

        if($this->prezzo_tot != $this->prezzo_tot_consigliato_scontato) {
            $this->totaleDifferente = 1; 
        } else  $this->totaleDifferente = 0; 

        $plants_available = Plant::where('vendibile',1)->get();
        /*$plant_filtered = Arr::where( $this->item_ordered, function ($value, $key) {
            return $value['type'] == "vegetable";
        });
        $product_filtered = Arr::where( $this->item_ordered, function ($value, $key) {
            return $value['type'] == "product";
        });*/
        //$plants_available = $plants_available->diff(Plant::whereIn('id', $plant_filtered->pluck('id_num'))->get());    
        $products_available = Product::where('vendibile',1)->get();
        //$products_available = $products_available->diff(Product::whereIn('id', $product_filtered->pluck('id_num'))->get());    
        $orders_list = Order::query();
        if($this->filter_consegnato=="da_consegnare") $orders_list->where("evaso",0);
        if($this->filter_consegnato=="consegnati") $orders_list->where("evaso",1);
        if($this->filter_pagato=="da_pagare") $orders_list->where("pagato",0);
        if($this->filter_pagato=="pagati") $orders_list->where("pagato",1);
        if($this->filter_data!=null) $orders_list->whereDate("data",">=",$this->filter_data);
        if($this->filter_data_al!=null) $orders_list->whereDate("data","<",$this->filter_data_al);
        $orders_list = $orders_list->orderby('data');
        if($this->sortedby !=null) $orders_list = $orders_list->orderby($this->sortedby,$this->sortdir); 
        $orders_list_raw = $orders_list;
        return view('backend.livewire.order', [
            'orders' => $orders_list->paginate(25),'ordersprintable' => $orders_list_raw->get() ,'plants_available' => $plants_available, 'products_available' => $products_available
        ]);
    }
    public function viewProd($val){
        $this->showProd = $val;
    }

    public function sortBy($term){
        $this->sortedby = $term;
        if($this->sortdir == null) { 
            $this->sortdir = "asc";
        } elseif($this->sortdir == "asc") { 
            $this->sortdir = "desc";
        } else {
            $this->sortedby = null;
            $this->sortdir = null;
        }
    }
    public function setEvaso(int $id, int $num, $isInternal){
        $order = Order::where('id',$id)->first();
        $order->evaso = $num;
        if($isInternal) $this->sel_order->evaso = $num;
        $order->save();
    }
    public function setPagato(int $id, int $num, $isInternal){
        $order = Order::where('id',$id)->first();
        $order->pagato = $num;
        if($isInternal)  $this->sel_order->pagato = $num;
        $order->save();
    }
    public function toggleInsert(){
        $this->sel_order = Order::create(['nome'=>'Ordine']);
        $this->nome = "Ordine";
        $this->cognome = "";
        $this->showMode = 1;    
        $this->data = Carbon::now()->toDateString(); 
        $this->ora = Carbon::now()->toTimeString(); 
    }
    public function toggleShow(int $id){
        $this->sel_order = Order::where('id',$id)->first();
        $this->nome = $this->sel_order->nome;
        $this->cognome = $this->sel_order->cognome;
        $this->email = $this->sel_order->email;
        $this->indirizzo = $this->sel_order->indirizzo;
        $this->citta = $this->sel_order->citta;
        $this->tel = $this->sel_order->tel;
        $this->notes = $this->sel_order->notes;
        $this->prezzo_tot =$this->sel_order->prezzo_tot;
        if($this->sel_order->data!=null){
            $this->data = $this->sel_order->data;
        } else $this->data =Carbon::now()->toDateString(); 
        if($this->sel_order->ora!=null){
            $this->ora = $this->sel_order->ora;
        } else $this->ora = Carbon::now()->toTimeString(); 
        
        $this->item_ordered = array();
        foreach($this->sel_order->plants()->withPivot('quantity','quantity_um','price','price_um')->get() as $tmp_item_order){ 
            $new_item = array('id_num'=>count($this->item_ordered),'item_id'=>$tmp_item_order->id,'type'=>'vegetable','quantity'=> $tmp_item_order->pivot->quantity, 'quantity_um'=> $tmp_item_order->pivot->quantity_um, 'price_um'=> $tmp_item_order->pivot->price_um,'price'=>$tmp_item_order->pivot->price);
            array_push($this->item_ordered, $new_item);     
        }
        foreach($this->sel_order->products()->withPivot('quantity','quantity_um','price','price_um')->get() as $tmp_item_order){ 
            $new_item = array('id_num'=>count($this->item_ordered),'item_id'=>$tmp_item_order->id,'type'=>'product','quantity'=> $tmp_item_order->pivot->quantity, 'quantity_um'=> $tmp_item_order->pivot->quantity_um, 'price_um'=> $tmp_item_order->pivot->price_um,'price'=>$tmp_item_order->pivot->price);
            array_push($this->item_ordered, $new_item);    
        }
        $this->ricalcolaPrezzo();
        $this->showMode = 1;       
    }

    public function selProd($item_id,$type,$price_um)
    {
        $this->showQuant = 1;
        $this->idQuant = $item_id;
        $this->typeQuant = $type;
        $this->quantity = 0;
        $this->quantity_um = $price_um;
        
       
    }
    public function add($item_id,$type,$price, $price_um)
    {
        if($this->quantity != 0){
            $new_item = array('id_num'=>count($this->item_ordered),'item_id'=>$item_id,'type'=>$type,'quantity'=> $this->quantity, 'quantity_um'=> $this->quantity_um, 'price_um'=> $price_um,'price'=>$price);
            array_push($this->item_ordered, $new_item);
            $this->showProd = 0;
            $this->resetQuantity();
            $this->ricalcolaPrezzo(); 
        }
    }
    public function remove($key)
    {
        //$key = array_search( $id, array_column($this->item_ordered, 'id_num')); 
        unset( $this->item_ordered[$key]);
        session()->put('items_in_order', $this->item_ordered);
    }

    public function ricalcolaPrezzo(){
        if($this->sel_order != null){
            $this->prezzo_tot_consigliato  = 0;     
            foreach($this->item_ordered as $single_item_order){  
               //qui faccio somma in base all'unità di misura
                $this->prezzo_tot_consigliato  += $single_item_order['price']*floatval($single_item_order['quantity']);     
            }   
            $this->sconto_perc = 0;
            if($this->tipo_cliente == "privato") $this->sconto_perc = 0;       
            if($this->tipo_cliente == "gas") $this->sconto_perc = 10;        
            if($this->tipo_cliente == "rivenditore") $this->sconto_perc = 25;        
            if($this->tipo_cliente == "dipendente") $this->sconto_perc = 25;      
            $this->prezzo_tot_consigliato_scontato =  $this->prezzo_tot_consigliato - ($this->prezzo_tot_consigliato*$this->sconto_perc/100);      
        }
       
        //$this->prezzo_tot_consigliato->refresh();
        
    }
  
    public function ordina($azione,$aggiorno_tot)
    {       
        $this->dispatchBrowserEvent('swal', ['title' => 'hello from Livewire']);
        $this->validate();
        $this->sel_order->nome = $this->nome;
        $this->sel_order->cognome = $this->cognome;
        $this->sel_order->email = $this->email;
        $this->sel_order->indirizzo = $this->indirizzo;
        $this->sel_order->citta = $this->citta;
        $this->sel_order->tel = $this->tel;
        if(($this->prezzo_tot == null)||($this->prezzo_tot == 0)) $this->prezzo_tot = $this->prezzo_tot_consigliato_scontato;
        if($aggiorno_tot == 1) {
            $this->prezzo_tot = $this->prezzo_tot_consigliato_scontato;
            $this->sel_order->prezzo_tot = $this->prezzo_tot_consigliato_scontato;
        } else $this->sel_order->prezzo_tot = $this->prezzo_tot;
        $this->sel_order->tipo_cliente = $this->tipo_cliente;
        $this->sel_order->sconto_perc = $this->sconto_perc;
        $this->sel_order->data = $this->data;
        $this->sel_order->ora = $this->ora;
        $this->sel_order->notes = $this->notes;
        $this->sel_order->consegna_domicilio = $this->consegna_domicilio;
        $this->sel_order->save();
        $this->sel_order->plants()->detach();
        $this->sel_order->products()->detach(); 
        foreach ($this->item_ordered as $tmp_item_ordered) {
            if($tmp_item_ordered['type']=="vegetable"){
                $this->sel_order->plants()->attach($tmp_item_ordered['item_id'], ['quantity' => $tmp_item_ordered['quantity'], 'quantity_um' => $tmp_item_ordered['quantity_um'],'price_um' => $tmp_item_ordered['price_um'], 'price' => $tmp_item_ordered['price']]);
            } else  {
                $this->sel_order->products()->attach($tmp_item_ordered['item_id'], ['quantity' => $tmp_item_ordered['quantity'], 'quantity_um' => $tmp_item_ordered['quantity_um'], 'price_um' => $tmp_item_ordered['price_um'], 'price' => $tmp_item_ordered['price']]);         
            }         
        }  

        if($azione == 1)  {
            $this->resetInputFields();
            $this->showMode = 0;      
        }
        if($azione == 2)  {
            $this->resetInputFields();
            $this->sel_order = Order::create(['nome'=>'Ordine']);
            $this->nome = "Ordine";
           
            $this->showMode = 1;      
        }
       
        session()->flash('message', 'Ordine salvato');
    }

    public function confirmDelete($id)
    {
        $this->confirming = $id;
    }
    public function delete($id)
    {
        Order::where('id',$id)->first()->plants()->detach();
        Order::destroy($id);
    }
}
