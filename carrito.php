<?php
    session_start(); 
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrito de Compras - JN3 Kicks</title>
    <link rel="stylesheet" href="css/variables.css">
    <link rel="stylesheet" href="css/carrito.css">
</head>
<body>

    <!-- Encabezado principal -->
    <header class="header">
         <?php include __DIR__ . '/php/header/header.php'; ?>
    </header>

    <!-- Contenido principal del carrito -->
    <main class="carrito-pagina">
        <h1 class="carrito-pagina__titulo">Tu Carrito de Compras</h1>
        
        <div class="carrito-pagina__contenedor">
            
            <!-- Listado de articulos del carrito -->
            <div class="carrito-pagina__lista">
                
            </div>

            <!-- Resumen de costos de la orden -->
            <div class="carrito-resumen">
                <h2 class="carrito-resumen__titulo">Resumen de la Orden</h2>
                
                <div class="carrito-resumen__fila">
                    <span>Subtotal:</span>
                    <span class="carrito-resumen__valor-subtotal">$0</span>
                </div>
                
                <div class="carrito-resumen__fila">
                    <span>Envío:</span>
                    <span class="carrito-resumen__valor-envio">$0</span>
                </div>
                
                <div class="carrito-resumen__fila carrito-resumen__fila--total">
                    <span>Total:</span>
                    <span class="carrito-resumen__valor-total">$0</span>
                </div>
                
               <?php if (isset($_SESSION['usuario_id'])): ?>
    <button
        type="button"
        class="carrito-resumen__boton">
        Proceder al Pago
    </button>
<?php else: ?>
    <button
        type="button"
        class="carrito-resumen__boton"
        onclick="window.location.href='login.php'">
        Proceder al Pago
    </button>
<?php endif; ?>
            </div>

        </div>
    </main>

    <!-- Pie de página con detalles institucionales -->
    <footer class="footer">
        <div class="footer__garantias">
            <span> Rendimiento y estilo</span>
            <span> Envío nacional</span>
            <span> Síguenos @jn3kicks</span>
        </div>

        <p>&copy; 2026 JN3 Kicks - San Francisco de Macorís, RD</p>
        
        <div class="footer__enlaces">
            <a href="terminos.html" class="footer__link">Términos y Condiciones</a>
            <a href="soporte.html" class="footer__link">Soporte</a>
        </div>
    </footer>
    
    <script src="js/carrito.js"></script>

</body>
</html>

