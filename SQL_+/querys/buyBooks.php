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


$query = "INSERT INTO CL (isbn, id, quantity) VALUES ('$isbn', '$id', '$cantidad')"; 

// Mostrar la consulta SQL (para saber la consulta, hago un print)
echo "Consulta SQL: " . $query . "<br>";


$result = $db->query($query);

// Verificar si la inserción fue exitosa
if ($result) {
    echo "Compra realizada correctamente.";
} else {
    echo "Error al realizar la compra.";
}


$db->close();
?>
