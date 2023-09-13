# base de datos

* configurar la base de datos

En este caso voy a trabajar en **sqlite**

* en el archivo de configure de php (php.ini), descomente las siguientes lineas:

```
extension=sqlite3
extension=pdo_sqlite
```

Si yo voy a trabajar en mysql, deberia tener lo siguiente

```
extension=mysqli
extension=pdo_mysql
```

* Crear una base de datos en sqlite

En la carpeta database/ crear el archivo database.sqlite (en un archivo vacio)

* Editar el archivo .env  y cambiar las siguientes lineas

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=root
DB_PASSWORD=
```
por estas lineas

```
DB_CONNECTION=sqlite
```

Para probar la base de datos:

En un terminal ejecutar lo siguiente:

```
 php artisan migrate:install
```
Con ese comando se crean unas tablas internas en la base de datos. Estas tablas son utiles para la migracion.


# crear primera tabla (migrations)
* Cree una migracion con make:migration con el nombre que quiera

```
php artisan make:migration creartablaproductos
```

* En la carpeta database/migrations se creo el archivo. Edite el archivo

Dentro de la funcion up() agregar:
```php
        Schema::create('productos',function(Blueprint $table){
            $table->id();
            $table->string('nombre',50);
            $table->integer('precio');
            $table->string('categoria',50);
            $table->timestamps();
        });
```
# crear un modelo
En el terminal
```
php artisan make:model Producto
```

Y editar el producto (app/Models/Producto.php)

```php

class Producto extends Model
{
    use HasFactory;
    protected $primaryKey='id';
    protected $fillable=['nombre','precio','categoria'];
    protected $table="productos";
    
}
```

# crear un factory (sirve para crear un objeto, usualmente falso)
En la consola:
```
php artisan make:factory ProductoFactory
```
En la carpeta database/factories se crea el factory
Edite la clase y dentro de definitions() agregar

```php
return [
    'nombre'=>'cocacola',
    'precio'=>500,
    'categoria'=>'bebida'
];
```        

# crear un seed
El seeder sirve para llenar la base de datos.

Puedo crear un seed u ocupar el que ya esta creado
En la carpeta /database/seeders editar el DatabaseSeeder.php
Y dentro de run() agregar:

```php
Producto::factory(10)->create(); // aqui se estan creando 10 productos en la base de datos
```

# crear las tablas y poblar la base de datos
En el terminal:
```
 php artisan migrate:fresh
```

# correr el seed (llenar la base de datos)
En el terminal
```
php artisan db:seed
```

# crear un controlador

```
php artisan make:controller ProductoController
```
Y editar el contrador app/http/controllers/ProductoController.php

```php
    public function listar() {
        $productos=Producto::all(); // Eloquent
        return view("listar",['productos'=>$productos]);
    }
```

# crear la vista
En /resources/views crear un archivo extension .blade.php

```html
<table border=1>
@foreach($productos as $prod)
    <tr>
        <td>{{$prod->nombre}}</td>
        <td>{{$prod->precio}}</td>
        <td>{{$prod->categoria}}</td>
    </tr>
@endforeach
</table>    
```

# editar el enrutamiento
En /routes, editar el archivo web.php, agregando una ruta que llame a la funcion de la clase controladora.

```php
Route::get('/listar',[ProductoController::class,'listar']);
```


# ejecutar el proyecto
Ejecutar en la consola

```
php artisan serve
```
y abrir la ruta indicada en el enrutamiento, ej: http://127.0.0.1:8000/listar
