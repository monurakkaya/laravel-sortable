<?php

namespace Monurakkaya\Sortable\Tests;

final class SortableTest extends TestCase
{
    /** @test */
    public function it_sets_the_order_column_on_creation(): void
    {
        $foo = Foo::create([
            'name'              => 'Foo',
            'custom_sort_order' => rand(),
        ]);

        $this->assertIsInt($foo->sort_order);
    }

    /** @test */
    public function it_can_get_the_results_based_on_the_ascending_order_of_default_sort_column(): void
    {
        $results = Foo::all();

        $this->assertEquals(1, $results->first()->sort_order);
        $this->assertEquals(10, $results->last()->sort_order);
    }

    /** @test */
    public function it_can_get_the_results_based_on_the_descending_order_of_default_sort_column(): void
    {
        $model = new class () extends Foo {
            public function getSortableDirection(): string
            {
                return 'desc';
            }
        };

        $results = $model->newQuery()->get();

        $this->assertEquals(10, $results->first()->sort_order);
        $this->assertEquals(1, $results->last()->sort_order);
    }

    /** @test */
    public function it_can_get_the_results_based_on_the_ascending_order_of_custom_sort_column(): void
    {
        $model = new class () extends Foo {
            public function getSortableColumn(): string
            {
                return 'custom_sort_order';
            }
        };

        $results = $model->newQuery()->get();

        $this->assertEquals($results->min('custom_sort_order'), $results->first()->custom_sort_order);
        $this->assertEquals($results->max('custom_sort_order'), $results->last()->custom_sort_order);
    }

    /** @test */
    public function it_can_get_the_results_based_on_the_descending_order_of_custom_sort_column(): void
    {
        $model = new class () extends Foo {
            public function getSortableColumn(): string
            {
                return 'custom_sort_order';
            }

            public function getSortableDirection(): string
            {
                return 'desc';
            }
        };

        $results = $model->newQuery()->get();

        $this->assertEquals($results->max('custom_sort_order'), $results->first()->custom_sort_order);
        $this->assertEquals($results->min('custom_sort_order'), $results->last()->custom_sort_order);
    }
}
