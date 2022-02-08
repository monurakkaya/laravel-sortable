<?php

namespace Monurakkaya\Sortable\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Schema\Blueprint;

class SortableServiceProvider extends ServiceProvider
{
    public function register()
    {
        Blueprint::macro('sortableColumn', function ($columnName = 'sort_order') {
            return $this->addColumn('bigInteger', $columnName)->unsigned();
        });

        Blueprint::macro('dropSortableColumn', function ($columnName = 'sort_order') {
            return $this->dropColumn($columnName);
        });
    }
}