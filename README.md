## Sistema de gestión de agremiados para la asociación venezolana de plástico.
El sistema CRM se presenta como una herramienta valiosa para optimizar la gestión de afiliados de la Asociación Venezolana de Plástico, mejorando la comunicación, la organización y la eficiencia en el manejo de información.

**Objetivo:**

-   Gestionar afiliados de la Asociación Venezolana de Plástico de manera eficiente y centralizada.

**Beneficios:**

-   Elimina la gestión de datos de pagos y boletines por WhatsApp.
-   Centraliza la información en un sistema seguro y accesible.
-   Facilita la comunicación entre la asociación y los afiliados.
-   Permite la suspensión de cuentas de afiliados morosos.
-   Ofrece a los afiliados un portal para gestionar su cuenta y acceder a información relevante.

**Funcionalidades:**

-   **Para afiliados:**
    -   Visualización de estado de cuenta.
    -   Consulta de facturas y pagos.
    -   Recepción de notificaciones y boletines.
    -   Modificación de datos de empresa.
    -   Envío de mensajes a la asociación.
-   **Para administradores:**
    -   Creación de notificaciones, boletines y noticias.
    -   Consulta de datos de afiliados (incluidos estados de cuenta).
    -   Suspensión de cuentas de afiliados.
    -   Edición de información del sitio web.
    -   Creción de perfiles de usuarios personalizados.
    -   Auditorías de los registros de la Base de Datos
    -   Backups y restauraciones de los datos

## Levantar el proyecto en local

> Debemos de tener una versión de PHP mayor o igual a la 8.2.0

**Clonamos el repositorio:**

    git clone https://github.com/Homer1020/avipla.git

**Instalamos las dependencias de composer:**

    composer install

**Configuramos las variables de entorno:**

A partir del archivo .env.example creamos nuestro .env y configuramos según sea conveniente.

**Confugurar datos para iniciar sesión**
En el AdminSeeder.php puedes editar el usuario administrador que se creará al migrar la Base de Datos
``` php

    // /avipla/database/seeders/AdminSeeder.php

    # previous code ...
    $user = User::create([
        'email'     => 'tucorreo@gmail.com',
        'password'  => bcrypt('admin123'),
        'name'      => 'Tu nombre'
    ]);
    # next code ...
```

**Migramos la base de datos:**

El siguiente comando además de crear la estructura de la base de datos, la llena con datos de ejemplo.

    php artisan migrate --seed

**Ejecutamos los trabajos en cola**

    php artisan queue:work

**Iniciamos nuestro servidor PHP :**

    php artisan serve

Podemos ingresar a la ruta http://127.0.0.1:8000/login para poder iniciar sesión con los siguientes datos:

 - Correo: admin@admin.com
 - Password: admin123
