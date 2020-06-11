Pasos para la instalacion

1.- Abrir terminal donde desea descargar el proyecto.

2.- Clonar proyecto ejecutando git clone git@gitlab.com:alopez.215.95/crudautomotriz.git

3.- Entrar al directorio raiz del proyecto.

4.- Ejecutar el comando 'composer install' en su terminal.

5.- Crear el archivo .env a partir de .env.example.

6.- Crear base de datos en mysql con el nombre 'automotriz'.

7.- Ejecutar el comando 'php artisan key:generate' en su terminal.

8.- Ejecutar el comando 'npm install' en su terminal.

9.- Ejecutar el comando 'php artisan migrate --seed' en su terminal.

10.- Abrir una segunda terminal el directorio raiz del proyecto y ejecutar 'npm run dev' o 'npm run watch'

11.- Luego de los pasos anteriormente descritos ejecutar 'php artisan serve'

12.- Las credenciales para iniciar sesion son las siguientes:

    User: admin@admin.com
    Pass: admin