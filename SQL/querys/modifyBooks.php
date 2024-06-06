<?php
// modifyBooks.php

if (isset($_POST['selectedBooks']) && !empty($_POST['selectedBooks'])) {
    $db = new mysqli('localhost', 'bookadmin', '1111', 'webbooks');
    if ($db->connect_errno) {
        echo "Fallada al conectar a MySQL: (" . $db->connect_errno . ") " . $db->connect_error;
        exit();
    }

    foreach ($_POST['selectedBooks'] as $book) {

        if (isset($book['autor'], $book['titol'], $book['preu'], $book['ISBN']) && !empty($book['autor']) && !empty($book['titol']) && !empty($book['preu']) && !empty($book['ISBN'])) {

            $autor = $book['autor'];
            $titol = $book['titol'];
            $preu = $book['preu'];
            $isbn = $book['ISBN'];

            // CONSUULTA SQL
            $sql = "UPDATE llibre SET autor='$autor', titol='$titol', preu='$preu' WHERE isbn='$isbn'";


            if ($db->query($sql)) {
                echo "Los datos del libro con ISBN $isbn se han actualizado correctamente.<br>";
            } else {
                echo "Error al intentar actualizar los datos del libro con ISBN $isbn: " . $db->error . "<br>";
            }
        } else {
            echo "No se recibieron todos los datos necesarios para actualizar el libro.<br>";
        }
    }

    $db->close();
} else {
    echo "No se han recibido los datos de los libros seleccionados para actualizar.";
}
?>