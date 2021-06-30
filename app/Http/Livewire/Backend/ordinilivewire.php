<?php

namespace App\Http\Livewire\Backend;

use Livewire\Component;
use App\Models\Plant;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;


use function PHPUnit\Framework\isNull;

class ordinilivewire extends Component
{
 
    public function mount()
    {
      
    }
    public function resetInputFields(){

       
    }
    public function render()
    {
      
        return view('backend.livewire.order');
    }
}
