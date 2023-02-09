## mySql Schema builder
Lightweight Laravel like schema builder for mySql with support indexes.

### Installation
download the zip file and extract it in your plugin folder

### Usage
create a new file in your project and add the following code


```php
use Hasanmisbah\SchemaBuilder\Schema;

class CreateDemoTable {

    public static function up(){
    
        Schema::create('demo', function(\Hasanmisbah\SchemaBuilder\Blueprint $table){
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->timestamps();
        });
    }
}

// run the migration in your plugin activation hook
CreateDemoTable::up();

// that's it
```

### License
The MIT License (MIT).

### Author
Hasan Misbah (@hasanmisbah)
