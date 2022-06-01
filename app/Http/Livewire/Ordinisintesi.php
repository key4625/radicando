<?php

namespace App\Http\Livewire;

use App\Models\Order;
use Carbon\Carbon;
use Livewire\Component;

class Ordinisintesi extends Component
{
    public $filter_consegnato, $filter_pagato, $filter_data, $datafilter;

    public function mount()
    {
        $this->filter_consegnato="tutti";
        $this->filter_data="oggi";
    }
    public function render()
    {
        $orders_list = Order::query();
        if($this->filter_consegnato=="da_consegnare") $orders_list->where("evaso",0);
        if($this->filter_data=="oggi") $orders_list->whereDate("data",Carbon::now()->toDateString());
        if($this->filter_data=="domani") $orders_list->whereDate("data",Carbon::tomorrow()->toDateString());
        if($this->filter_data=="settimana") {
            $orders_list->whereDate("data",">",Carbon::now()->toDateString());
            $orders_list->whereDate("data","<",Carbon::now()->adddays(7)->toDateString());
        }
        $orders_list->orderby('created_at')->paginate(25);
        return view('livewire.ordinisintesi',['orders' => $orders_list]);
    }
}
