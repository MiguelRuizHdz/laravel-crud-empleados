# Laravel CRUD Empleados
UI Con Bootstrap

Server: xampp

Agregar el proyecto en la carpeta htdocs

### Instalar dependencias
`composer install`

### Configurar .env
- Crear un archivo .env con la información de .env.example
- Configurar la información de la base de datos

### Generar tablas de bases de datos
`php artisan migrate`

### Enlazar storage para visualizar las imagenes cargadas
`php artisan storage:link`

### Instalar modulos de node
`npm install`

`npm run dev`

### Ver rutas de la aplicación
`php artisan route:list`

### Abrir proyecto en el navegador
<pre>localhost/$folder_name/public/</pre>

*Nota*: El registro de nuevos usuarios esta deshabilitado en la línea 34 del archivo web.php.

```
.
├── routes
│   └── web.php
```

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains over 1500 video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
