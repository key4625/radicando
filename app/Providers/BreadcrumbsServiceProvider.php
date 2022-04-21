<?php
namespace App\Providers;

use App\Models\Plant;
use Illuminate\Support\ServiceProvider;
use Tabuna\Breadcrumbs\Breadcrumbs;
use Tabuna\Breadcrumbs\Trail;

class BreadcrumbsServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Breadcrumbs::for('admin.piante.index', fn (Trail $trail) =>
             $trail->push('Elenco Piante', route('admin.piante.index'))
        );
        Breadcrumbs::for('admin.piante.edit', fn (Trail $trail, $id) =>
            $trail
            ->parent('admin.piante.index', route('admin.piante.index'))
            ->push('Modifica informazioni pianta', route('admin.piante.edit',$id))
        );
        Breadcrumbs::for('admin.animali.index', fn (Trail $trail) =>
             $trail->push('Elenco Animali', route('admin.animali.index'))
        );
        Breadcrumbs::for('admin.animali.edit', fn (Trail $trail, $id) =>
            $trail
            ->parent('admin.animali.index', route('admin.animali.index'))
            ->push('Modifica informazioni animale', route('admin.animali.edit',$id))
        );
        Breadcrumbs::for('admin.prodotti.index', fn (Trail $trail) =>
        $trail->push('Elenco Prodotti', route('admin.prodotti.index'))
        );
        Breadcrumbs::for('admin.prodotti.edit', fn (Trail $trail, $id) =>
            $trail
            ->parent('admin.prodotti.index', route('admin.prodotti.index'))
            ->push('Modifica informazioni prodotto', route('admin.prodotti.edit',$id))
        );
        Breadcrumbs::for('admin.prodotti.create', fn (Trail $trail) =>
            $trail
            ->parent('admin.prodotti.index', route('admin.prodotti.index'))
            ->push('Nuovo prodotto', route('admin.prodotti.create'))
        );

       
       
    }
}