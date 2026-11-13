<?php
session_start();
require_once 'conexion.php';

$mensaje_alerta = "";
$tipo_alerta    = "";

// 1. PROCESAR REGISTRO DE NUEVO USUARIO
if (isset($_POST['btn_registro'])) {
    $nombre   = trim($_POST['reg_nombre']);
    $correo   = trim($_POST['reg_correo']);
    $password = password_hash($_POST['reg_password'], PASSWORD_DEFAULT);

    $stmtCheck = $conn->prepare("SELECT id FROM usuarios WHERE correo = ?");
    $stmtCheck->bind_param("s", $correo);
    $stmtCheck->execute();
    $stmtCheck->store_result();

    if ($stmtCheck->num_rows > 0) {
        $mensaje_alerta = "Este correo electrónico ya está registrado.";
        $tipo_alerta    = "error";
    } else {
        $stmtInsert = $conn->prepare("INSERT INTO usuarios (nombre, correo, password) VALUES (?, ?, ?)");
        $stmtInsert->bind_param("sss", $nombre, $correo, $password);
        if ($stmtInsert->execute()) {
            $mensaje_alerta = "¡Cuenta creada con éxito! Ahora puedes iniciar sesión.";
            $tipo_alerta    = "exito";
        } else {
            $mensaje_alerta = "Ocurrió un error al registrar tu cuenta.";
            $tipo_alerta    = "error";
        }
        $stmtInsert->close();
    }
    $stmtCheck->close();
}

// 2. PROCESAR INICIO DE SESIÓN
if (isset($_POST['btn_login'])) {
    $correo   = trim($_POST['log_correo']);
    $password = $_POST['log_password'];

    $stmtLogin = $conn->prepare("SELECT id, nombre, password FROM usuarios WHERE correo = ?");
    $stmtLogin->bind_param("s", $correo);
    $stmtLogin->execute();
    $resultado = $stmtLogin->get_result();

    if ($fila = $resultado->fetch_assoc()) {
        if (password_verify($password, $fila['password'])) {
            $_SESSION['usuario_id']     = $fila['id'];
            $_SESSION['usuario_nombre'] = $fila['nombre'];
            $mensaje_alerta = "Bienvenido de nuevo, " . htmlspecialchars($fila['nombre']) . ".";
            $tipo_alerta    = "exito";
        } else {
            $mensaje_alerta = "Contraseña incorrecta.";
            $tipo_alerta    = "error";
        }
    } else {
        $mensaje_alerta = "No existe una cuenta registrada con ese correo.";
        $tipo_alerta    = "error";
    }
    $stmtLogin->close();
}

// 3. CERRAR SESIÓN
if (isset($_GET['cerrar_sesion'])) {
    session_destroy();
    header("Location: index.php");
    exit;
}

// 4. CONSULTAR 4 LIBROS DESTACADOS DESDE LA BASE DE DATOS
$libros_destacados = $conn->query("SELECT * FROM libros WHERE id IN (1, 2, 3, 4) ORDER BY id ASC");
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio - Librería Lectura Viva</title>
    <link href="https://fonts.googleapis.com/css2?family=Merriweather:wght@400;700&family=Inter:wght@400;600;700&display=swap" rel="stylesheet">

    <style>
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

        * { box-sizing: border-box; margin: 0; padding: 0; font-family: 'Inter', sans-serif; }
        body { background-color: var(--crema-fondo); color: var(--texto-oscuro); }

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

        .logo { font-family: 'Merriweather', serif; font-size: 24px; font-weight: 700; color: #fef08a; text-decoration: none; }
        .busqueda input { padding: 9px 18px; border-radius: 20px; border: none; outline: none; width: 280px; font-size: 14px; }
        .header-acciones { display: flex; align-items: center; gap: 12px; }
        .btn-cuenta { color: var(--blanco); text-decoration: none; font-weight: 600; font-size: 14px; background-color: var(--cafe-hover); padding: 9px 16px; border-radius: 6px; }
        .btn-abrir-carrito { background-color: #fef08a; color: var(--cafe-marron); border: none; padding: 9px 16px; border-radius: 6px; font-weight: 700; font-size: 14px; cursor: pointer; display: flex; align-items: center; gap: 8px; }
        .contador-carrito { background-color: var(--cafe-marron); color: #fef08a; padding: 2px 8px; border-radius: 12px; font-size: 12px; }

        /* Barra de navegación sin anclajes */
        nav { background-color: var(--blanco); padding: 14px 40px; border-bottom: 1px solid var(--borde-tarjeta); position: sticky; top: 0; z-index: 100; }
        nav ul { list-style: none; display: flex; justify-content: center; flex-wrap: wrap; gap: 35px; }
        nav a { text-decoration: none; color: var(--texto-oscuro); font-weight: 600; font-size: 14px; }
        nav a:hover, nav a.activo { color: var(--acento-dorado); border-bottom: 2px solid var(--acento-dorado); padding-bottom: 4px; }

        main { max-width: 1200px; margin: 30px auto; padding: 0 20px; }

        /* Banner de Introducción del Sitio */
        .hero-banner {
            background: linear-gradient(rgba(44, 24, 16, 0.85), rgba(44, 24, 16, 0.85)), url('https://images.unsplash.com/photo-1507842217343-583bb7270b66?w=1200') center/cover;
            padding: 50px 40px;
            border-radius: 12px;
            color: var(--blanco);
            margin-bottom: 35px;
        }
        .hero-banner h1 { font-family: 'Merriweather', serif; font-size: 34px; margin-bottom: 12px; color: #fef08a; }
        .hero-banner p { font-size: 16px; line-height: 1.7; max-width: 820px; color: #f5f5f4; }

        .alerta { padding: 14px 20px; border-radius: 8px; margin-bottom: 25px; font-weight: 600; font-size: 14px; }
        .alerta.exito { background-color: #dcfce7; color: #166534; border: 1px solid #86efac; }
        .alerta.error { background-color: #fee2e2; color: #991b1b; border: 1px solid #fca5a5; }

        .titulo-seccion { font-family: 'Merriweather', serif; font-size: 24px; margin-bottom: 25px; color: var(--cafe-marron); border-bottom: 2px solid #e7e5e4; padding-bottom: 8px; }

        .grid-libros { display: grid; grid-template-columns: repeat(auto-fit, minmax(230px, 1fr)); gap: 25px; margin-bottom: 50px; }
        .tarjeta-libro { background: var(--blanco); border: 1px solid var(--borde-tarjeta); border-radius: 8px; overflow: hidden; box-shadow: 0 4px 6px rgba(0,0,0,0.03); transition: transform 0.3s; display: flex; flex-direction: column; }
        .tarjeta-libro:hover { transform: translateY(-5px); box-shadow: 0 8px 15px rgba(0,0,0,0.1); }
        .tarjeta-libro img { width: 100%; height: 250px; object-fit: cover; }
        .info-libro { padding: 15px; display: flex; flex-direction: column; flex-grow: 1; justify-content: space-between; }
        .info-libro h3 { font-family: 'Merriweather', serif; font-size: 16px; margin-bottom: 5px; color: var(--cafe-marron); }
        .info-libro .autor { font-size: 13px; color: #78716c; margin-bottom: 8px; }
        .info-libro .categoria { display: inline-block; font-size: 11px; background-color: #fef3c7; color: #92400e; padding: 4px 9px; border-radius: 4px; margin-bottom: 12px; font-weight: 600; }
        .info-libro .precio { font-size: 18px; font-weight: 700; color: #9a3412; margin-bottom: 12px; }
        .btn-agregar-carrito { display: block; width: 100%; background-color: var(--cafe-marron); color: white; border: none; padding: 11px; border-radius: 6px; font-weight: 600; font-size: 14px; cursor: pointer; }
        .btn-agregar-carrito:hover { background-color: var(--cafe-hover); }

        /* Sección de Formularios PHP (Login y Registro) */
        .grid-formularios { display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 30px; margin-top: 20px; }
        .caja-form { background: var(--blanco); padding: 28px; border-radius: 10px; border: 1px solid var(--borde-tarjeta); box-shadow: 0 4px 6px rgba(0,0,0,0.03); }
        .caja-form h3 { font-family: 'Merriweather', serif; color: var(--cafe-marron); margin-bottom: 18px; font-size: 19px; }

        /* Carrito y Modal */
        .overlay-oscuro { position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.55); z-index: 900; display: none; }
        .overlay-oscuro.activo { display: block; }
        .panel-carrito { position: fixed; top: 0; right: -420px; width: 100%; max-width: 400px; height: 100vh; background: var(--blanco); z-index: 1000; box-shadow: -4px 0 20px rgba(0,0,0,0.2); display: flex; flex-direction: column; transition: right 0.35s ease; }
        .panel-carrito.abierto { right: 0; }
        .carrito-header { background-color: var(--cafe-marron); color: var(--blanco); padding: 20px; display: flex; justify-content: space-between; align-items: center; }
        .carrito-header h2 { font-family: 'Merriweather', serif; font-size: 18px; color: #fef08a; }
        .btn-cerrar-carrito { background: none; border: none; color: var(--blanco); font-size: 24px; cursor: pointer; }
        .carrito-lista { flex-grow: 1; overflow-y: auto; padding: 20px; }
        .carrito-vacio { text-align: center; color: #78716c; margin-top: 60px; font-size: 15px; }
        .item-carrito { display: flex; gap: 12px; border-bottom: 1px solid var(--borde-tarjeta); padding-bottom: 15px; margin-bottom: 15px; align-items: center; }
        .item-carrito img { width: 55px; height: 75px; object-fit: cover; border-radius: 4px; }
        .item-detalles { flex-grow: 1; }
        .item-detalles h4 { font-size: 14px; color: var(--cafe-marron); margin-bottom: 4px; }
        .item-detalles .item-precio { font-size: 13px; font-weight: 700; color: #9a3412; margin-bottom: 8px; }
        .controles-cantidad { display: flex; align-items: center; gap: 8px; }
        .btn-qty { width: 26px; height: 26px; border: 1px solid #d6d3d1; background: #f5f5f4; border-radius: 4px; font-weight: bold; cursor: pointer; }
        .btn-eliminar-item { margin-left: auto; background: none; border: none; color: #dc2626; font-size: 12px; cursor: pointer; text-decoration: underline; }
        .carrito-footer { padding: 20px; background-color: #fafaf9; border-top: 1px solid var(--borde-tarjeta); }
        .fila-total { display: flex; justify-content: space-between; margin-bottom: 8px; font-size: 14px; }
        .fila-total.final { font-size: 18px; font-weight: 700; color: var(--cafe-marron); border-top: 1px solid #d6d3d1; padding-top: 10px; margin-top: 10px; }
        .btn-proceder-pago { width: 100%; padding: 13px; background-color: var(--verde-exito); color: white; border: none; border-radius: 6px; font-size: 15px; font-weight: 700; cursor: pointer; margin-top: 12px; }
        .btn-proceder-pago:disabled { background-color: #a8a29e; cursor: not-allowed; }

        .modal-pago { position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); background: var(--blanco); width: 95%; max-width: 480px; border-radius: 12px; padding: 30px; z-index: 1100; box-shadow: 0 10px 30px rgba(0,0,0,0.3); display: none; max-height: 90vh; overflow-y: auto; }
        .modal-pago.activo { display: block; }
        .modal-header { display: flex; justify-content: space-between; align-items: center; border-bottom: 1px solid var(--borde-tarjeta); padding-bottom: 12px; margin-bottom: 20px; }
        .campo { margin-bottom: 15px; }
        .campo label { display: block; font-size: 13px; font-weight: 600; margin-bottom: 5px; }
        .campo input, .campo select { width: 100%; padding: 10px; border: 1px solid #d6d3d1; border-radius: 6px; font-size: 14px; }
        .fila-doble { display: flex; gap: 12px; }
        .fila-doble .campo { flex: 1; }
        .btn-enviar { width: 100%; padding: 12px; background-color: var(--cafe-marron); color: white; border: none; border-radius: 6px; font-weight: 700; cursor: pointer; }
        .btn-enviar:hover { background-color: var(--cafe-hover); }
        .recibo-exito { text-align: center; padding: 15px 0; display: none; }
        .folio-caja { background-color: #f0fdf4; border: 1px dashed var(--verde-exito); padding: 12px; border-radius: 8px; margin: 15px 0; font-weight: 700; }
        .toast-notificacion { position: fixed; bottom: 25px; left: 25px; background-color: var(--cafe-marron); color: #fef08a; padding: 12px 20px; border-radius: 8px; font-size: 14px; font-weight: 600; z-index: 1200; opacity: 0; transition: all 0.3s ease; pointer-events: none; }
        .toast-notificacion.mostrar { opacity: 1; }

        /* Footer */
        footer { background-color: var(--cafe-marron); color: white; padding: 40px 20px 20px; margin-top: 60px; }
        .footer-content { max-width: 1200px; margin: 0 auto; display: flex; justify-content: space-between; flex-wrap: wrap; gap: 25px; }
        .footer-col h4 { font-family: 'Merriweather', serif; font-size: 15px; margin-bottom: 15px; color: #fef08a; }
        .footer-col ul { list-style: none; }
        .footer-col a { color: #d6d3d1; text-decoration: none; font-size: 13px; line-height: 2; }
        .footer-bottom { text-align: center; margin-top: 35px; padding-top: 20px; border-top: 1px solid #441a0e; font-size: 12px; color: #a8a29e; }
    </style>
</head>
<body>

    <header>
        <a href="index.php" class="logo">📖 Lectura Viva</a>
        <div class="busqueda">
            <input type="text" placeholder="Buscar libros, autores o ISBN...">
        </div>
        <div class="header-acciones">
            <?php if (isset($_SESSION['usuario_nombre'])): ?>
                <span style="font-size: 14px; color: #fef08a;">Hola, <strong><?php echo htmlspecialchars($_SESSION['usuario_nombre']); ?></strong></span>
                <a href="index.php?cerrar_sesion=1" class="btn-cuenta">Cerrar Sesión</a>
            <?php else: ?>
                <span class="btn-cuenta">Invitado</span>
            <?php endif; ?>

            <button type="button" class="btn-abrir-carrito" onclick="abrirCarrito()">
                🛒 Carrito <span id="contador-carrito" class="contador-carrito">0</span>
            </button>
        </div>
    </header>

    <!-- BARRA DE NAVEGACIÓN (Enlaces directos a documentos HTML/PHP sin anclajes) -->
    <nav>
        <ul>
            <li><a href="index.php" class="activo">Inicio</a></li>
            <li><a href="novelas.html">Novelas</a></li>
            <li><a href="ciencia_ficcion.html">Ciencia Ficción</a></li>
            <li><a href="desarrollo_personal.html">Desarrollo Personal</a></li>
        </ul>
    </nav>

    <main>
        <?php if ($mensaje_alerta !== ""): ?>
            <div class="alerta <?php echo $tipo_alerta; ?>">
                <?php echo $mensaje_alerta; ?>
            </div>
        <?php endif; ?>

        <!-- INTRODUCCIÓN DEL SITIO WEB -->
        <section class="hero-banner">
            <h1>Bienvenido a Librería Lectura Viva</h1>
            <p>
                Somos una librería digital dedicada a acercar el conocimiento y las grandes historias a todo tipo de lectores. 
                En nuestra plataforma podrás explorar catálogos especializados en <strong>Novelas</strong>, <strong>Ciencia Ficción</strong> y 
                <strong>Desarrollo Personal</strong>, agregar tus ejemplares favoritos al carrito de compras y realizar pedidos en línea 
                de forma rápida y segura.
            </p>
        </section>

        <!-- LIBROS DESTACADOS CARGADOS DESDE MYSQL -->
        <section>
            <h2 class="titulo-seccion">Libros Destacados de la Semana</h2>
            <div class="grid-libros">
                <?php if ($libros_destacados && $libros_destacados->num_rows > 0): ?>
                    <?php while ($libro = $libros_destacados->fetch_assoc()): ?>
                        <article class="tarjeta-libro">
                            <img src="<?php echo htmlspecialchars($libro['imagen']); ?>" alt="<?php echo htmlspecialchars($libro['titulo']); ?>">
                            <div class="info-libro">
                                <div>
                                    <h3><?php echo htmlspecialchars($libro['titulo']); ?></h3>
                                    <p class="autor"><?php echo htmlspecialchars($libro['autor']); ?></p>
                                    <span class="categoria"><?php echo htmlspecialchars($libro['categoria']); ?></span>
                                </div>
                                <div>
                                    <p class="precio">$<?php echo number_format($libro['precio'], 2); ?> MXN</p>
                                    <button type="button" class="btn-agregar-carrito" 
                                        onclick="agregarAlCarrito(<?php echo $libro['id']; ?>, '<?php echo addslashes($libro['titulo']); ?>', <?php echo $libro['precio']; ?>, '<?php echo htmlspecialchars($libro['imagen']); ?>')">
                                        🛒 Agregar al Carrito
                                    </button>
                                </div>
                            </div>
                        </article>
                    <?php endwhile; ?>
                <?php endif; ?>
            </div>
        </section>

        <!-- FORMULARIOS DE ACCESO Y REGISTRO EN PHP -->
        <section>
            <h2 class="titulo-seccion">Acceso de Lectores</h2>
            <div class="grid-formularios">
                <!-- Formulario de Inicio de Sesión -->
                <div class="caja-form">
                    <h3>Iniciar Sesión</h3>
                    <form method="POST" action="index.php">
                        <div class="campo">
                            <label for="log_correo">Correo Electrónico</label>
                            <input type="email" id="log_correo" name="log_correo" placeholder="lector@ejemplo.com" required>
                        </div>
                        <div class="campo">
                            <label for="log_password">Contraseña</label>
                            <input type="password" id="log_password" name="log_password" placeholder="••••••••" required>
                        </div>
                        <button type="submit" name="btn_login" class="btn-enviar">Entrar a mi Cuenta</button>
                    </form>
                </div>

                <!-- Formulario de Registro -->
                <div class="caja-form">
                    <h3>Crear Cuenta Nueva</h3>
                    <form method="POST" action="index.php">
                        <div class="campo">
                            <label for="reg_nombre">Nombre Completo</label>
                            <input type="text" id="reg_nombre" name="reg_nombre" placeholder="Ej. Carlos Mendoza" required>
                        </div>
                        <div class="campo">
                            <label for="reg_correo">Correo Electrónico</label>
                            <input type="email" id="reg_correo" name="reg_correo" placeholder="carlos@ejemplo.com" required>
                        </div>
                        <div class="campo">
                            <label for="reg_password">Contraseña</label>
                            <input type="password" id="reg_password" name="reg_password" placeholder="Mínimo 6 caracteres" required>
                        </div>
                        <button type="submit" name="btn_registro" class="btn-enviar">Registrarme</button>
                    </form>
                </div>
            </div>
        </section>
    </main>

    <!-- CARRITO LATERAL Y MODAL DE PAGO -->
    <div id="overlay-oscuro" class="overlay-oscuro" onclick="cerrarTodo()"></div>

    <aside id="panel-carrito" class="panel-carrito">
        <div class="carrito-header">
            <h2>🛒 Tu Carrito de Libros</h2>
            <button type="button" class="btn-cerrar-carrito" onclick="cerrarTodo()">&times;</button>
        </div>
        <div id="carrito-lista" 
