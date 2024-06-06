<?php
$db = new mysqli('localhost', 'bookadmin', '1111', 'webbooks');
if ($db->connect_errno) {
    echo "Fallo al conectar a MySQL: (" . $db->connect_errno . ") " . $db->connect_error;
}

$sql = "CALL showusers()";
$result = $db->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td><input type='text' name='id' value='" . $row['id'] . "' readonly></td>
                <td><input type='text' name='nom' value='" . $row['nom'] . "'></td>
                <td><input type='text' name='adreca' value='" . $row['adreca'] . "'></td>
                <td><input type='text' name='ciutat' value='" . $row['ciutat'] . "'></td>
                <td><input type='checkbox' name='seleccionar'></td>
              </tr>";
    }
} else {
    echo "0 resultados";
}
$db->close();
?>
