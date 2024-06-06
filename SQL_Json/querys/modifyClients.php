<?php
// Verifica si se reciben los datos de los clientes seleccionados
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $json = file_get_contents('php://input');
    $clientsData = json_decode($json, true);

    if (isset($clientsData['selectedClients']) && !empty($clientsData['selectedClients'])) {
        $db = new mysqli('localhost', 'bookuser', '1111', 'webbooks');

        if ($db->connect_errno) {
            echo "Fallo al conectar a MySQL: (" . $db->connect_errno . ") " . $db->connect_error;
            exit();
        }

        foreach ($clientsData['selectedClients'] as $client) {
            $id = $client['id'];
            $nom = $client['nom'];
            $adreca = $client['adreca'];
            $ciutat = $client['ciutat'];

            $stmt = $db->prepare("CALL UpdateClient(?, ?, ?, ?)");
            $stmt->bind_param('isss', $id, $nom, $adreca, $ciutat);

            if ($stmt->execute()) {
                echo "Los datos del cliente con ID $id se han actualizado correctamente.<br>";
            } else {
                echo "Error al intentar actualizar los datos del cliente con ID $id: " . $stmt->error . "<br>";
            }
            $stmt->close();
        }
        $db->close();
    } else {
        echo "No se han recibido los datos de los clientes seleccionados para actualizar.";
    }
} else {
    echo "No se han recibido los datos de los clientes seleccionados para actualizar.";
}
?>
