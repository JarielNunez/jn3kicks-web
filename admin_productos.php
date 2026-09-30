<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrar Productos - JN3 KICKS</title>
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@600;700&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/variables.css">
    <link rel="stylesheet" href="css/admin.css">
</head>
<body>

    <header class="header">
        <?php include __DIR__ . '/php/header/header.php'; ?>
    </header>

    <main class="admin">

        <div class="admin__encabezado">
            <h1 class="admin__titulo">Administrar Productos</h1>
            <p class="admin__subtitulo">Agrega, edita o elimina productos del catálogo</p>
        </div>

        <section class="admin__formulario-wrapper">
            <h2 class="admin__form-titulo" id="formTitulo">Agregar producto nuevo</h2>

            <form id="formProducto" class="admin__form">
                <input type="hidden" id="productoId" value="">

                <div class="admin__campo">
                    <label for="nombre">Nombre</label>
                    <input type="text" id="nombre" required>
                </div>

                <div class="admin__campo">
                    <label for="precio">Precio (RD$)</label>
                    <input type="number" id="precio" step="0.01" min="0" required>
                </div>

                <div class="admin__campo">
                    <label for="imagen">Ruta de la imagen</label>
                    <input type="text" id="imagen" placeholder="img/nombre-archivo.jpg" required>
                </div>

                <div class="admin__campo">
                    <label for="marca">Marca</label>
                    <select id="marca" required>
                        <option value="">Selecciona...</option>
                        <option value="nike">Nike</option>
                        <option value="converse">Converse</option>
                    </select>
                </div>

                <div class="admin__campo">
                    <label for="genero">Género</label>
                    <select id="genero" required>
                        <option value="">Selecciona...</option>
                        <option value="hombre">Hombre</option>
                        <option value="mujer">Mujer</option>
                        <option value="unisex">Unisex</option>
                    </select>
                </div>

                <div class="admin__campo">
                    <label for="categoria">Categoría</label>
                    <select id="categoria" required>
                        <option value="">Selecciona...</option>
                        <option value="running">Running</option>
                        <option value="basketball">Basketball</option>
                        <option value="casual">Casual</option>
                    </select>
                </div>

                <div class="admin__campo">
                    <label for="stock">Stock</label>
                    <input type="number" id="stock" min="0" required>
                </div>

                <div class="admin__form-botones">
                    <button type="submit" class="boton boton--primario" id="botonGuardar">Agregar producto</button>
                    <button type="button" class="boton boton--secundario" id="botonCancelar" style="display: none;">Cancelar edición</button>
                </div>

                <p class="admin__mensaje" id="mensaje"></p>
            </form>
        </section>

        <section class="admin__tabla-wrapper">
            <h2 class="admin__form-titulo">Productos existentes</h2>

            <table class="admin__tabla">
                <thead>
                    <tr>
                        <th>Imagen</th>
                        <th>Nombre</th>
                        <th>Precio</th>
                        <th>Marca</th>
                        <th>Género</th>
                        <th>Categoría</th>
                        <th>Stock</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody id="cuerpoTabla"></tbody>
            </table>
        </section>

    </main>

    <script src="js/admin_productos.js"></script>

</body>
</html>
