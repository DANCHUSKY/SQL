<?php
// deleteBooks.php

// Verifica si se recibieron los ISBN de los libros seleccionados
if (isset($_POST['selectedBooks']) && !empty($_POST['selectedBooks'])) {
    // Conexión a la base de datos
    $db = new mysqli('localhost', 'bookadmin', '1111', 'webbooks');
    if ($db->connect_errno) {
        echo "Fallada al connectar a MySQL: (" . $db->connect_errno . ") " . $db->connect_error;
    }


    $sql = "CALL deletebook(?)";


    $stmt = $db->prepare($sql);
    if (!$stmt) {
        echo "Error al preparar la consulta: (" . $db->errno . ") " . $db->error;
    }

    // Vincular parámetros e ISBN a la sentencia
    $stmt->bind_param("s", $isbn);


    // Iterar sobre los ISBN seleccionados y ejecutar el procedimiento almacenado para cada uno
    foreach ($_POST['selectedBooks'] as $isbn) {
        // Ejecutar la sentencia
        if (!$stmt->execute()) {
            echo "Error al intentar borrar el libro con ISBN $isbn: (" . $stmt->errno . ") " . $stmt->error;
        }
    }


    $stmt->close();
    $db->close();

    echo "Los libros seleccionados se han borrado correctamente.";
} else {
    echo "No se han recibido los ISBN de los libros seleccionados.";
}
?>