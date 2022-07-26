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
                  
                    //$tot_euro = $data->orders()->sum('price');
                    //$tot_qnt = $data->orders()->sum('quantity');
                }
               
                if($tmp_totprice > 0){
                    //dd($data->orders());
                    //return $columnChartModel->addColumn($title, $value, $data->color);
                    $columnChartModel->addSeriesColumn("Totale €", $title,  $tmp_totprice, $data->color);
                    $columnChartModel->addSeriesColumn("Quantità", $title,  $tmp_totqnt, $data->color);
                    $columnChartModel->addSeriesColumn("Quantità non prezzata", $title,  $tmp_totqnt_und, $data->color);
                   
                    return $columnChartModel;
                } else return $columnChartModel;
            }, (new ColumnChartModel())
                ->setTitle('Venduti in totale')
                ->multiColumn()
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
