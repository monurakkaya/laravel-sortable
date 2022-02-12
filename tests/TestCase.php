<?php

namespace Monurakkaya\Sortable\Tests;

use Illuminate\Database\Schema\Blueprint;

class TestCase extends \Orchestra\Testbench\TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->setUpDatabase();
    }

    protected function setUpDatabase(): void
    {
        $this->app['db']->connection()->getSchemaBuilder()->create('foos', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger((new Foo())->getSortableColumn());
            $table->unsignedBigInteger('custom_sort_order');
        });

        collect([3, 8, 4, 1, 5, 2, 6, 10, 7, 9])->each(function ($i) {
            Foo::create([
                'name'              => "Foo $i",
                'sort_order'        => $i,
                'custom_sort_order' => rand(),
            ]);
        });
    }
}
