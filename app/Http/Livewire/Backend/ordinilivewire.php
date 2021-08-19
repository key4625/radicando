<?php

namespace App\Http\Livewire\Backend;

use Livewire\Component;
use App\Models\Plant;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Livewire\WithPagination;

use function PHPUnit\Framework\isNull;

class ordinilivewire extends Component
{
    public $sel_order;
    public $showMode;
    public $confirming;
    public $quantity_kg, $quantity_num, $prezzo_kg, $plant_sel_id;
    public $ordine, $nome, $email, $tel, $prezzo_tot, $prezzo_tot_consigliato, $prezzo_tot_consigliato_scontato, $tipo_cliente, $sconto_perc, $evaso, $pagato;
    public $plant_ordered;
    use WithPagination;

    protected $rules = [
        'nome' => 'required'   
    ];

    protected $listeners = ['prezzo_da_ricalcolare' => 'ricalcolaPrezzo'];

    public function mount()
    {
        $this->showMode = 0;
    }
    public function resetInputFields(){

        $this->showMode = 0;
        $this->nome = null;
        $this->email = null;
        $this->tel = null;
        $this->plant_ordered = array();   
        $this->quantity_kg = null;
        $this->quantity_num = null;
        $this->prezzo_kg = null;
        $this->prezzo_tot = null;
        $this->prezzo_tot_consigliato = null;
        $this->tipo_cliente = "normale";
    }
    public function render()
    { 
        if( $this->showMode ==1 ) $this->ricalcolaPrezzo();
        return view('backend.livewire.order', [
            'orders' => Order::orderby('created_at')->paginate(25),
        ]);
    }

    public function setEvaso(int $id){
        $order = Order::where('id',$id)->first();
        $order->evaso = 1;
        $order->save();
    }
    public function setPagato(int $id){
        $order = Order::where('id',$id)->first();
        $order->pagato = 1;
        $order->save();
    }
    public function toggleInsert(){
        $this->sel_order = Order::create(['nome'=>'Ordine']);
        $this->nome = "Ordine";
        $this->showMode = 1;        
    }
    public function toggleShow(int $id){
        $this->sel_order = Order::where('id',$id)->first();
        $this->nome = $this->sel_order->nome;
        $this->email = $this->sel_order->email;
        $this->tel = $this->sel_order->tel;
        $this->prezzo_tot =$this->sel_order->prezzo_tot;
        foreach($this->sel_order->plants()->withPivot('quantity_kg','quantity_num','price_kg')->get() as $plant_order){ 
            $this->quantity_num[$plant_order->id] = $plant_order->pivot->quantity_num;
            $this->quantity_kg[$plant_order->id] = $plant_order->pivot->quantity_kg;
            $this->prezzo_kg[$plant_order->id] = $plant_order->pivot->price_kg;          
        }
        $this->ricalcolaPrezzo();
        $this->showMode = 1;       
    }
    
    public function add($plant_id)
    {
        $plant_sel = Plant::where('id',$plant_id)->first();
        if($plant_sel->prezzo_kg == null) $plant_sel->prezzo_kg = 0;
        $this->sel_order->plants()->attach($plant_id,['quantity_kg' => 0, 'quantity_num' => 0, 'price_kg'=> $plant_sel->prezzo_kg ]);
        $this->sel_order->refresh();
        $this->quantity_num[$plant_id] = 0;
        $this->quantity_kg[$plant_id] = 0;  
        $this->ricalcolaPrezzo(); 
    }
    public function remove($plant_id)
    {
        $this->sel_order->plants()->detach($plant_id);
        $this->sel_order->refresh();
        $this->quantity_num[$plant_id] = 0;
        $this->quantity_kg[$plant_id] = 0;
        $this->ricalcolaPrezzo();
    }

    public function ricalcolaPrezzo(){
        if($this->sel_order != null){
            $this->prezzo_tot_consigliato  = 0;     
            foreach($this->sel_order->plants()->withPivot('quantity_kg','quantity_num','price_kg')->get() as $plant_order){  
                if(($plant_order->pivot->price_kg!=null)&&($plant_order->pivot->price_kg!=0)) {
                    $this->prezzo_tot_consigliato  += $plant_order->pivot->price_kg*$this->quantity_kg[$plant_order->id];     
                } else $this->prezzo_tot_consigliato  += $plant_order->prezzo_kg*$this->quantity_kg[$plant_order->id];     
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
    public function ordina($azione)
    {       
        $this->validate();
        $this->sel_order->nome = $this->nome;
        $this->sel_order->email = $this->email;
        $this->sel_order->tel = $this->tel;
        if(($this->prezzo_tot == null)||($this->prezzo_tot == 0)) $this->prezzo_tot = $this->prezzo_tot_consigliato_scontato;
        $this->sel_order->prezzo_tot = $this->prezzo_tot;
        $this->sel_order->tipo_cliente = $this->tipo_cliente;
        $this->sel_order->sconto_perc = $this->sconto_perc;
        $this->sel_order->save();
        $this->sel_order->plants()->detach();
        foreach ($this->quantity_kg as $key => $value) {
            if(($this->quantity_kg[$key]!=0)||($this->quantity_num[$key]!=0)){
                $price_kg = Plant::where('id',$key)->first()->prezzo_kg;
                if($price_kg == null) $price_kg = 0;
                $this->sel_order->plants()->attach($key, ['quantity_kg' => $this->quantity_kg[$key], 'quantity_num' => $this->quantity_num[$key], 'price_kg' => $price_kg]);
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
