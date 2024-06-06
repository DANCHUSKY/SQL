<!--Daniel-->
<?php
// deletebooks.php

// Verifica si se recibieron los ISBN de los libros seleccionados
if (isset($_POST['selectedBooks']) && !empty($_POST['selectedBooks'])) {
    // Conexión a la base de datos
    $db = new mysqli('localhost', 'bookadmin', '1111', 'webbooks');
    if ($db->connect_errno) {
        echo "Fallada al connectar a MySQL: (" . $db->connect_errno . ") " . $db->connect_error;
    }

    // Convertir los ISBN recibidos en una cadena separada por comas
    //implode convierte transforma un array a cadena
    $isbnList = implode(",", array_map('intval', $_POST['selectedBooks']));

    // Preparar la consulta para borrar los libros seleccionados
    $sql = "DELETE FROM llibre WHERE isbn IN ($isbnList)";

    // Ejecuta la consulta
    if ($db->query($sql) === TRUE) {
        echo "Los libros seleccionados se han borrado correctamente.";
    } else {
        echo "Error al intentar borrar los libros seleccionados: " . $db->error;
    }


    $db->close();
} else {
    echo "No se han recibido los ISBN de los libros seleccionados.";
}
?>