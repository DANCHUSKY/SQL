<?php
$db = new mysqli('localhost', 'bookadmin', '1111', 'webbooks');
if ($db->connect_errno) {
    echo "Fallada al connectar a MySQL: (" . $db->connect_errno . ") " . $db->connect_error;
}

$sql = "SELECT * FROM client";

$result = $db->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr><td> <input type='text' id='id' value='"
            . $row["id"] . "'></td> <td><input type='text' name='nom' id='nom' value="
            . $row["nom"] . "></td><td><input type='text' name='adreça' id='adreça' value="
            . $row["adreca"] . "></td><td><input type='text' name='ciutat' id='ciutat' value="
            . $row["ciutat"] . "></td></tr>";
    }
} else {
    echo "0 results";
}


?>