<?php
// showId.php
$db = new mysqli('localhost', 'bookadmin', '1111', 'webbooks');
if ($db->connect_errno) {
    echo "Fallada al connectar a MySQL: (" . $db->connect_errno . ") " . $db->connect_error;
}

$sql = "SELECT id FROM client";

$result = $db->query($sql);

if ($result->num_rows > 0) {
    echo "<select name='id'>";
    while ($row = $result->fetch_assoc()) {
        echo "<option value='" . $row['id'] . "'>" . $row['id'] . "</option>";
    }
    echo "</select>";
} else {
    echo "No se encontraron IDs de usuarios.";
}

$db->close();
?>
