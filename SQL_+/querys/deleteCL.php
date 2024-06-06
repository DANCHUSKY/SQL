<?php

$db = new mysqli('localhost', 'bookadmin', '1111', 'webbooks');
if ($db->connect_errno) {
    echo "Fallada al connectar a MySQL: (" . $db->connect_errno . ") " . $db->connect_error;
}

// Obtener los datos del POST
$isbn = $_POST['isbn'];
$id = $_POST['id'];
$cantidad = $_POST['cantidad']; 

// Mostrar los datos obtenidos del POST (para saber si llegan)
echo "ISBN: " . $isbn . "<br>";
echo "ID: " . $id . "<br>";
echo "Cantidad: " . $cantidad . "<br>";

// Construir la consulta SQL para eliminar el registro correspondiente
$query = "DELETE FROM CL WHERE isbn = '$isbn' AND id = '$id' AND quantity = '$cantidad'"; 

// Mostrar la consulta SQL (para saber la consulta, hago un print)
echo "Consulta SQL: " . $query . "<br>";

// Ejecutar la consulta SQL de eliminación
$result = $db->query($query);

// Verificar si la eliminación fue exitosa
if ($result) {
    echo "Compra eliminada correctamente.";
} else {
    echo "Error al eliminar la compra.";
}

$db->close();
?>
