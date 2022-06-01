<?php

namespace App\Http\Livewire\Backend;

use App\Models\Plant;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Filter;

/**
 * Class PlantsTable.
 */
class PlantsTable extends DataTableComponent
{

   
    public function columns(): array
    {
        return [
            Column::make('','image'),
            Column::make('Nome','nome')->sortable()->searchable(),
            Column::make('Tipo','plantcategory.name'),
            Column::make('Resa/kg','resa_pianta_kg')->sortable(),    
            Column::make('Prezzo/kg','prezzo_kg')->sortable(),
            Column::make('In vendita', 'vendibile'),
            Column::make('Vedi', ''),
           
        ];
    }

    public function query(): Builder
    {
        if($this->getFilter('solo_vendita')!=null){ 
            if($this->getFilter('solo_vendita')=="all"){
                $this->filters['solo_vendita'] = '';
                session()->put('plants_tipo_solo_vendita', '');
            } else session()->put('plants_tipo_solo_vendita', $this->getFilter('solo_vendita'));
            
        } else {
            $this->filters['solo_vendita'] = session()->get('plants_tipo_solo_vendita');
        } 
        //dd($this->getFilter('solo_vendita'));
        if($this->getFilter('tipologia')!=null){
            if($this->getFilter('tipologia')=="all"){
                $this->filters['tipologia'] = null;
                session()->put('plants_tipo_filter', null);
            } else session()->put('plants_tipo_filter', $this->getFilter('tipologia'));
        } else {
            $this->filters['tipologia'] = session()->get('plants_tipo_filter');
        }
        return Plant::query()
            ->join('plantcategories', 'plants.plantcategories_id', '=', 'plantcategories.id')
            ->select('plants.*','plantcategories.name as nome_cat')
            ->when( $this->getFilter('solo_vendita'), function ($query, $vendibile) { 
                return $query->where('vendibile', $vendibile);
            })
            ->when( $this->getFilter('tipologia'), function ($query, $cat_id) { 
                return $query->where('plantcategories_id', $cat_id);
            });
            //fn ($query, $vendit) => $query->where('vendibile', 0))
            //->when( $this->getFilter('solo_vendita')==1, fn ($query, $vendit) => $query->where('vendibile', 1))
            //->when( $this->getFilter('tipologia'), fn ($query, $cat_id) => $query->where('plantcategories_id', $cat_id));
    }

    public function resetFilters(): void
    {
        $search = $this->filters['search'] ?? null;
        session()->put('plants_tipo_solo_vendita', '');
        session()->put('plants_tipo_filter', null);
        $this->reset('filters');

        $this->filters['search'] = $search;
    }

    public function setVendibile($row,$invendita){
        
        $plant = Plant::find($row['id']);
       
        //$row['vendibile'] = $invendita;
        $plant->vendibile = $invendita;
        $plant->save();
        //dd($invendita);

    }
    public function editPianta($id){
        return route('admin.piante.edit', $id);
    }
    /*public function getTableRowUrl($row): string
    {
        return route('admin.piante.edit', $row);
    }*/

    public function rowView(): string
    {
        // Becomes /resources/views/location/to/my/row.blade.php
        return 'backend.plants.row';
    }

    public function filters(): array
    {
        return [
        
            'solo_vendita' => Filter::make('In vendita')
                ->select([
                    'all' => 'Tutti',
                    '1' => 'Si',
                    '0' => 'No',
                ]),
            'tipologia' => Filter::make('Categoria')
                ->select([
                    'all' => 'Tutti',
                    '1' => 'Orticole',
                    '2' => 'Frutta',
                    '3' => 'Seminativo',
                    '4' => 'Piante officinali',
                    '5' => 'Avvicendamenti',
                ]),
            
        ];
    } 
    /*public array $filters = [
        'solo_vendita' => session()->get('plants_tipo_solo_vendita'),
        'tipologia' => session()->get('plants_tipo_filter'),
    ];*/
}
