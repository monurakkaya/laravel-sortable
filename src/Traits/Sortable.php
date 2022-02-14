<?php

namespace Monurakkaya\Sortable\Traits;

use Monurakkaya\Sortable\Scopes\OrderBySortableColumn;

trait Sortable
{
    protected static function bootSortable()
    {
        static::addGlobalScope(new OrderBySortableColumn());
        static::creating(function ($model) {
            if (empty($model->{$model->getSortableColumn()})) {
                $model->{$model->getSortableColumn()} = 0;
            }
        });
    }

    public function getSortableColumn(): string
    {
        return 'sort_order';
    }

    public function getSortableDirection(): string
    {
        return 'asc';
    }
}
