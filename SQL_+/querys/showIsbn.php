<?php
// showIsbn.php
$db = new mysqli('localhost', 'bookadmin', '1111', 'webbooks');
if ($db->connect_errno) {
    echo "Fallada al connectar a MySQL: (" . $db->connect_errno . ") " . $db->connect_error;
}

$sql = "SELECT ISBN FROM llibre";

$result = $db->query($sql);

if ($result->num_rows > 0) {
    echo "<select name='isbn'>";
    while ($row = $result->fetch_assoc()) {
        echo "<option value='" . $row['ISBN'] . "'>" . $row['ISBN'] . "</option>";
    }
    echo "</select>";
} else {
    echo "No se encontraron ISBN de libros.";
}

$db->close();
?>
