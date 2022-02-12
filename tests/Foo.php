<?php

namespace Monurakkaya\Sortable\Tests;

use Illuminate\Database\Eloquent\Model;
use Monurakkaya\Sortable\Traits\Sortable;

class Foo extends Model
{
    use Sortable;

    protected $table = 'foos';

    protected $guarded = [];

    public $timestamps = false;
}
