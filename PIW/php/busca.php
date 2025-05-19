<?php
include "conexion.php";

$nombre = $_GET['nombre'] ?? '';
$zona = $_GET['zona'] ?? '';

$sql = "SELECT * FROM restaurantes WHERE 1";

// Filtros dinámicos
if (!empty($nombre)) {
    $sql .= " AND nombre LIKE '%" . $conexion->real_escape_string($nombre) . "%'";
}

if (!empty($zona)) {
    $sql .= " AND zona = '" . $conexion->real_escape_string($zona) . "'";
}

$resultado = $conexion->query($sql);

if ($resultado->num_rows > 0) {
    while ($row = $resultado->fetch_assoc()) {
        echo "<div class='tarjeta'>";
        echo "<h3>" . htmlspecialchars($row['nombre']) . "</h3>";
        echo "<p>Zona: " . htmlspecialchars($row['zona']) . "</p>";
        echo "<p>" . htmlspecialchars($row['descripcion']) . "</p>";
        echo "</div>";
    }
} else {
    echo "<p>No se encontraron resultados.</p>";
}
?>