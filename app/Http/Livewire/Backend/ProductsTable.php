<?php

namespace App\Http\Livewire\Backend;

use App\Models\Product;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Filter;

/**
 * Class PlantsTable.
 */
class ProductsTable extends DataTableComponent
{

    public function columns(): array
    {
        return [
            Column::make('','image')
           ,
            Column::make('Nome','name')
                ->sortable()
                ->searchable(),
            Column::make('Magazzino','quantity_mag')
                ->sortable(),
            Column::make('Dimens.','dimension'),
            Column::make('Prezzo','price')
                ->sortable(),
            Column::make('In vendita', 'vendibile'),
           
        ];
    }

    public function query(): Builder
    {
        return Product::query()->when($this->getFilter('filter_vendita'), fn ($query, $vendibile) => $query->where('vendibile', $vendibile === 1));
    }


  
    public function getTableRowUrl($row): string
    {
        return route('admin.prodotti.edit', $row);
    }
    public function rowView(): string
    {
        // Becomes /resources/views/location/to/my/row.blade.php
        return 'backend.products.row';
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
