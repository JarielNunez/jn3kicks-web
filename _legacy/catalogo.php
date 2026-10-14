<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catálogo | JN3 KICKS</title>
    <link rel="stylesheet" href="css/variables.css">
    <link rel="stylesheet" href="css/catalogo.css">
</head>

<body>

    <header class="header">
       <?php include __DIR__ . '/php/header/header.php'; ?>
    </header>

    <main class="main">

        <section class="catalogo-intro">
            <h2 class="catalogo-intro__titulo">Catálogo de Tenis</h2>
            <p class="catalogo-intro__texto">Encuentra los mejores tenis deportivos y urbanos en JN3 KICKS.</p>
        </section>

        <section class="buscador">
            <h2 class="buscador__titulo">Buscar productos</h2>
            <form class="buscador__form" action="#" method="get">
                <label class="buscador__label" for="buscar">Buscar tenis:</label>

                <div class="buscador__campo">
                    <input class="buscador__input" type="search" id="buscar" name="buscar" placeholder="Escribe el nombre del tenis">
                    <span class="buscador__error" role="alert" style="display: none;"></span>
                </div>

                <button class="buscador__boton" type="submit">Buscar</button>
            </form>
        </section>

        <section id="catalogo" class="catalogo">
            <h2 class="catalogo__titulo">Productos</h2>

            <aside class="filtros">
                <h2 class="filtros__titulo-general">Filtros</h2>

                <section class="filtros__grupo">
                    <h3 class="filtros__titulo">Marca</h3>
                    <ul class="filtros__lista">
                        <li class="filtros__item">
                            <label class="filtros__label">
                                <input class="filtros__checkbox" type="checkbox" name="marca" value="nike"> Nike
                            </label>
                        </li>
                        <li class="filtros__item">
                            <label class="filtros__label">
                                <input class="filtros__checkbox" type="checkbox" name="marca" value="converse"> Converse
                            </label>
                        </li>
                    </ul>
                </section>

                <section class="filtros__grupo">
                    <h3 class="filtros__titulo">Género</h3>
                    <ul class="filtros__lista">
                        <li class="filtros__item">
                            <label class="filtros__label">
                                <input class="filtros__checkbox" type="checkbox" name="genero" value="hombre"> Hombre
                            </label>
                        </li>
                        <li class="filtros__item">
                            <label class="filtros__label">
                                <input class="filtros__checkbox" type="checkbox" name="genero" value="mujer"> Mujer
                            </label>
                        </li>
                        <li class="filtros__item">
                            <label class="filtros__label">
                                <input class="filtros__checkbox" type="checkbox" name="genero" value="unisex"> Unisex
                            </label>
                        </li>
                    </ul>
                </section>

                <section class="filtros__grupo">
                    <h3 class="filtros__titulo">Categoría</h3>
                    <ul class="filtros__lista">
                        <li class="filtros__item">
                            <label class="filtros__label">
                                <input class="filtros__checkbox" type="checkbox" name="categoria" value="running"> Running
                            </label>
                        </li>
                        <li class="filtros__item">
                            <label class="filtros__label">
                                <input class="filtros__checkbox" type="checkbox" name="categoria" value="basketball"> Basketball
                            </label>
                        </li>
                        <li class="filtros__item">
                            <label class="filtros__label">
                                <input class="filtros__checkbox" type="checkbox" name="categoria" value="casual"> Casual
                            </label>
                        </li>
                    </ul>
                </section>
            </aside>

            <div class="catalogo__ordenar">
                <label class="catalogo__ordenar-label" for="orden">Ordenar por:</label>
                <select class="catalogo__ordenar-select" id="orden" name="orden">
                    <option value="destacados">Productos destacados</option>
                    <option value="precio-menor">Precio: menor a mayor</option>
                    <option value="precio-mayor">Precio: mayor a menor</option>
                    <option value="nombre">Nombre</option>
                </select>
            </div>

            <section class="catalogo__productos"></section>

            <section class="guia-tallas">
                <h2 class="guia-tallas__titulo">Guía de tallas</h2>
                <table class="guia-tallas__tabla">
                    <thead>
                        <tr>
                            <th>Talla US</th>
                            <th>Talla EU</th>
                            <th>Longitud aproximada</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr><td>7</td><td>40</td><td>25 cm</td></tr>
                        <tr><td>8</td><td>41</td><td>26 cm</td></tr>
                        <tr><td>9</td><td>42</td><td>27 cm</td></tr>
                        <tr><td>10</td><td>44</td><td>28 cm</td></tr>
                        <tr><td>11</td><td>45</td><td>29 cm</td></tr>
                    </tbody>
                </table>
            </section>

            <nav class="paginacion" aria-label="Paginación del catálogo">
                <a class="paginacion__link" href="#" aria-label="Página anterior">Anterior</a>
                <a class="paginacion__link paginacion__link--activo" href="#" aria-current="page">1</a>
                <a class="paginacion__link" href="#">2</a>
                <a class="paginacion__link" href="#">3</a>
                <a class="paginacion__link" href="#" aria-label="Página siguiente">Siguiente</a>
            </nav>

        </section>

    </main>

    <footer class="footer">
        <p class="footer__copy">&copy; 2026 JN3 KICKS. Todos los derechos reservados.</p>
        <nav class="footer__nav">
            <a class="footer__link" href="index.php">Inicio</a>
            <a class="footer__link" href="catalogo.php">Catálogo</a>
            <a class="footer__link" href="nosotros.php">Nosotros</a>
            <a class="footer__link" href="contacto.html">Contacto</a>
        </nav>
    </footer>

    <script src="js/catalogo.js"></script>

</body>

</html>
