# Laravel 10 Summernote Text Editor with Image Upload CRUD

Este repositorio contiene un proyecto de Laravel 10 que implementa un CRUD (create, read, update, delete) utilizando el editor de texto Summernote con capacidad de carga de imágenes.

## Requisitos

- PHP >= 8.0
- Composer
- Laravel 10

## Instalación

1. Clona el repositorio:
git clone https://github.com/tu-usuario/laravel10-summernote-crud.git


2. Instala las dependencias con Composer:
composer install


3. Copia el archivo .env.example y renómbralo a .env:
cp .env.example .env


4. Genera una nueva clave de aplicación:
php artisan key


5. Configura la base de datos en el archivo .env y ejecuta las migraciones:
php artisan migrate


6. Instala las dependencias de npm y compila los assets:
npm install
npm run dev


## Uso

Accede al proyecto en tu navegador en la dirección `http://localhost:8000` y podrás ver el CRUD funcionando con el editor de texto Summernote y la capacidad de carga de imágenes.

## Contribuciones

Las contribuciones son bienvenidas. Si encuentras un error o quieres añadir alguna funcionalidad, por favor abre un issue o envía un pull request.

## Licencia

Este proyecto está licenciado bajo la licencia MIT.