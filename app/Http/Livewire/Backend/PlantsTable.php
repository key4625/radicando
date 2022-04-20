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
           
        ];
    }

    public function query(): Builder
    {
        return Plant::query()
            ->join('plantcategories', 'plants.plantcategories_id', '=', 'plantcategories.id')
            ->select('plants.*','plantcategories.name as nome_cat')
            ->when($this->getFilter('solo_vendita'), fn ($query, $vendibile) => $query->where('vendibile', $vendibile === 1))
            ->when($this->getFilter('tipologia'), fn ($query, $cat_id) => $query->where('plantcategories_id', $cat_id));
    }


  
    public function getTableRowUrl($row): string
    {
        return route('admin.piante.edit', $row);
    }

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
                    '' => 'Tutti',
                    '1' => 'Si',
                    '0' => 'No',
                ]),
            'tipologia' => Filter::make('Categoria')
                ->select([
                    '0' => 'Tutti',
                    '1' => 'Orticole',
                    '2' => 'Frutta',
                    '3' => 'Seminativo',
                    '4' => 'Piante officinali',
                    '5' => 'Avvicendamenti',
                ]),
            
        ];
    }
       
}
