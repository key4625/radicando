<?php

namespace App\Http\Livewire\Backend;

use App\Models\Animal;
use App\Models\Collection;
use Livewire\Component;
use App\Models\Plant;
use App\Models\Order;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;


use function PHPUnit\Framework\isNull;

class collectionlivewire extends Component
{
    public $collectionable_id;
    public $collectionable_type;
    public $quantity_kg, $quantity_num, $name, $image,$part;

    public function mount()
    {
        $this->collectionable_id = 0;
    }
    public function resetInputFields(){
        $this->collectionable_id = 0;   
        $this->collectionable_type = null;   
    }
    public function render()
    {
        $plants_available = Plant::where('vendibile',1)->get();
        $animals_available = Animal::where('vendibile',1)->get();
        
        //$plants_available = $plants_available->diff(Plant::whereIn('id', $this->collectionable_id)->get());    
        return view('backend.livewire.collection',['plants_available' => $plants_available,'animals_available' => $animals_available]);
    }

    public function add($collectionable_id,$type)
    {
        $this->collectionable_id = $collectionable_id;
        $this->collectionable_type = $type;
        if($type == 1){
            $coll_tmp = Plant::where('id',$collectionable_id)->first();
            $this->collectionable_type = "App\Models\Plant";
        } else {
            $coll_tmp = Animal::where('id',$collectionable_id)->first();
            $this->collectionable_type = "App\Models\Animal";
        }

        $this->image= $coll_tmp->image;
        $this->name= $coll_tmp->nome;
        $this->quantity_num = 0;
        $this->quantity_kg = 0;
    }

    public function raccogli()
    {      
        $collection = new Collection();
        $collection->collectionable_id = $this->collectionable_id;
        $collection->collectionable_type = $this->collectionable_type;
        $collection->quantity_num = $this->quantity_num;
        $collection->quantity_kg = $this->quantity_kg;
        $collection->part = "";
        $collection->save();
        $this->resetInputFields();
        session()->flash('message', 'Raccolto inserito!');
    }


}
