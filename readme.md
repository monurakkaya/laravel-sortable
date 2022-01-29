# Laravel sortable
Enables simple sort for your Eloquent models


## INSTALLATION
```
composer require monurakkaya/laravel-sortable
```

## USAGE
### The schema

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

### The model

Your model should implements Monurakkaya\Sortable\ShouldSortable trait to enable auto sort;
```
use Monurakkaya\Sortable\ShouldSortable;

class Foo extends Model implements ShouldSortable {
    
}
```
and that's all.

```
$fooOne = Foo::create(['title' => 'Foo1', 'sort_order' => 1]);
$fooTwo = Foo::create(['title' => 'Foo2', 'sort_order' => 4]);
$fooThree = Foo::create(['title' => 'Foo3', 'sort_order' => 3]);

$records = Foo::get();
-Foo1
-Foo3
-Foo4
```

#### SETTINGS

