# JN3 KICKS — Tienda de tenis con Laravel

Proyecto final de **Desarrollo de Aplicaciones Web (ISW-306)**, Ingeniería de Software, UAPA.

JN3 KICKS es una tienda en línea de tenis originales importados desde USA. Esta fase (Fase 4) migra la aplicación hecha en PHP puro y MySQL (Fase 3) a **Laravel 12**, con una instalación reproducible, datos de prueba y un diseño unificado.

---

## Funcionalidades

- **Inicio** con producto principal, barra de beneficios, productos destacados y banner promocional. El principal y los destacados se eligen desde el panel de administración.
- **Catálogo** con búsqueda, filtros (marca, género, categoría) y ordenamiento.
- **Detalle de producto** con botón "Agregar al carrito".
- **Login, registro y recuperación de contraseña.**
- **Carrito de compras**: agregar, cambiar cantidades, eliminar, y cálculo de subtotal, envío (RD$250) y total.
- **Panel de administración** (solo administradores): crear, editar y eliminar productos, y marcar producto principal y destacados.
- **Nosotros** con historia, misión, visión, valores y mapa de ubicación. **Contacto.**

## Tecnologías y versiones

| Tecnología | Versión |
|---|---|
| PHP | 8.2.12 (incluido en XAMPP) |
| Laravel | 12 |
| Base de datos | MariaDB (incluida en XAMPP) |
| Composer | 2.x |
| Frontend | Blade, CSS (metodología BEM) y JavaScript |

**¿Por qué Laravel 12 y no 13?** Laravel 13 exige PHP 8.3 o superior, y XAMPP trae PHP 8.2.12. Laravel 12 es compatible con el entorno que usa todo el equipo.

## Requisitos previos

1. **XAMPP** instalado. Solo se usa **MySQL**; Apache no es necesario porque Laravel trae su propio servidor.
2. **PHP en el PATH** de Windows: agregar `C:\xampp\php`. Para verificar, abrir una terminal nueva y correr `php -v`.
3. **Extensiones activas** en `C:\xampp\php\php.ini` (quitar el `;` del inicio de la línea):
   ```
   extension=zip
   extension=intl
   ```
4. **Composer** instalado. Verificar con `composer -V`.
5. **Git** instalado.

## Instalación

1. **Encender MySQL** desde el panel de XAMPP.
2. **Crear la base de datos** `jn3kicks` en phpMyAdmin (`http://localhost/phpmyadmin`; para abrirlo, encender también Apache). Cotejamiento recomendado: `utf8mb4_unicode_ci`.
3. **Clonar e instalar:**
   ```powershell
   git clone https://github.com/JarielNunez/jn3kicks-web.git
   cd jn3kicks-web
   composer install
   copy .env.example .env
   php artisan key:generate
   php artisan migrate:fresh --seed
   php artisan serve
   ```
4. Abrir **http://127.0.0.1:8000**.

El archivo `.env.example` ya trae la conexión para XAMPP (`DB_DATABASE=jn3kicks`, `DB_USERNAME=root` y contraseña vacía).

> ⚠ **Importante sobre `migrate:fresh`:** este comando **borra todas las tablas** y las vuelve a crear con los datos de prueba. Se usa en la instalación y cada vez que se quiera volver al estado inicial. Después de un `git pull` que traiga **migraciones nuevas**, se puede usar `php artisan migrate`, que agrega solo lo nuevo **sin borrar datos**.

> ⚠ **Usar siempre `composer install`, nunca `composer update`.** `install` instala las versiones exactas de `composer.lock`, que son compatibles con PHP 8.2. `update` puede descargar versiones que exigen PHP 8.4 y romper la instalación para todos.

### Alternativa: script SQL

En `database/jn3kicks.sql` está la base de datos completa (estructura y datos de prueba). Se puede importar en phpMyAdmin, en la base `jn3kicks`, en lugar de correr `migrate:fresh --seed`. Los pasos de `composer install`, `.env` y `key:generate` siguen siendo necesarios.

## Usuarios de demostración

| Rol | Correo | Contraseña |
|---|---|---|
| Administrador | admin@jn3kicks.com | Admin1234 |
| Cliente | demo@jn3kicks.com | Demo1234 |

El cliente demo ya trae artículos en su carrito. El administrador ve la opción **"Administrar"** en el menú.

## Problemas comunes

| Error | Solución |
|---|---|
| `php` no se reconoce como comando | Agregar `C:\xampp\php` al PATH y abrir una terminal nueva. |
| Composer pide la extensión `zip` o `intl` | Activarlas en `php.ini` (ver Requisitos). |
| Composer falla con *certificate verify failed* | Revisar la fecha y hora de Windows y actualizar `C:\xampp\php\cacert.pem` desde https://curl.se/ca/cacert.pem. |
| *"requires php >=8.4"* al hacer `composer install` | Alguien corrió `composer update`. Restaurar `composer.lock` desde Git. |
| *"Table doesn't exist"* o error de conexión | MySQL está apagado en XAMPP. Encenderlo y repetir el comando. |
| Los cambios en `.env.example` no se aplican | `.env` es una copia: hay que editar `.env` directamente. |

## Estructura relevante

```
app/Http/Controllers/   Controladores (Carrito, Inicio, Producto, Auth, Admin/Producto)
app/Http/Middleware/    EsAdmin (alias "admin")
app/Models/             Usuario, Producto, Carrito, Pedido, PedidoDetalle
database/migrations/    Estructura de las tablas
database/seeders/       Datos de prueba (usuarios, productos, carrito)
public/css, public/js   Estilos y scripts (variables.css y layout.css son globales)
resources/views/        Vistas Blade; layouts/app.blade.php es la plantilla base
routes/                 web.php incluye un archivo de rutas por integrante
```

**Ciclo de una petición:** ruta → controlador → modelo → vista. Ejemplo: `GET /carrito` → `CarritoController@index` → modelo `Carrito` con su `producto` → `carrito.blade.php`.

---

## Integrantes

| Integrante | Parte |
|---|---|
| Jariel Núñez | Esqueleto del proyecto, base de datos, carrito, diseño unificado, integración y coordinación |
| Robi | Layout, Inicio, Nosotros y Contacto |
| Joshua | Login, registro y recuperación de contraseña |
| Reimer Eliandy Hache | Middlewares de acceso (`auth` y `admin`) |
| Ramon | Catálogo y detalle de producto |
| JeanMarcos | Panel admin (lógica), campos de Inicio y documentación |
| Elvira | Panel admin (vistas y estilos) |

---

## Aporte de Jariel Núñez

### 1. Mi parte
Esqueleto del proyecto en Laravel 12 (migraciones, modelos y seeders), módulo completo del carrito, diseño unificado del sitio (layout, paleta, logo, Inicio y Nosotros) y coordinación de la integración (merges, arreglos de instalación y entrega final).

### 2. Archivos que creé o modifiqué
**Base de datos**
- `database/migrations/` — tablas usuarios, productos, carrito, pedidos y pedido_detalle
- `database/seeders/UsuarioSeeder.php`, `ProductoSeeder.php`, `CarritoSeeder.php`
- `database/jn3kicks.sql` — script con estructura y datos de prueba
- `app/Models/` — Usuario, Producto, Carrito, Pedido, PedidoDetalle

**Carrito**
- `app/Http/Controllers/CarritoController.php`
- `routes/carrito.php`
- `resources/views/carrito.blade.php`
- `public/js/carrito.js`, `public/css/carrito.css`
- Botón "Agregar al carrito" en `resources/views/catalogo/show.blade.php`

**Diseño**
- `resources/views/layouts/app.blade.php` — logo y carga de estilos comunes
- `public/css/layout.css` (nuevo), `public/css/variables.css` — paleta rojo, negro y blanco
- `public/img/logo.png`
- `resources/views/inicio.blade.php`, `public/css/inicio.css`, `app/Http/Controllers/InicioController.php` — producto principal, beneficios, destacados y banner
- `resources/views/nosotros.blade.php`, `public/css/nosotros.css` — secciones y mapa
- `resources/views/catalogo/index.blade.php` y `show.blade.php` — adaptadas a `layouts.app`

### 3. Rutas que agregué
Todas protegidas con el middleware `auth`:

| Método | URL | Nombre | Acción |
|---|---|---|---|
| GET | `/carrito` | `carrito.index` | Ver el carrito |
| POST | `/carrito` | `carrito.store` | Agregar producto (suma si ya existe) |
| PATCH | `/carrito/{carrito}` | `carrito.update` | Cambiar cantidad |
| DELETE | `/carrito/{carrito}` | `carrito.destroy` | Eliminar artículo |

### 4. Cómo se prueba
1. Iniciar sesión con `demo@jn3kicks.com` / `Demo1234` (ya trae 2 artículos en el carrito).
2. Entrar a `/carrito`: subtotal, envío (RD$250) y total se calculan solos.
3. Usar los botones < y > para cambiar cantidades y recargar: el cambio se mantiene.
4. Desde el detalle de un producto, tocar "Agregar al carrito": si ya estaba, suma 1 en la misma fila.
5. Sin sesión, `/carrito` redirige al login.
6. Con `admin@jn3kicks.com` / `Admin1234`, marcar otro producto como principal en el panel: el Inicio cambia sin tocar código.

### 5. Dificultades y cómo las resolví
- **SQL a mano → Eloquent:** el carrito pasó de consultas manuales a relaciones (`with('producto')`), evitando el problema N+1.
- **Seguridad:** se agregó protección CSRF en todas las peticiones del carrito y una validación para que un usuario no pueda modificar el carrito de otro (vulnerabilidad IDOR, OWASP "Broken Access Control").
- **Precios con formato rompían los cálculos en JS:** `parseFloat("RD$8,800.00")` daba `NaN`. Se separó el valor numérico (`data-precio`) del texto visible.
- **Rutas de imagen duplicadas:** armar la ruta a mano generaba `img/productos/img/productos/...`. Se estandarizó `asset($producto->imagen)`.
- **Conflictos de CSS:** varios archivos redefinían el header, el footer y las variables globales. Se centralizó todo en `layout.css` y `variables.css`.

---

## Aporte de Robi

### 1. Mi parte
Diseño y maquetación del layout principal (`app.blade.php`) con header y footer dinámicos (gestión de sesión de usuario y botón de logout con POST/CSRF), la vista de Inicio con productos destacados desde la base de datos, y las vistas de Nosotros y Contacto.

### 2. Archivos que creé o modifiqué
- `resources/views/layouts/app.blade.php` — plantilla base
- `resources/views/inicio.blade.php` — vista principal
- `resources/views/nosotros.blade.php` — vista de Nosotros
- `resources/views/contacto.blade.php` — vista de Contacto
- `app/Http/Controllers/InicioController.php` — controlador de Inicio, Nosotros y Contacto
- `routes/inicio.php` — rutas de la sección

### 3. Rutas que agregué

| Método | URL | Nombre |
|---|---|---|
| GET | `/` | `inicio` |
| GET | `/nosotros` | `nosotros` |
| GET | `/contacto` | `contacto` |

### 4. Cómo se prueba
1. Iniciar el servidor con `php artisan serve`.
2. Navegar a http://127.0.0.1:8000/ y verificar el layout general y los productos del Inicio.
3. Navegar a `/nosotros` y `/contacto`.
4. Iniciar sesión como cliente (`demo@jn3kicks.com` / `Demo1234`) o administrador (`admin@jn3kicks.com` / `Admin1234`) y verificar que el header muestre el nombre del usuario, la opción "Administrar" (solo admin) y el menú de cierre de sesión.

### 5. Dificultades y cómo las resolví
- **Sintaxis de directivas Blade:** hubo errores al anidar `@auth` y `@if` con HTML en la misma línea. Se resolvió separando las directivas en líneas propias e indentando.
- **Carga de CSS:** para no duplicar estilos entre vistas, se enlazaron desde `public/css/` con `@push('estilos')` y `@stack('estilos')` en la plantilla base.
- **Rutas de imágenes:** la columna `imagen` tenía formatos variables. Se resolvió con el helper `asset()` para evitar errores 404.

---

## Aporte de Joshua

> ⚠ **Borrador:** sección armada a partir de los archivos del repositorio. Pendiente de que Joshua la confirme y complete.

### 1. Mi parte
Módulo de autenticación con controladores de Laravel: inicio de sesión, cierre de sesión, registro de usuarios y recuperación de contraseña, con sus vistas y estilos.

### 2. Archivos que creé o modifiqué
- `app/Http/Controllers/AuthController.php`
- `routes/auth.php`
- `resources/views/login.blade.php`
- `resources/views/registro.blade.php`
- `resources/views/recuperar-contrasena.blade.php`
- `public/css/login.css`, `public/css/registro.css`, `public/css/recuperar.css`

### 3. Rutas que agregué

| Método | URL | Nombre | Acción |
|---|---|---|---|
| GET | `/login` | `login` | Formulario de inicio de sesión |
| POST | `/login` | — | `AuthController@login` |
| POST | `/logout` | `logout` | Cerrar sesión |
| GET | `/registro` | `register` | Formulario de registro |
| POST | `/registro` | — | `AuthController@register` |
| GET | `/recuperar-contrasena` | `password.request` | Formulario de recuperación |
| POST | `/recuperar-contrasena` | `password.search` | Procesar recuperación |

### 4. Cómo se prueba
1. Entrar a `/login` con `demo@jn3kicks.com` / `Demo1234`: debe iniciar sesión y mostrar el nombre en el header.
2. Probar una contraseña incorrecta: debe mostrar un error.
3. Cerrar sesión desde el menú del usuario.
4. Registrar un usuario nuevo desde `/registro` e iniciar sesión con él.

### 5. Dificultades y cómo las resolví
*(Pendiente de completar por Joshua.)*

---

## Aporte de Reimer Eliandy Hache

### 1. Mi parte
Middlewares de acceso: `EsAdmin` (alias `admin`), que solo deja pasar a administradores, y la redirección de invitados al login con el middleware `auth`. Protegen el panel de administración y las rutas que exigen sesión.

### 2. Archivos que creé o modifiqué
- `app/Http/Middleware/EsAdmin.php` (nuevo): revisa que haya sesión y que `esAdmin()` sea verdadero; si no, responde `abort(403)`.
- `bootstrap/app.php` (modificado): registra el alias `admin` y configura `redirectGuestsTo('/login')`.

### 3. Rutas que agregué
No agregué rutas definitivas. Dejé listos dos middlewares para que los demás los usen en sus archivos de rutas:
```php
Route::middleware(['auth', 'admin'])->group(function () {
    // rutas del panel admin
});
```
- `auth`: un invitado es redirigido a `/login`.
- `admin`: un usuario con sesión pero sin rol de administrador recibe error 403.

### 4. Cómo se prueba
1. Encender MySQL y correr `php artisan migrate:fresh --seed` y `php artisan serve`.
2. Entrar a una ruta protegida con `['auth', 'admin']`, por ejemplo `/admin/productos`:
   - Sin sesión: redirige a `/login`.
   - Con `demo@jn3kicks.com` / `Demo1234` (cliente): error 403.
   - Con `admin@jn3kicks.com` / `Admin1234` (administrador): entra.

Durante el desarrollo lo probé con rutas temporales que usaban `Auth::loginUsingId(1)` y `Auth::loginUsingId(2)`, y las eliminé antes del Pull Request #5.

### 5. Dificultades y cómo las resolví
- **El cliente entró a la zona admin en la primera prueba:** `EsAdmin.php` no estaba guardado y Laravel usaba la versión de fábrica, que deja pasar a todos. Guardé el archivo y repetí las tres pruebas.
- **Las rutas de prueba no debían subirse:** usé `git add` solo con mis dos archivos (sin `-A`) y restauré `routes/web.php` con `git restore`. En el Pull Request revisé que solo aparecieran 2 archivos.
- **Al probar el invitado salía 404:** redirigía a `/login`, una ruta de otro compañero que aún no estaba en mi rama. Lo importante era que la URL cambiara a `/login`, y eso confirmó que `auth` funcionaba.

---

## Aporte de Ramon

> ⚠ **Borrador:** sección armada a partir de los archivos del repositorio. Pendiente de que Ramon la confirme y complete.

### 1. Mi parte
Catálogo de productos con búsqueda, filtros y ordenamiento, y la página de detalle de cada producto, usando una sola vista para todos los productos.

### 2. Archivos que creé o modifiqué
- `app/Http/Controllers/ProductoController.php` — métodos `index` (catálogo) y `show` (detalle)
- `routes/catalogo.php`
- `resources/views/catalogo/index.blade.php` — catálogo con buscador y filtros
- `resources/views/catalogo/show.blade.php` — detalle de producto
- `public/js/catalogo.js` — búsqueda, filtros por marca, género y categoría, y ordenamiento, usando atributos `data-` de cada tarjeta
- `public/css/catalogo.css`

### 3. Rutas que agregué

| Método | URL | Nombre |
|---|---|---|
| GET | `/catalogo` | `catalogo.index` |
| GET | `/producto/{producto}` | `producto.show` |

### 4. Cómo se prueba
1. Entrar a `/catalogo`: deben aparecer todos los productos con imagen, marca, categoría y precio.
2. Escribir en el buscador: las tarjetas se filtran mientras se escribe.
3. Combinar filtros de marca, género y categoría, y cambiar el orden por precio o nombre.
4. Tocar "Ver detalles": abre `/producto/{id}` con la información del producto.

### 5. Dificultades y cómo las resolví
*(Pendiente de completar por Ramon.)*

---

## Aporte de JeanMarcos

### 1. Mi parte
Lógica del panel de administrador de productos (CRUD) con un controlador resource, validación con Form Request y avisos por sesión. Además agregué los campos "producto principal" y "destacado" para que el Inicio los muestre desde la base de datos. Solo puede haber un producto principal.

### 2. Archivos que creé o modifiqué
- `routes/admin.php`
- `app/Http/Controllers/Admin/ProductoController.php`
- `app/Http/Requests/ProductoRequest.php`
- `app/Models/Producto.php` — `$fillable` y `$casts` con `es_principal` y `destacado`
- `database/migrations/2026_10_16_205127_add_destacado_to_productos_table.php` (migración nueva)
- `resources/views/admin/productos/_form.blade.php` — dos casillas, agregadas sobre las vistas de Elvira
- `resources/views/admin/productos/index.blade.php` — columna "En inicio", agregada sobre las vistas de Elvira

### 3. Rutas que agregué
Grupo con prefijo `/admin`, nombre `admin.` y middlewares `auth` y `admin`, con `Route::resource('productos', ProductoController::class)->except('show')`:

| Método | URL | Nombre |
|---|---|---|
| GET | `/admin/productos` | `admin.productos.index` |
| GET | `/admin/productos/create` | `admin.productos.create` |
| POST | `/admin/productos` | `admin.productos.store` |
| GET | `/admin/productos/{producto}/edit` | `admin.productos.edit` |
| PUT/PATCH | `/admin/productos/{producto}` | `admin.productos.update` |
| DELETE | `/admin/productos/{producto}` | `admin.productos.destroy` |

### 4. Cómo se prueba
1. Encender MySQL en XAMPP. Si la base ya existe, aplicar la migración nueva con `php artisan migrate`, que no borra datos.
2. Correr `php artisan serve`.
3. Iniciar sesión como admin (`admin@jn3kicks.com` / `Admin1234`) y entrar a http://127.0.0.1:8000/admin/productos.
4. Crear, editar y eliminar un producto: debe salir el aviso verde de éxito.
5. Enviar el formulario con datos inválidos (precio negativo, marca inventada): deben salir los errores en español y conservarse los datos escritos.
6. Marcar un producto como "Producto principal" y guardar; luego marcar otro: en el listado solo el último debe decir "Principal".
7. Eliminar un producto que ya esté en un pedido: debe salir "No se puede eliminar: tiene pedidos".

### 5. Dificultades y cómo las resolví
- **Casillas que no se enviaban:** un checkbox sin marcar no llega al servidor. Puse un `input hidden` con valor 0 antes de cada checkbox, así siempre llega 0 o 1 y la regla `boolean` funciona.
- **MySQL apagado durante `migrate:fresh`:** el comando se cortó y las tablas no se recrearon (error "la tabla no existe"). Encendí MySQL en XAMPP y repetí el comando; desde entonces uso `php artisan migrate` para no borrar datos.
- **Push rechazado en la rama compartida:** Elvira había subido sus vistas a la misma rama. Hice `git pull` para traer su trabajo y luego `git push`. Desde entonces hago pull antes de cada push.

---

## Aporte de Elvira

### 1. Mi parte
Vistas Blade del panel de administrador de productos (listar, crear, editar y borrar con confirmación), con sus estilos. La lógica (rutas, controlador y validación) la hizo JeanMarcos.

### 2. Archivos que creé o modifiqué
- `resources/views/admin/productos/index.blade.php`
- `resources/views/admin/productos/create.blade.php`
- `resources/views/admin/productos/edit.blade.php`
- `resources/views/admin/productos/_form.blade.php`
- `public/css/admin.css` — agregué `.admin__error` y `a.admin__boton-accion`

### 3. Rutas que usan mis vistas
Las definió JeanMarcos en `routes/admin.php` (ver su sección).

### 4. Cómo se prueba
1. Ejecutar `php artisan serve`.
2. Entrar a http://127.0.0.1:8000/login con `admin@jn3kicks.com` / `Admin1234`.
3. Abrir `/admin/productos` y verificar que se listan los productos.
4. Crear un producto con "Agregar producto": debe aparecer el mensaje de éxito.
5. Dejar el nombre vacío y guardar: debe mostrarse el error y conservarse lo escrito.
6. Editar un producto: el formulario debe aparecer ya lleno.
7. Pulsar "Eliminar", cancelar la confirmación (no borra) y luego aceptarla (borra).

### 5. Dificultades y cómo las resolví
- **Layout con `<main>` propio:** el HTML viejo usaba `<main class="admin">`, pero el layout ya tiene un `<main>`. Usé `<div class="admin">` para no anidar dos `<main>`.
- **Estilos ya existentes:** mis primeras clases no coincidían con las del `admin.css` de la Fase 3. Reutilicé las clases existentes (`admin__mensaje--exito`, `admin__boton-editar`, etc.) y solo agregué las que faltaban.
- **Git en rama compartida:** `git add -A` habría subido `desktop.ini`, un archivo basura de Windows. Agregué los archivos por nombre y hago `git pull` antes de cada push porque comparto rama con JeanMarcos.

---

## Integración del equipo

Al unir las ramas surgieron problemas que se resolvieron en conjunto:

- **Vistas que no usaban la plantilla base:** el catálogo y el detalle eran páginas HTML completas. Se adaptaron a `@extends('layouts.app')` para compartir header, footer y estilos.
- **`.env.example` eliminado de la rama común:** sin ese archivo no se puede instalar el proyecto. Se restauró y se acordó crear el `.env` con `copy`, nunca moviendo el archivo.
- **`composer.lock` incompatible:** una actualización hecha con PHP 8.4 dejó paquetes que no funcionan con el PHP 8.2 de XAMPP. Se restauró la versión anterior y se acordó usar solo `composer install`.
- **Variables CSS redefinidas:** un archivo de página redefinía variables globales y cambiaba colores y fuentes solo en algunas páginas. Se acordó que las variables globales viven únicamente en `variables.css`.
- **Conflictos de merge:** dos integrantes modificaron `inicio.blade.php` en paralelo. Se revisaron ambas versiones y se conservó la más reciente.

### Reglas de trabajo acordadas
- Una rama por integrante; nadie trabaja directo en la rama común.
- `git pull --no-edit origin fase-4-despliegue` antes de empezar y antes de abrir un Pull Request.
- Agregar archivos por nombre (`git add archivo`), no con `git add .` ni `-A`.
- Nunca subir `.env` ni `vendor/`.
- No editar migraciones existentes: los cambios de estructura van en una migración nueva.

## Mejoras futuras

- **Galería de imágenes por producto:** tabla `producto_imagenes` con relación uno a muchos, miniaturas en el detalle y carga de varias fotos desde el panel.
- **Proceso de pago:** convertir el carrito en un pedido (tablas `pedidos` y `pedido_detalle`, ya creadas), restar stock y vaciar el carrito dentro de una transacción.
- **Migrar a PHP 8.4:** mejor rendimiento y soporte de seguridad por más tiempo. Requiere que todo el equipo actualice su entorno y fijar la versión en `composer.json` (`config.platform.php`).
- **Publicación en un dominio:** hosting con PHP y MySQL, `APP_DEBUG=false`, contraseñas nuevas para los usuarios demo y HTTPS.
