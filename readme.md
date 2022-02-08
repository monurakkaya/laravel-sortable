# Laravel sortable
Enables simple sort for your Eloquent models


## INSTALLATION
```
composer require monurakkaya/laravel-sortable
```

## EXAMPLE

```
$fooOne = Foo::create(['title' => 'Foo1', 'sort_order' => 1]);
$fooTwo = Foo::create(['title' => 'Foo2', 'sort_order' => 4]);
$fooThree = Foo::create(['title' => 'Foo3', 'sort_order' => 3]);

$records = Foo::get();
-Foo1
-Foo3
-Foo4
```

## USAGE

### The model

Your model should use Monurakkaya\Traits\Sortable trait to enable auto sort;
```
use Monurakkaya\Sortable\Traits;

class Foo extends Model {
    use Sortable;
}
```
and that's all.

#### SETTINGS

To change the column name to be sorted just override the `getSortableColumn` method on your model
```

class Foo extends Model {
    use Sortable;
    
    protected static function getSortableColumn()
    {
        return 'created_at';
    }
}

```

Default is `sort_order`


To change the sorting direction just override the `getSortableDirection` method on your model
```

class Foo extends Model {
    use Sortable;
    
    protected static function getSortableDirection()
    {
        return 'desc';
    }
}

```

Default is `asc`


### The schema
** You do not have to add new column, you can use existing columns like `created_at, id` etc to make your model able to auto-sort results. 
#### To create the column

```
// This will generate an unsigned big integer column named `sort_order` 
// which equivalent to $table->unsignedBigInteger('sort_order');
Schema::create('table', function (Blueprint $table) {
    ...
    $table->sortableColumn();
});
```

#### To drop the column
```
Schema::table('table', function (Blueprint $table) {
    $table->dropSortableColumn();
});
```

#### To use your own column just pass the column name to override the default name
```
// on create
$table->sortableColumn('my_column_name');

// on drop
$table->dropSortableColumn('my_column_name');
```

Using schema helper is optional. You can go on with your own definitions.

