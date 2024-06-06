<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST' && strpos($_SERVER['CONTENT_TYPE'], 'application/json') !== false) {
    
    $json = file_get_contents('php://input');
    $bookData = json_decode($json, true);

    // Verifica si los campos no están vacíos
    if (isset($bookData['ISBN'], $bookData['autor'], $bookData['titol'], $bookData['preu'])) {
    
        $db = new mysqli('localhost', 'bookadmin', '1111', 'webbooks');

        if ($db->connect_errno) {
            echo "Fallada al connectar a MySQL: (" . $db->connect_errno . ") " . $db->connect_error;
        } else {
            $isbn = $db->real_escape_string($bookData['ISBN']);
            $autor = $db->real_escape_string($bookData['autor']);
            $titol = $db->real_escape_string($bookData['titol']);
            $preu = $db->real_escape_string($bookData['preu']);

            // Query para insertar el libro
            $stmt = $db->prepare("INSERT INTO llibre (isbn, autor, titol, preu) VALUES (?, ?, ?, ?)");
            $stmt->bind_param('ssss', $isbn, $autor, $titol, $preu);

            if ($stmt->execute()) {
                // Si se inserta correctamente, muestro los libros, resaltando el último en amarillo
                $result = $db->query("SELECT * FROM llibre");
                if ($result->num_rows > 0) {
                    echo "<table>
                            <thead>
                                <tr>
                                    <th>ISBN</th>
                                    <th>Autor</th>
                                    <th>Títol</th>
                                    <th>Preu</th>
                                    <th>Selecció</th>
                                </tr>
                            </thead>
                            <tbody>";
                    $lastRow = null;
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td><pre>" . json_encode($row['isbn'], JSON_PRETTY_PRINT) . "</pre></td>
                                <td><pre>" . json_encode($row['autor'], JSON_PRETTY_PRINT) . "</pre></td>
                                <td><pre>" . json_encode($row['titol'], JSON_PRETTY_PRINT) . "</pre></td>
                                <td><pre>" . json_encode($row['preu'], JSON_PRETTY_PRINT) . "</pre></td>
                                <td><input type='checkbox' name='seleccionar'></td>
                              </tr>";
                        $lastRow = $row; // Guardo el último libro en la variable lastrow, para el color amarillo
                    }
                    
                    if ($lastRow) {
                        //aplico a la variable lastrow el color amarilo, el que he declarado antes
                        echo "<script>document.querySelector('tbody tr:last-child').style.backgroundColor = 'yellow';</script>";
                    }
                    echo "</tbody></table>";
                } else {
                    echo "No hay libros disponibles.";
                }
            } else {
                echo "Error al insertar datos en la base de datos: " . $stmt->error;
            }
            $stmt->close();
            $db->close();
        }
    } else {
        echo "Todos los campos del formulario deben estar presentes.";
    }
} else {
    echo "La solicitud no es válida.";
}
?>
