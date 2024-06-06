<?php
//showCL.php
$db = new mysqli('localhost', 'bookadmin', '1111', 'webbooks');
if ($db->connect_errno) {
    echo "Fallada al connectar a MySQL: (" . $db->connect_errno . ") " . $db->connect_error;
}


$sql = "CALL showCL()";

$result = $db->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_row()) {
        echo "<tr>
                <td><input type='text' name='ISBN' value='" . $row[0] . "' readonly></td>
                <td><input type='text' name='ID' value='" . $row[1] . "'></td>
                <td><input type='text' name='CANTIDAD' value='" . $row[2] . "'></td>
               
                
              </tr>";
    }
} else {
    echo "0 results";
}
?>