<!--Daniel-->
<!--showBooks.php-->
<?php
$db = new mysqli('localhost', 'bookadmin', '1111', 'webbooks');
if ($db->connect_errno) {
    echo "Fallada al connectar a MySQL: (" . $db->connect_errno . ") " . $db->connect_error;
}

$sql = "CALL showbooks()";

$result = $db->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_row()) {
        echo "<tr>
                <td><input type='text' name='ISBN' value='" . $row[0] . "' readonly></td>
                <td><input type='text' name='autor' value='" . $row[1] . "'></td>
                <td><input type='text' name='titol' value='" . $row[2] . "'></td>
                <td><input type='text' name='preu' value='" . $row[3] . "'></td>
                <td><input type='checkbox' name='seleccionar'></td>
              </tr>";
    }
} else {
    echo "0 results";
}



?>