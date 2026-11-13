<?php
header('Content-Type: application/json; charset=utf-8');
require_once 'conexion.php';

// Leer el JSON enviado por fetch() desde el carrito
$entrada = file_get_contents('php://input');
$datos   = json_decode($entrada, true);

// Validar que existan datos y productos en el pedido
if (!$datos || empty($datos['items'])) {
    http_response_code(400);
    echo json_encode(['exito' => false, 'mensaje' => 'El carrito está vacío o los datos son inválidos.']);
    exit;
}

$cliente   = trim($datos['cliente'] ?? 'Cliente General');
$direccion = trim($datos['direccion'] ?? 'Sin dirección');
$metodo    = trim($datos['metodo'] ?? 'tarjeta');
$total     = floatval($datos['total'] ?? 0);
$items     = $datos['items'];

// Iniciar transacción para asegurar que se guarden tanto la venta como sus detalles
$conn->begin_transaction();

try {
    // 1. Insertar el encabezado de la venta en la tabla `ventas`
    $stmtVenta = $conn->prepare("INSERT INTO ventas (cliente, direccion, metodo_pago, total) VALUES (?, ?, ?, ?)");
    $stmtVenta->bind_param("sssd", $cliente, $direccion, $metodo, $total);
    $stmtVenta->execute();

    // Obtener el ID autogenerado para usarlo como Folio
    $ventaId = $conn->insert_id;
    $stmtVenta->close();

    // 2. Insertar cada libro comprado en la tabla `detalle_ventas`
    $stmtDetalle = $conn->prepare("INSERT INTO detalle_ventas (venta_id, libro_id, cantidad, precio_unitario) VALUES (?, ?, ?, ?)");

    foreach ($items as $item) {
        $libroId  = intval($item['id']);
        $cantidad = intval($item['cantidad']);
        $precio   = floatval($item['precio']);

        $stmtDetalle->bind_param("iiid", $ventaId, $libroId, $cantidad, $precio);
        $stmtDetalle->execute();
    }

    $stmtDetalle->close();

    // Confirmar cambios en la base de datos
    $conn->commit();

    // Formatear folio a 6 dígitos (ej. 000001) y responder a JavaScript
    $folioFormateado = str_pad($ventaId, 6, '0', STR_PAD_LEFT);
    echo json_encode([
        'exito' => true,
        'folio' => $folioFormateado
    ]);

} catch (Exception $e) {
    // Si algo falla, deshacer la operación
    $conn->rollback();
    http_response_code(500);
    echo json_encode([
        'exito'   => false,
        'mensaje' => 'Error al registrar la venta: ' . $e->getMessage()
    ]);
}

$conn->close();
?>
