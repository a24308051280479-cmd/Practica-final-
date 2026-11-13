<!DOCTYPE html>
<!-- Declaración del estándar HTML5 -->
<html lang="es">
<head>
    <!-- Configuración de codificación de caracteres (soporte para acentos y eñes) -->
    <meta charset="UTF-8">
    <!-- Configuración de vista adaptable (Responsive) para computadoras, tablets y celulares -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Título que aparece en la pestaña del navegador -->
    <title>Librería Lectura Viva - Página Principal</title>
    
    <!-- Importación de fuentes tipográficas desde Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Merriweather:wght@400;700&family=Inter:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- HOJA DE ESTILOS CSS -->
    <style>
        /* Variables globales de color para mantener uniformidad en todas las páginas */
        :root {
            --cafe-marron: #2c1810;
            --cafe-hover: #441a0e;
            --crema-fondo: #fcfbf7;
            --texto-oscuro: #1c1917;
            --blanco: #ffffff;
            --borde-tarjeta: #e7e5e4;
            --acento-dorado: #b45309;
            --verde-exito: #15803d;
        }

        /* Reset básico para eliminar márgenes por defecto del navegador */
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Inter', sans-serif;
        }

        body {
            background-color: var(--crema-fondo);
            color: var(--texto-oscuro);
        }

        /* ==========================================
           1. ENCABEZADO (HEADER)
           ========================================== */
        header {
            background-color: var(--cafe-marron);
            color: var(--blanco);
            padding: 18px 40px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 15px;
        }

        /* Logotipo enlazado a la página principal */
        .logo {
            font-family: 'Merriweather', serif;
            font-size: 24px;
            font-weight: 700;
            color: #fef08a;
            text-decoration: none;
        }

        .busqueda input {
            padding: 9px 18px;
            border-radius: 20px;
            border: none;
            outline: none;
            width: 300px;
            font-size: 14px;
        }

        .header-acciones {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .user-nav a {
            color: var(--blanco);
            text-decoration: none;
            font-weight: 600;
            font-size: 14px;
            background-color: #441a0e;
            padding: 9px 16px;
            border-radius: 6px;
            transition: background 0.3s;
            display: inline-block;
        }

        .user-nav a:hover {
            background-color: #5c2414;
        }

        /* Botón del Carrito en el Encabezado */
        .btn-abrir-carrito {
            background-color: #fef08a;
            color: var(--cafe-marron);
            border: none;
            padding: 9px 16px;
            border-radius: 6px;
            font-weight: 700;
            font-size: 14px;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: transform 0.2s, background 0.2s;
        }

        .btn-abrir-carrito:hover {
            background-color: #fde047;
            transform: scale(1.03);
        }

        .contador-carrito {
            background-color: var(--cafe-marron);
            color: #fef08a;
            padding: 2px 8px;
            border-radius: 12px;
            font-size: 12px;
        }

        /* ==========================================
           2. BARRA DE NAVEGACIÓN (NAV)
           ========================================== */
        nav {
            background-color: var(--blanco);
            padding: 14px 40px;
            border-bottom: 1px solid var(--borde-tarjeta);
            position: sticky;
            top: 0;
            z-index: 100;
        }

        nav ul {
            list-style: none;
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 35px;
        }

        nav a {
            text-decoration: none;
            color: var(--texto-oscuro);
            font-weight: 600;
            font-size: 14px;
            transition: color 0.2s;
        }

        /* Estilo para resaltar la pestaña activa y el efecto al pasar el cursor */
        nav a:hover, nav a.activo {
            color: var(--acento-dorado);
            border-bottom: 2px solid var(--acento-dorado);
            padding-bottom: 4px;
        }

        /* ==========================================
           3. CUERPO PRINCIPAL (MAIN)
           ========================================== */
        main {
            max-width: 1200px;
            margin: 30px auto;
            padding: 0 20px;
        }

        /* Banner Promocional Superior */
        .hero-banner {
            background: linear-gradient(rgba(44, 24, 16, 0.78), rgba(44, 24, 16, 0.78)), 
                        url('https://images.unsplash.com/photo-1507842217343-583bb7270b66?w=1200') center/cover;
            min-height: 300px;
            border-radius: 12px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 40px;
            color: white;
            margin-bottom: 40px;
        }

        .hero-banner h1 {
            font-family: 'Merriweather', serif;
            font-size: 36px;
            margin-bottom: 10px;
            color: #fef08a;
        }

        .hero-banner p {
            font-size: 16px;
            max-width: 580px;
            color: #e7e5e4;
            line-height: 1.5;
        }

        /* Títulos de cada sección */
        .titulo-seccion {
            font-family: 'Merriweather', serif;
            font-size: 24px;
            margin-bottom: 25px;
            color: var(--cafe-marron);
            border-bottom: 2px solid #e7e5e4;
            padding-bottom: 8px;
        }

        /* ==========================================
           BOTONES DE ACCESO DIRECTO A CATEGORÍAS
           ========================================== */
        .panel-categorias {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
            gap: 20px;
            margin-bottom: 45px;
        }

        /* Estilo de botón/tarjeta para navegar a cada archivo HTML de categoría */
        .btn-categoria-card {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            background-color: var(--blanco);
            border: 2px solid var(--borde-tarjeta);
            border-radius: 10px;
            padding: 22px;
            text-decoration: none;
            color: var(--texto-oscuro);
            transition: all 0.3s ease;
            box-shadow: 0 3px 6px rgba(0,0,0,0.03);
        }

        .btn-categoria-card:hover {
            border-color: var(--cafe-marron);
            transform: translateY(-4px);
            box-shadow: 0 8px 16px rgba(44, 24, 16, 0.12);
        }

        .btn-categoria-card h3 {
            font-family: 'Merriweather', serif;
            font-size: 18px;
            color: var(--cafe-marron);
            margin-bottom: 8px;
        }

        .btn-categoria-card p {
            font-size: 13px;
            color: #57534e;
            margin-bottom: 15px;
            line-height: 1.4;
        }

        .btn-categoria-card span {
            display: inline-block;
            background-color: var(--cafe-marron);
            color: #fef08a;
            padding: 8px 14px;
            border-radius: 6px;
            font-size: 13px;
            font-weight: 600;
            text-align: center;
        }

        /* Rejilla de Libros Destacados */
        .grid-libros {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(230px, 1fr));
            gap: 25px;
            margin-bottom: 50px;
        }

        /* Tarjeta individual de Libro */
        .tarjeta-libro {
            background: var(--blanco);
            border: 1px solid var(--borde-tarjeta);
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0,0,0,0.03);
            transition: transform 0.3s, box-shadow 0.3s;
            display: flex;
            flex-direction: column;
        }

        .tarjeta-libro:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 15px rgba(0,0,0,0.1);
        }

        .tarjeta-libro img {
            width: 100%;
            height: 260px;
            object-fit: cover;
        }

        .info-libro {
            padding: 15px;
            display: flex;
            flex-direction: column;
            flex-grow: 1;
            justify-content: space-between;
        }

        .info-libro h3 {
            font-family: 'Merriweather', serif;
            font-size: 16px;
            margin-bottom: 5px;
            color: var(--cafe-marron);
        }

        .info-libro .autor {
            font-size: 13px;
            color: #78716c;
            margin-bottom: 8px;
        }

        /* Etiqueta de categoría convertida en enlace clicable */
        .info-libro .categoria {
            display: inline-block;
            font-size: 11px;
            background-color: #f5f5f4;
            color: #44403c;
            padding: 4px 9px;
            border-radius: 4px;
            margin-bottom: 12px;
            width: fit-content;
            text-decoration: none;
            font-weight: 600;
            transition: background 0.2s, color 0.2s;
        }

        .info-libro .categoria:hover {
            background-color: var(--cafe-marron);
            color: #fef08a;
        }

        .info-libro .precio {
            font-size: 18px;
            font-weight: 700;
            color: #9a3412;
            margin-bottom: 12px;
        }

        .acciones-libro {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .btn-agregar-carrito {
            display: block;
            width: 100%;
            background-color: var(--cafe-marron);
            color: white;
            border: none;
            padding: 10px;
            border-radius: 6px;
            font-weight: 600;
            font-size: 14px;
            cursor: pointer;
            transition: background 0.2s;
        }

        .btn-agregar-carrito:hover {
            background-color: #441a0e;
        }

        .btn-comprar {
            display: block;
            width: 100%;
            background-color: #f5f5f4;
            color: var(--cafe-marron);
            border: 1px solid #d6d3d1;
            text-align: center;
            padding: 8px;
            text-decoration: none;
            border-radius: 6px;
            font-weight: 600;
            font-size: 13px;
            transition: background 0.2s;
        }

        .btn-comprar:hover {
            background-color: #e7e5e4;
        }

        /* ==========================================
           SECCIÓN DE FORMULARIOS (LOGIN Y REGISTRO SQL)
           ========================================== */
        .seccion-formularios {
            background-color: var(--blanco);
            padding: 40px;
            border-radius: 12px;
            border: 1px solid var(--borde-tarjeta);
            box-shadow: 0 4px 15px rgba(0,0,0,0.03);
            margin-top: 40px;
        }

        .contenedor-forms {
            display: flex;
            gap: 40px;
            flex-wrap: wrap;
        }

        .form-box {
            flex: 1;
            min-width: 280px;
        }

        .form-box h2 {
            font-family: 'Merriweather', serif;
            font-size: 20px;
            margin-bottom: 20px;
            color: var(--cafe-marron);
        }

        .campo {
            margin-bottom: 15px;
        }

        .campo label {
            display: block;
            font-size: 13px;
            font-weight: 600;
            margin-bottom: 5px;
        }

        .campo input, .campo select {
            width: 100%;
            padding: 10px;
            border: 1px solid #d6d3d1;
            border-radius: 6px;
            outline: none;
            font-size: 14px;
        }

        .campo input:focus, .campo select:focus {
            border-color: var(--cafe-marron);
        }

        .btn-enviar {
            width: 100%;
            padding: 12px;
            background-color: var(--cafe-marron);
            color: white;
            border: none;
            border-radius: 6px;
            font-weight: 700;
            cursor: pointer;
            font-size: 14px;
            transition: background 0.3s;
        }

        .btn-enviar:hover {
            background-color: #441a0e;
        }

        /* ==========================================
           PANEL LATERAL DEL CARRITO Y MODAL DE PAGO
           ========================================== */
        .overlay-oscuro {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.55);
            z-index: 900;
            display: none;
        }

        .overlay-oscuro.activo {
            display: block;
        }

        .panel-carrito {
            position: fixed;
            top: 0;
            right: -420px;
            width: 100%;
            max-width: 400px;
            height: 100vh;
            background: var(--blanco);
            z-index: 1000;
            box-shadow: -4px 0 20px rgba(0, 0, 0, 0.2);
            display: flex;
            flex-direction: column;
            transition: right 0.35s ease;
        }

        .panel-carrito.abierto {
            right: 0;
        }

        .carrito-header {
            background-color: var(--cafe-marron);
            color: var(--blanco);
            padding: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .carrito-header h2 {
            font-family: 'Merriweather', serif;
            font-size: 18px;
            color: #fef08a;
        }

        .btn-cerrar-carrito {
            background: none;
            border: none;
            color: var(--blanco);
            font-size: 24px;
            cursor: pointer;
        }

        .carrito-lista {
            flex-grow: 1;
            overflow-y: auto;
            padding: 20px;
        }

        .carrito-vacio {
            text-align: center;
            color: #78716c;
            margin-top: 60px;
            font-size: 15px;
        }

        .item-carrito {
            display: flex;
            gap: 12px;
            border-bottom: 1px solid var(--borde-tarjeta);
            padding-bottom: 15px;
            margin-bottom: 15px;
            align-items: center;
        }

        .item-carrito img {
            width: 55px;
            height: 75px;
            object-fit: cover;
            border-radius: 4px;
        }

        .item-detalles {
            flex-grow: 1;
        }

        .item-detalles h4 {
            font-size: 14px;
            color: var(--cafe-marron);
            margin-bottom: 4px;
        }

        .item-detalles .item-precio {
            font-size: 13px;
            font-weight: 700;
            color: #9a3412;
            margin-bottom: 8px;
        }

        .controles-cantidad {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .btn-qty {
            width: 26px;
            height: 26px;
            border: 1px solid #d6d3d1;
            background: #f5f5f4;
            border-radius: 4px;
            font-weight: bold;
            cursor: pointer;
        }

        .btn-qty:hover {
            background: #e7e5e4;
        }

        .btn-eliminar-item {
            margin-left: auto;
            background: none;
            border: none;
            color: #dc2626;
            font-size: 12px;
            cursor: pointer;
            text-decoration: underline;
        }

        .carrito-footer {
            padding: 20px;
            background-color: #fafaf9;
            border-top: 1px solid var(--borde-tarjeta);
        }

        .fila-total {
            display: flex;
            justify-content: space-between;
            margin-bottom: 8px;
            font-size: 14px;
        }

        .fila-total.final {
            font-size: 18px;
            font-weight: 700;
            color: var(--cafe-marron);
            border-top: 1px solid #d6d3d1;
            padding-top: 10px;
            margin-top: 10px;
        }

        .btn-proceder-pago {
            width: 100%;
            padding: 13px;
            background-color: var(--verde-exito);
            color: white;
            border: none;
            border-radius: 6px;
            font-size: 15px;
            font-weight: 700;
            cursor: pointer;
            margin-top: 12px;
            transition: background 0.2s;
        }

        .btn-proceder-pago:hover {
            background-color: #166534;
        }

        .btn-proceder-pago:disabled {
            background-color: #a8a29e;
            cursor: not-allowed;
        }

        /* Modal de Pago */
        .modal-pago {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: var(--blanco);
            width: 95%;
            max-width: 480px;
            border-radius: 12px;
            padding: 30px;
            z-index: 1100;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
            display: none;
            max-height: 90vh;
            overflow-y: auto;
        }

        .modal-pago.activo {
            display: block;
        }

        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid var(--borde-tarjeta);
            padding-bottom: 12px;
            margin-bottom: 20px;
        }

        .modal-header h2 {
            font-family: 'Merriweather', serif;
            font-size: 20px;
            color: var(--cafe-marron);
        }

        .fila-doble {
            display: flex;
            gap: 12px;
        }

        .fila-doble .campo {
            flex: 1;
        }

        .recibo-exito {
            text-align: center;
            padding: 15px 0;
            display: none;
        }

        .recibo-exito h3 {
            color: var(--verde-exito);
            font-size: 22px;
            margin-bottom: 10px;
        }

        .folio-caja {
            background-color: #f0fdf4;
            border: 1px dashed var(--verde-exito);
            padding: 12px;
            border-radius: 8px;
            margin: 15px 0;
            font-weight: 700;
            color: var(--cafe-marron);
        }

        .toast-notificacion {
            position: fixed;
            bottom: 25px;
            left: 25px;
            background-color: var(--cafe-marron);
            color: #fef08a;
            padding: 12px 20px;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 600;
            box-shadow: 0 4px 12px rgba(0,0,0,0.2);
            z-index: 1200;
            opacity: 0;
            transform: translateY(20px);
            transition: all 0.3s ease;
            pointer-events: none;
        }

        .toast-notificacion.mostrar {
            opacity: 1;
            transform: translateY(0);
        }

        /* ==========================================
           4. PIE DE PÁGINA (FOOTER)
           ========================================== */
        footer {
background-color: var(--cafe-marron);
            color: white;
            padding: 40px 20px 20px;
            margin-top: 60px;
        }

        .footer-content {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 20px;
        }

        .footer-col h4 {
            font-family: 'Merriweather', serif;
            font-size: 15px;
            margin-bottom: 15px;
            color: #fef08a;
        }

        .footer-col ul {
            list-style: none;
        }

        .footer-col a {
            color: #d6d3d1;
            text-decoration: none;
            font-size: 13px;
            line-height: 2;
        }

        .footer-col a:hover {
            color: white;
        }

        .footer-bottom {
            text-align: center;
            margin-top: 40px;
            padding-top: 20px;
            border-top: 1px solid #441a0e;
            font-size: 12px;
            color: #a8a29e;
        }
    </style>
</head>
<body>

    <!-- ==========================================
         1. ENCABEZADO (HEADER)
         ========================================== -->
    <header>
        <!-- Enlace que recarga o regresa a la página principal -->
        <a href="index.php" class="logo">📖 Lectura Viva</a>
        
        <div class="busqueda">
            <input type="text" placeholder="Buscar título, autor o género...">
        </div>

        <div class="header-acciones">
            <!-- Enlace ancla (#acceso) que desplaza hacia los formularios de cuenta -->
            <div class="user-nav">
                <a href="#acceso">Mi Cuenta / Registro</a>
            </div>

            <!-- Botón que abre el carrito con los productos guardados -->
            <button type="button" class="btn-abrir-carrito" onclick="abrirCarrito()">
                🛒 Carrito <span id="contador-carrito" class="contador-carrito">0</span>
            </button>
        </div>
    </header>

    <!-- ==========================================
         2. BARRA DE NAVEGACIÓN VINCULADA (NAV)
         Cada enlace apunta exactamente al archivo HTML correspondiente
         ========================================== -->
    <nav>
        <ul>
            <!-- Enlace a la página principal -->
            <li><a href="index.php" class="activo">Inicio</a></li>
            
            <!-- Enlace vinculado al archivo novelas.html -->
            <li><a href="novelas.html">Novelas</a></li>
            
            <!-- Enlace vinculado al archivo ciencia_ficcion.html -->
            <li><a href="ciencia_ficcion.html">Ciencia Ficción</a></li>
            
            <!-- Enlace vinculado al archivo desarrollo_personal.html -->
            <li><a href="desarrollo_personal.html">Desarrollo Personal</a></li>
            
            <!-- Enlace directo a la sección de inicio de sesión -->
            <li><a href="#acceso">Iniciar Sesión</a></li>
        </ul>
    </nav>

    <!-- ==========================================
         3. CUERPO PRINCIPAL (MAIN)
         ========================================== -->
    <main>

        <!-- Banner Promocional -->
        <section class="hero-banner">
            <h1>Encuentra tu próxima historia</h1>
            <p>Explora miles de títulos de literatura, desarrollo personal, ciencia ficción y los clásicos más aclamados. Selecciona una categoría para ver su catálogo completo.</p>
        </section>

        <!-- SECCIÓN DE BOTONES PARA IR A CADA CATEGORÍA -->
        <section id="categorias">
            <h2 class="titulo-seccion">Explora por Categoría</h2>

            <div class="panel-categorias">
                <!-- Botón-tarjeta vinculado a novelas.html -->
                <a href="novelas.html" class="btn-categoria-card">
                    <div>
                        <h3>📚 Novelas</h3>
                        <p>Realismo mágico, narrativa contemporánea y grandes obras literarias.</p>
                    </div>
                    <span>Ver catálogo de Novelas →</span>
                </a>

                <!-- Botón-tarjeta vinculado a ciencia_ficcion.html -->
                <a href="ciencia_ficcion.html" class="btn-categoria-card">
                    <div>
                        <h3>🚀 Ciencia Ficción</h3>
                        <p>Mundos distópicos, exploración espacial y futuros tecnológicos.</p>
                    </div>
                    <span>Ver catálogo de Ciencia Ficción →</span>
                </a>

                <!-- Botón-tarjeta vinculado a desarrollo_personal.html -->
                <a href="desarrollo_personal.html" class="btn-categoria-card">
                    <div>
                        <h3>🧠 Desarrollo Personal</h3>
                        <p>Hábitos productivos, psicología aplicada y crecimiento financiero.</p>
                    </div>
                    <span>Ver catálogo de Desarrollo Personal →</span>
                </a>
            </div>
        </section>

        <!-- SECCIÓN DE LIBROS DESTACADOS EN PORTADA -->
        <section id="libros">
            <h2 class="titulo-seccion">Libros Destacados</h2>

            <div class="grid-libros">
                <!-- Libro 1 (ID 1) -->
                <article class="tarjeta-libro">
                    <img src="https://images.unsplash.com/photo-1544947950-fa07a98d237f?w=500" alt="Cien Años de Soledad">
                    <div class="info-libro">
                        <div>
                            <h3>Cien Años de Soledad</h3>
                            <p class="autor">Gabriel García Márquez</p>
                            <a href="novelas.html" class="categoria">Novela</a>
                        </div>
                        <div>
                            <p class="precio">$349.00 MXN</p>
                            <div class="acciones-libro">
                                <button type="button" class="btn-agregar-carrito" 
                                    onclick="agregarAlCarrito(1, 'Cien Años de Soledad', 349.00, 'https://images.unsplash.com/photo-1544947950-fa07a98d237f?w=500')">
                                    🛒 Agregar al Carrito
                                </button>
                                <a href="novelas.html" class="btn-comprar">Ver en Novelas</a>
                            </div>
                        </div>
                    </div>
                </article>

                <!-- Libro 2 (ID 2) -->
                <article class="tarjeta-libro">
                    <img src="https://images.unsplash.com/photo-1512820790803-83ca734da794?w=500" alt="1984">
                    <div class="info-libro">
                        <div>
                            <h3>1984</h3>
                            <p class="autor">George Orwell</p>
                            <a href="ciencia_ficcion.html" class="categoria">Ciencia Ficción</a>
                        </div>
                        <div>
                            <p class="precio">$299.00 MXN</p>
                            <div class="acciones-libro">
                                <button type="button" class="btn-agregar-carrito" 
                                    onclick="agregarAlCarrito(2, '1984', 299.00, 'https://images.unsplash.com/photo-1512820790803-83ca734da794?w=500')">
                                    🛒 Agregar al Carrito
                                </button>
                                <a href="ciencia_ficcion.html" class="btn-comprar">Ver en Ciencia Ficción</a>
                            </div>
                        </div>
                    </div>
                </article>

                <!-- Libro 3 (ID 3) -->
                <article class="tarjeta-libro">
                    <img src="https://images.unsplash.com/photo-1543002588-bfa74002ed7e?w=500" alt="El Principito">
                    <div class="info-libro">
                        <div>
                            <h3>El Principito</h3>
                            <p class="autor">Antoine de Saint-Exupéry</p>
                            <a href="novelas.html" class="categoria">Novela / Clásicos</a>
                        </div>
                        <div>
                            <p class="precio">$199.00 MXN</p>
                            <div class="acciones-libro">
                                <button type="button" class="btn-agregar-carrito" 
                                    onclick="agregarAlCarrito(3, 'El Principito', 199.00, 'https://images.unsplash.com/photo-1543002588-bfa74002ed7e?w=500')">
                                    🛒 Agregar al Carrito
                                </button>
                                <a href="novelas.html" class="btn-comprar">Ver en Novelas</a>
                            </div>
                        </div>
                    </div>
                </article>

                <!-- Libro 4 (ID 4) -->
                <article class="tarjeta-libro">
                    <img src="https://images.unsplash.com/photo-1589829085413-56de8ae18c73?w=500" alt="Hábitos Atómicos">
                    <div class="info-libro">
                        <div>
                            <h3>Hábitos Atómicos</h3>
                            <p class="autor">James Clear</p>
                            <a href="desarrollo_personal.html" class="categoria">Desarrollo Personal</a>
                        </div>
                        <div>
                            <p class="precio">$389.00 MXN</p>
                            <div class="acciones-libro">
                                <button type="button" class="btn-agregar-carrito" 
                                    onclick="agregarAlCarrito(4, 'Hábitos Atómicos', 389.00, 'https://images.unsplash.com/photo-1589829085413-56de8ae18c73?w=500')">
                                    🛒 Agregar al Carrito
                                </button>
                                <a href="desarrollo_personal.html" class="btn-comprar">Ver en Desarrollo Personal</a>
                            </div>
                        </div>
                    </div>
                </article>
            </div>
        </section>

        <!-- SECCIÓN DE ACCESO: FORMULARIO INICIO DE SESIÓN Y REGISTRO CONECTADOS A SQL -->
        <section id="acceso" class="seccion-formularios">
            <h2 class="titulo-seccion">Cuenta de Lector</h2>

            <div class="contenedor-forms">
                
                <!-- FORMULARIO 1: INICIO DE SESIÓN -->
                <div class="form-box">
                    <h2>Iniciar Sesión</h2>
                    <!-- Envía los datos por método POST hacia login.php -->
                    <form action="login.php" method="POST">
                        <div class="campo">
                            <label for="login-email">Correo Electrónico</label>
                            <input type="email" id="login-email" name="email" placeholder="correo@ejemplo.com" required>
                        </div>
                        <div class="campo">
                            <label for="login-password">Contraseña</label>
                            <input type="password" id="login-password" name="password" placeholder="Tu contraseña" required>
                        </div>
                        <button type="submit" class="btn-enviar">Ingresar a la Librería</button>
                    </form>
                </div>

                <!-- FORMULARIO 2: REGISTRO DE USUARIOS -->
                <div class="form-box">
                    <h2>Registrarse como Lector</h2>
                    <!-- Envía los datos por método POST hacia registro.php para guardarlos en MySQL -->
                    <form action="registro.php" method="POST">
                        <div class="campo">
                            <label for="reg-nombre">Nombre Completo</label>
                            <input type="text" id="reg-nombre" name="nombre" placeholder="Ingresa tu nombre" required>
                        </div>
                        <div class="campo">
                            <label for="reg-email">Correo Electrónico</label>
                            <input type="email" id="reg-email" name="email" placeholder="correo@ejemplo.com" required>
                        </div>
                        <div class="campo">
                            <label for="reg-password">Contraseña</label>
                            <input type="password" id="reg-password" name="password" placeholder="Crea una contraseña" required>
                        </div>
                        <button type="submit" class="btn-enviar">Crear Cuenta</button>
                    </form>
                </div>

            </div>
        </section>

    </main>

    <!-- ==========================================
         PANEL LATERAL DEL CARRITO Y MODAL DE PAGO
         ========================================== -->
    <div id="overlay-oscuro" class="overlay-oscuro" onclick="cerrarTodo()"></div>

    <aside id="panel-carrito" class="panel-carrito">
        <div class="carrito-header">
            <h2>🛒 Tu Carrito de Libros</h2>
            <button type="button" class="btn-cerrar-carrito" onclick="cerrarTodo()">&times;</button>
        </div>

        <div id="carrito-lista" class="carrito-lista">
            <p class="carrito-vacio">Tu carrito está vacío. ¡Agrega un libro para comenzar!</p>
        </div>

        <div class="carrito-footer">
            <div class="fila-total">
                <span>Subtotal:</span>
                <span id="carrito-subtotal">$0.00 MXN</span>
            </div>
            <div class="fila-total">
                <span>Envío:</span>
                <span id="carrito-envio">$0.00 MXN</span>
            </div>
            <div class="fila-total final">
                <span>Total a Pagar:</span>
                <span id="carrito-total">$0.00 MXN</span>
            </div>

            <button type="button" id="btn-proceder-pago" class="btn-proceder-pago" onclick="abrirModalPago()" disabled>
                Proceder al Pago
            </button>
        </div>
    </aside>

    <div id="modal-pago" class="modal-pago">
        <div class="modal-header">
            <h2>💳 Finalizar Compra</h2>
            <button type="button" class="btn-cerrar-carrito" style="color: #1c1917;" onclick="cerrarTodo()">&times;</button>
        </div>

        <form id="form-pago" onsubmit="procesarPago(event)">
            <div class="campo">
                <label for="pago-nombre">Nombre del Titular / Destinatario</label>
                <input type="text" id="pago-nombre" placeholder="Ej. Ana María López" required>
            </div>

            <div class="campo">
                <label for="pago-direccion">Dirección de Envío Completa</label>
                <input type="text" id="pago-direccion" placeholder="Calle, Número, Colonia y Ciudad" required>
            </div>

            <div class="campo">
                <label for="pago-metodo">Método de Pago</label>
                <select id="pago-metodo">
                    <option value="tarjeta">Tarjeta de Crédito / Débito</option>
                    <option value="paypal">PayPal</option>
                    <option value="transferencia">Transferencia SPEI</option>
                </select>
            </div>

            <div class="campo">
                <label for="pago-tarjeta">Número de Tarjeta (16 dígitos)</label>
                <input type="text" id="pago-tarjeta" maxlength="19" placeholder="4555 1234 5678 9010" required>
            </div>

            <div class="fila-doble">
                <div class="campo">
                    <label for="pago-exp">Expiración (MM/AA)</label>
                    <input type="text" id="pago-exp" maxlength="5" placeholder="08/29" required>
                </div>
                <div class="campo">
                    <label for="pago-cvv">Código CVV</label>
                    <input type="password" id="pago-cvv" maxlength="4" placeholder="123" required>
                </div>
            </div>

            <div class="fila-total final" style="margin-bottom: 15px;">
                <span>Total a Cobrar:</span>
                <span id="modal-total-pagar">$0.00 MXN</span>
            </div>

            <button type="submit" id="btn-confirmar-pago" class="btn-proceder-pago">
                Confirmar y Pagar Ahora
            </button>
        </form>

        <div id="recibo-exito" class="recibo-exito">
            <h3>✅ ¡Compra Realizada con Éxito!</h3>
            <p>Gracias por comprar en <strong>Librería Lectura Viva</strong>. Tu pedido ha sido registrado.</p>
            <div class="folio-caja">
                Folio de Pedido: #<span id="numero-folio">000001</span>
            </div>
            <p style="font-size: 13px; color: #57534e; margin-bottom: 20px;">
                Recibirás los detalles de rastreo en tu correo electrónico.
            </p>
            <button type="button" class="btn-enviar" onclick="cerrarTodo()">Seguir Explorando Libros</button>
        </div>
    </div>

    <div id="toast-notificacion" class="toast-notificacion">Libro agregado al carrito</div>

    <!-- ==========================================
         4. PIE DE PÁGINA (FOOTER)
         ========================================== -->
    <footer>
        <div class="footer-content">
            <div class="footer-col">
                <h4>Categorías</h4>
                <ul>
                    <li><a href="novelas.html">Novelas</a></li>
                    <li><a href="ciencia_ficcion.html">Ciencia Ficción</a></li>
                    <li><a href="desarrollo_personal.html">Desarrollo Personal</a></li>
                </ul>
            </div>
            <div class="footer-col">
                <h4>Servicio al Cliente</h4>
                <ul>
                    <li><a href="#">Estado de tu envío</a></li>
                    <li><a href="#">Términos y condiciones</a></li>
                    <li><a href="#">Políticas de devolución</a></li>
                </ul>
            </div>
            <div class="footer-col">
                <h4>Acerca de Lectura Viva</h4>
                <ul>
                    <li><a href="#">Quiénes Somos</a></li>
                    <li><a href="#">Eventos y Presentaciones</a></li>
                    <li><a href="#">Blog Literario</a></li>
                </ul>
            </div>
        </div>

        <div class="footer-bottom">
            <p>&copy; 2026 Librería Lectura Viva S.A. Todos los derechos reservados. Sistema con conexión a Base de Datos SQL.</p>
        </div>
    </footer>

    <!-- ==========================================
         LÓGICA JAVASCRIPT DEL CARRITO Y PAGO
         ========================================== -->
    <script>
        // Lee los libros guardados desde cualquier categoría (novelas.html, ciencia_ficcion.html, etc.)
        let carrito = JSON.parse(localStorage.getItem('carrito_lectura_viva')) || [];

        document.addEventListener('DOMContentLoaded', () => {
            renderizarCarrito();
        });

        function agregarAlCarrito(id, titulo, precio, imagen) {
            const libroExistente = carrito.find(item => item.id === id);
            if (libroExistente) {
                libroExistente.cantidad += 1;
            } else {
                carrito.push({ id, titulo, precio, imagen, cantidad: 1 });
            }
            guardarYActualizar();
            mostrarNotificacion(`"${titulo}" agregado al carrito`);
        }

        function cambiarCantidad(id, cambio) {
            const libro = carrito.find(item => item.id === id);
            if (!libro) return;
            libro.cantidad += cambio;
            if (libro.cantidad <= 0) {
                eliminarDelCarrito(id);
            } else {
                guardarYActualizar();
            }
        }

        function eliminarDelCarrito(id) {
   const contenedorLista = document.getElementById('carrito-lista');
            const badgeContador = document.getElementById('contador-carrito');
            const elSubtotal = document.getElementById('carrito-subtotal');
            const elEnvio = document.getElementById('carrito-envio');
            const elTotal = document.getElementById('carrito-total');
            const btnPagar = document.getElementById('btn-proceder-pago');

            const totalEjemplares = carrito.reduce((acum, item) => acum + item.cantidad, 0);
            badgeContador.textContent = totalEjemplares;

            if (carrito.length === 0) {
                contenedorLista.innerHTML = '<p class="carrito-vacio">Tu carrito está vacío. ¡Agrega un libro para comenzar!</p>';
                elSubtotal.textContent = '$0.00 MXN';
                elEnvio.textContent = '$0.00 MXN';
                elTotal.textContent = '$0.00 MXN';
                btnPagar.disabled = true;
                return;
            }

            let htmlItems = '';
            let subtotal = 0;

            carrito.forEach(item => {
                const totalItem = item.precio * item.cantidad;
                subtotal += totalItem;
                htmlItems += `
                    <div class="item-carrito">
                        <img src="${item.imagen}" alt="${item.titulo}">
                        <div class="item-detalles">
                            <h4>${item.titulo}</h4>
                            <p class="item-precio">$${totalItem.toFixed(2)} MXN</p>
                            <div class="controles-cantidad">
                                <button type="button" class="btn-qty" onclick="cambiarCantidad(${item.id}, -1)">-</button>
                                <span>${item.cantidad}</span>
                                <button type="button" class="btn-qty" onclick="cambiarCantidad(${item.id}, 1)">+</button>
                                <button type="button" class="btn-eliminar-item" onclick="eliminarDelCarrito(${item.id})">Eliminar</button>
                            </div>
                        </div>
                    </div>
                `;
            });

            contenedorLista.innerHTML = htmlItems;

            const costoEnvio = subtotal >= 500 ? 0 : 59;
            const totalFinal = subtotal + costoEnvio;

            elSubtotal.textContent = `$${subtotal.toFixed(2)} MXN`;
            elEnvio.textContent = costoEnvio === 0 ? 'GRATIS' : `$${costoEnvio.toFixed(2)} MXN`;
            elTotal.textContent = `$${totalFinal.toFixed(2)} MXN`;
            btnPagar.disabled = false;
        }

        function abrirCarrito() {
            document.getElementById('panel-carrito').classList.add('abierto');
            document.getElementById('overlay-oscuro').classList.add('activo');
        }

        function abrirModalPago() {
            document.getElementById('panel-carrito').classList.remove('abierto');
            document.getElementById('modal-pago').classList.add('activo');
            document.getElementById('overlay-oscuro').classList.add('activo');
            document.getElementById('form-pago').style.display = 'block';
            document.getElementById('recibo-exito').style.display = 'none';
            document.getElementById('modal-total-pagar').textContent = document.getElementById('carrito-total').textContent;
        }

        function cerrarTodo() {
            document.getElementById('panel-carrito').classList.remove('abierto');
            document.getElementById('modal-pago').classList.remove('activo');
            document.getElementById('overlay-oscuro').classList.remove('activo');
        }

        function procesarPago(evento) {
            evento.preventDefault();
            const btnConfirmar = document.getElementById('btn-confirmar-pago');
            btnConfirmar.textContent = "Procesando pago...";
            btnConfirmar.disabled = true;

            const subtotal = carrito.reduce((acum, item) => acum + (item.precio * item.cantidad), 0);
            const envio = subtotal >= 500 ? 0 : 59;
            const totalFinal = subtotal + envio;

            const datosPedido = {
                cliente: document.getElementById('pago-nombre').value,
                direccion: document.getElementById('pago-direccion').value,
                metodo: document.getElementById('pago-metodo').value,
                total: totalFinal,
                items: carrito
            };

            fetch('procesar_compra.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify(datosPedido)
            })
            .then(respuesta => respuesta.json())
            .then(data => {
                finalizarVistaCompra(data.folio || Math.floor(100000 + Math.random() * 900000));
            })
            .catch(() => {
                finalizarVistaCompra(Math.floor(100000 + Math.random() * 900000));
            })
            .finally(() => {
                btnConfirmar.textContent = "Confirmar y Pagar Ahora";
                btnConfirmar.disabled = false;
            });
        }

        function finalizarVistaCompra(folio) {
            carrito = [];
            guardarYActualizar();
            document.getElementById('form-pago').reset();
            document.getElementById('form-pago').style.display = 'none';
            document.getElementById('numero-folio').textContent = folio;
            document.getElementById('recibo-exito').style.display = 'block';
        }

        function mostrarNotificacion(mensaje) {
            const toast = document.getElementById('toast-notificacion');
            toast.textContent = mensaje;
            toast.classList.add('mostrar');
            setTimeout(() => toast.classList.remove('mostrar'), 2500);
        }
    </script>

</body>
</html>
