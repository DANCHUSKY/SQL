<?php
// Configuración de la base de datos
$db = new mysqli('localhost', 'bookuser', '1111', 'webbooks');
if ($db->connect_errno) {
    echo json_encode(["error" => "Fallada al connectar a MySQL: (" . $db->connect_errno . ") " . $db->connect_error]);
    exit();
}

// Obtener el ID del usuario
$userId = isset($_POST['userId']) ? $_POST['userId'] : null;

if ($userId) {
    // Consultar la tabla 'client' para obtener la información del cliente correspondiente
    $sql = "SELECT * FROM client WHERE id = ?";
    $stmt = $db->prepare($sql);
    $stmt->bind_param('i', $userId);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $clientData = $result->fetch_assoc();
        echo json_encode($clientData);
    } else {
        echo json_encode(["error" => "No se encontró ningún cliente con el ID proporcionado."]);
    }
    
    $stmt->close();
} else {
    echo json_encode(["error" => "ID de usuario no proporcionado."]);
}

$db->close();
?>
