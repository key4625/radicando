<?php

namespace App\Http\Livewire;

use App\Models\Order;
use App\Models\Plant;
use Asantibanez\LivewireCharts\Models\AreaChartModel;
use Asantibanez\LivewireCharts\Models\ColumnChartModel;
use Asantibanez\LivewireCharts\Models\LineChartModel;
use Asantibanez\LivewireCharts\Models\PieChartModel;
use Livewire\Component;

class Statistica1 extends Component
{
    public $types = ['1', '2'];
    public $colors = [
        '1' => '#f6ad55',
        '2' => '#fc8181'
    ];
    public $firstRun = true;
    public $numCol = 0;
    protected $listeners = [
        'onPointClick' => 'handleOnPointClick',
        'onSliceClick' => 'handleOnSliceClick',
        'onColumnClick' => 'handleOnColumnClick',
    ];
    public function handleOnPointClick($point)
    {
        dd($point);
    }
    public function handleOnSliceClick($slice)
    {
        dd($slice);
    }
    public function handleOnColumnClick($column)
    {
        dd($column);
    }
    public function render()
    {
        $plants = Plant::whereIn('plantcategories_id', $this->types)->get();
        //->whereIn('plantcategories_id', $this->types)->get();
        $columnChartModel = $plants
            ->reduce(function (ColumnChartModel $columnChartModel, $data) {
                $title = $data->nome;
                $tmp_totprice = 0;
                $tmp_totqnt = 0;
                $tmp_totqnt_und = 0;
                if($data->orders()->count() > 0){
                    foreach($data->orders()->get() as $sng_order){
                      
                        if($sng_order->pivot->price_um == $sng_order->pivot->quantity_um){
                            $tmp_totprice += ($sng_order->pivot->price * $sng_order->pivot->quantity);
                            $tmp_totqnt += $sng_order->pivot->quantity;
                        } else {
                            $tmp_totqnt_und += $sng_order->pivot->quantity;
                        }
                       
                    }
                }              
                if($tmp_totprice > 0){
                    $columnChartModel->addSeriesColumn("Totale €", $title,  round($tmp_totprice,2), $data->color);
                    $columnChartModel->addSeriesColumn("Quantità", $title,   round($tmp_totqnt,2), $data->color);
                    $columnChartModel->addSeriesColumn("Quantità non prezzata", $title,   round($tmp_totqnt_und,2), $data->color);  
                    $this->numCol++;
                    return $columnChartModel;
                } else return $columnChartModel;
            }, (new ColumnChartModel())
                ->setTitle('Venduti in totale')
                ->multiColumn()
                ->setHorizontal(true)
                ->setAnimated($this->firstRun)
                ->withOnColumnClickEventName('onColumnClick')
            );
        
        $this->firstRun = false;
        return view('livewire.statistica1')
            ->with([
                'columnChartModel' => $columnChartModel
            ]);
    }


}
