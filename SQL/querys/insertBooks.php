<!--Daniel-->
<?php
//Verifica si estan todos los campos completos en el formulario, sino salta un error diciendo que está incompleto.
if (isset($_POST['ISBN'], $_POST['autor'], $_POST['titol'], $_POST['preu'])) {
    // Conectar a la base de datos
    $db = new mysqli('localhost', 'bookadmin', '1111', 'webbooks');
    if ($db->connect_errno) {
        echo "Fallada al connectar a MySQL: (" . $db->connect_errno . ") " . $db->connect_error;
    } else {

        //El REAL ESCAPE STRING quita todos los carácteres raros, por ejemplo " u otros carácteres.
        $isbn = $db->real_escape_string($_POST['ISBN']);
        $autor = $db->real_escape_string($_POST['autor']);
        $titol = $db->real_escape_string($_POST['titol']);
        $preu = $db->real_escape_string($_POST['preu']);


        $sql = "INSERT INTO `llibre` (`isbn`, `autor`, `titol`, `preu`) VALUES ('$isbn', '$autor', '$titol', '$preu')";

        // Ejecutar la consulta SQL
        if ($db->query($sql)) {
            echo "Los datos se han insertado correctamente en la base de datos.";
        } else {
            echo "Error al insertar datos en la base de datos: " . $db->error;
        }
    }
} else {
    echo "Todos los campos del formulario deben estar presentes.";
}
?>