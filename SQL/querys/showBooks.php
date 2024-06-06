<!--Daniel-->
<?php
$db = new mysqli('localhost', 'bookadmin', '1111', 'webbooks');
if ($db->connect_errno) {
    echo "Fallada al connectar a MySQL: (" . $db->connect_errno . ") " . $db->connect_error;
}

$sql = "SELECT * FROM llibre";

$result = $db->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td><input type='text' name='ISBN' value='" . $row["isbn"] . "' readonly></td>
                <td><input type='text' name='autor' value='" . $row["autor"] . "'></td>
                <td><input type='text' name='titol' value='" . $row["titol"] . "'></td>
                <td><input type='text' name='preu' value='" . $row["preu"] . "'></td>
                <td><input type='checkbox' name='seleccionar'></td>
              </tr>";
    }
} else {
    echo "0 results";
}



?>