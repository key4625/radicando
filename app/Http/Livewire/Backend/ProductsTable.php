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
            Column::make('','image'),
            Column::make('Nome','products.name')->sortable()->searchable(),
            Column::make('Dimens.','dimension'),
            Column::make('Tipo','productcategories.name'),
            Column::make('Magazzino','quantity_mag')->sortable(),
            Column::make('Fragilità','fragile')->sortable(),
            Column::make('Prezzo','price')->sortable(),
            Column::make('In vendita', 'vendibile'),
            Column::make('Vedi', '')
           
        ];
    }

    public function query(): Builder
    {
        return Product::query()
            ->join('productcategories', 'products.productcategories_id', '=', 'productcategories.id')
            ->select('products.*','productcategories.name as nome_cat')    
            ->when($this->getFilter('filter_vendita'), fn ($query, $vendibile) => $query->where('vendibile', $vendibile === 1))
            ->when($this->getFilter('tipologia'), fn ($query, $cat_id) => $query->where('productcategories_id', $cat_id));
    }

    public function setVendibile($row,$invendita){
        
        $product = Product::find($row['id']);
       
        //$row['vendibile'] = $invendita;
        $product->vendibile = $invendita;
        $product->save();
        //dd($invendita);

    }
  
    /*public function getTableRowUrl($row): string
    {
        return route('admin.prodotti.edit', $row);
    }*/
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

                'tipologia' => Filter::make('Categoria')
                ->select([
                    '0' => 'Tutti',
                    '1' => 'Farine',
                    '2' => 'Vini e distillati',
                    '3' => 'Marmellate, salse e confetture',
                    '4' => 'Formaggi',
                    '5' => 'Olio',
                    '6' => 'Carne',
                    '7' => 'Uova',
                    '8' => 'Cosmetica e detergenti',
                    '10' => 'Forno',
                    '9' => 'Altro',
                ]),
            
        ];
    }
       
}
