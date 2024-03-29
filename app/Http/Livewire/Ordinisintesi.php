<?php

namespace App\Http\Livewire;

use App\Models\Order;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;

class Ordinisintesi extends Component
{
    public $filter_consegnato, $filter_pagato, $filter_data, $filter_data2, $datafilter;
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public function mount()
    {
        $this->filter_consegnato="tutti";
        $this->filter_data=Carbon::now()->toDateString();
        $this->filter_data2=null;
    }
    public function render()
    {
        $orders_list = Order::query();
        if($this->filter_consegnato=="da_consegnare") $orders_list->where("evaso",0);
        if($this->filter_data != null){
            $orders_list->whereDate("data",">=",$this->filter_data);
            if($this->filter_data2 != null){
                $orders_list->whereDate("data","<=",$this->filter_data2);
            }
        } else $orders_list->whereDate("data",">=",Carbon::now()->toDateString());
        
           
        /*if($this->filter_data=="oggi") $orders_list->whereDate("data",Carbon::now()->toDateString());
        if($this->filter_data=="domani") $orders_list->whereDate("data",Carbon::tomorrow()->toDateString());
        if($this->filter_data=="settimana") {
            $orders_list->whereDate("data",">=",Carbon::now()->toDateString());
            $orders_list->whereDate("data","<",Carbon::now()->adddays(7)->toDateString());
        }*/
       
        $orders_list = $orders_list->orderby('data');
        $orders_list = $orders_list->orderby('citta');
        
        $prova = $orders_list->paginate(25);
        return view('livewire.ordinisintesi',['orders' => $prova]);
    }
}
