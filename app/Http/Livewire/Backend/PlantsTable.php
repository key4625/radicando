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
            Column::make('Nome','nome')
                ->sortable()
                ->searchable(),
            Column::make('Resa/kg','resa_pianta_kg')
                ->sortable(),
                
            Column::make('Prezzo/kg','prezzo_kg')
                ->sortable(),
            Column::make('In vendita', 'vendibile'),
           
        ];
    }

    public function query(): Builder
    {
        return Plant::query();
    }

    public function getTableRowUrl($row): string
    {
        return route('admin.piante.edit', $row);
    }
       
}
