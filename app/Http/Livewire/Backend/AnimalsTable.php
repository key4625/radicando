<?php

namespace App\Http\Livewire\Backend;

use App\Models\Animal;
use App\Models\Plant;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Filter;

/**
 * Class PlantsTable.
 */
class AnimalsTable extends DataTableComponent
{

    public function columns(): array
    {
        return [
            Column::make('','image')
           ,
            Column::make('Nome','nome')
                ->sortable()
                ->searchable(),
          
            Column::make('In vendita', 'vendibile'),
           
        ];
    }

    public function query(): Builder
    {
        return Animal::query()->when($this->getFilter('filter_vendita'), fn ($query, $vendibile) => $query->where('vendibile', $vendibile === 1));
    }


  
    public function getTableRowUrl($row): string
    {
        return route('admin.animali.edit', $row);
    }
    public function rowView(): string
    {
        // Becomes /resources/views/location/to/my/row.blade.php
        return 'backend.animals.row';
    }

    public function filters(): array
    {
        return [
        
            'filter_vendita' => Filter::make('In vendita')
                ->select([
                    '' => 'Tutti',
                    '1' => 'Si',
                    '0' => 'No',
                ]),
            
        ];
    }
       
}
