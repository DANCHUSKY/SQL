<?php

function loginUser() {
    $db = new mysqli('localhost', 'bookadmin', '1111', 'webbooks');
    if ($db->connect_errno) {
        echo "Fallada al connectar a MySQL: (" . $db->connect_errno . ") " . $db->connect_error;
        return false;
    }
    $sql = "SELECT usuari, contrassenya, id FROM credencials WHERE usuari = ? AND contrassenya = ?";
    $stmt = $db->prepare($sql);
    $stmt->bind_param('ss', $_POST['user'], $_POST['pass']);
    $stmt->execute();
    $stmt->bind_result($user, $pass, $userId);
    $stmt->fetch();
    $stmt->close();
    if ($user == 'admin' && $pass == '1111') {
        return ['type' => 'admin', 'id' => $userId];
    } else if ($user && $pass) {
        return ['type' => 'user', 'id' => $userId];
    } else {
        return false;
    }
}

function loginForm()
{
    echo '
    <div id="loginform">
    <form action="index.php" method="post">
        <p><strong>Introdueix usuari i contrassenya per continuar:</strong></p>
        <label for="name">User: </label>
        <input type="text" name="user" id="name" /> 
        <label for="name">Pass: </label>
        <input type="password" name="pass" id="pass" /> 
        <input type="submit" name="enter" id="enter" value="Enter" />
    </form>
    </div>
    ';
}

$userType = null;
$userId = null;

if (isset($_POST['user'])) {
    $loginResult = loginUser();
    if (!$loginResult) {
        echo '<span class="error">Siusplau introdueix usuari i contrassenya</span>';
    } else {
        $userType = $loginResult['type'];
        $userId = $loginResult['id'];
        echo "Has iniciado sesión correctamente";
    }
}

?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Chat</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
    <script type="text/javascript" src="jquery-1.7.2.min.js"></script>
    <script type="text/javascript">

            /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        $(document).ready(function() {
            $("#exit").click(function() {
                var exit = confirm("Estas segur que vols abandonar la sessio?");
                if (exit == true) {
                    window.location = 'index.php';
                }
            });
            //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
            $("#mostrarC").click(function () {
                $.ajax({
                    url: "querys/showUsers.php",
                    type: "POST",
                    success: function (response) {
                        console.log(response);
                        document.getElementById("inputsC").innerHTML = response;
                    }
                });
            });
            //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
            $(document).ready(function() {
                    $("#insertL").click(function() {
                        var isbn = $("#isbnInsert").val();
                        var autor = $("#autorInsert").val();
                        var titol = $("#titolInsert").val();
                        var preu = $("#preuInsert").val();

                        var bookData = {
                            ISBN: isbn,
                            autor: autor,
                            titol: titol,
                            preu: preu
                        };

                        $.ajax({
                            url: "querys/insertBooks.php",
                            type: "POST",
                            contentType: "application/json",
                            data: JSON.stringify(bookData),
                            success: function(response) {
                                
                                console.log(response);
                                document.getElementById("inputsL").innerHTML = response;
                                alert("Libro insertado correctamente.");
                            },
                            error: function(xhr, status, error) {
                                console.error("Error al insertar el libro: " + error);
                                console.log(xhr.responseText);
                            }
                        });
                    });
                });



























                
            //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
            $("#mostrarL").click(function () {
                $.ajax({
                    url: "querys/showBooks.php",
                    type: "POST",
                    success: function (response) {
                        console.log(response);
                        document.getElementById("inputsL").innerHTML = response;
                    }
                });
            });
            //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
            $("#borrarL").click(function () {
                var selectedBooks = [];
                $("input[name='seleccionar']:checked").each(function () {
                    selectedBooks.push($(this).closest("tr").find("input[name='ISBN']").val());
                });

                $.ajax({
                    url: "querys/deleteBooks.php",
                    type: "POST",
                    data: { selectedBooks: selectedBooks },
                    success: function (response) {
                        console.log(response);
                    },
                    error: function (xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            });
            //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
            $("#actualitzarL").click(function () {
                var booksData = [];

                $("tr").each(function () {
                    var row = $(this);
                    var isChecked = row.find("input[name='seleccionar']").is(":checked");

                    if (isChecked) {
                        var isbn = row.find("input[name='ISBN']").val();
                        var autor = row.find("input[name='autor']").val();
                        var titol = row.find("input[name='titol']").val();
                        var preu = row.find("input[name='preu']").val();
                        booksData.push({ ISBN: isbn, autor: autor, titol: titol, preu: preu });
                    }
                });

                $.ajax({
                    url: "querys/modifyBooks.php",
                    type: "POST",
                    data: { selectedBooks: booksData },
                    success: function (response) {
                        console.log(response);
                    },
                    error: function (xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            });
            //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
            $("#showCredentialID").click(function () {
                $.ajax({
                    url: "querys/mostrar_id.php",
                    type: "POST",
                    data: { userId: "<?php echo $userId; ?>" },
                    success: function (response) {
                        var clientData = JSON.parse(response);
                        console.log(clientData); // consola
                        alert(JSON.stringify(clientData)); // ALERTA dialogo, para comprobar que tengo los datos correctos

                        // actualizo la tabla
                        $("#id2").val(clientData.id);
                        $("#nom2").val(clientData.nom);
                        $("#adreça2").val(clientData.adreca);
                        $("#ciutat2").val(clientData.ciutat);
                    },
                    error: function (xhr, status, error) {
                        alert("Error al obtener los datos del cliente.");
                    }
                });
            });

            $(document).ready(function() {
                    $("#actualitzarCliente").click(function () {
                        var selectedClients = [];

                        
                        $("#inputsC tr").each(function() {
                            var row = $(this);
                            var isChecked = row.find("input[name='seleccionar']").is(":checked");

                            if (isChecked) {
                                var id = row.find("input[name='id']").val();
                                var nom = row.find("input[name='nom']").val();
                                var adreca = row.find("input[name='adreça']").val();
                                var ciutat = row.find("input[name='ciutat']").val();

                                selectedClients.push({ id: id, nom: nom, adreca: adreca, ciutat: ciutat });
                            }
                        });

                        // json, lo he hecho antes del examen para practicar
                        if (selectedClients.length > 0) {
                            $.ajax({
                                url: "querys/modifyClients.php",
                                type: "POST",
                                contentType: "application/json",
                                data: JSON.stringify({ selectedClients: selectedClients }),
                                success: function(response) {
                                    console.log(response);
                                    alert("Clientes actualizados correctamente.");
                                },
                                error: function(xhr, status, error) {
                                    console.error("Error al actualizar los clientes: " + error);
                                    console.log(xhr.responseText);
                                }
                            });
                        } else {
                            alert("No hay clientes seleccionados para actualizar.");
                        }
                    });
                });


            
        });
    </script>
</head>
<body>
<?php

if (!isset($userType) || !$userType) {
    loginForm();
} else {
    ?>
<div id="wrapper">
    <div id="menu">
        <?php echo '<p class="welcome">Benvingut, ' . '<div id="nom"> ' . $_POST['user'] . '</div>'; ?>
        </p>
        <!------------------------------------------------------------------------------------------------------------------------------------------------>
        <?php if ($userType === 'admin') { ?>
        <div id="adminTables">
            <table>
                <caption>Clients</caption>
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Nom</th>
                        <th>Direcció</th>
                        <th>Ciutat</th>
                        <th>Selecció</th>
                    </tr>
                </thead>
                <tbody id="inputsC">
                    <tr>
                        <td><input type="text" name="id" id="id"></td>
                        <td><input type="text" name="nom" id="nom"></td>
                        <td><input type="text" name="adreça" id="adreça"></td>
                        <td><input type="text" name="ciutat" id="ciutat"></td>
                        <td><input type="checkbox" name="seleccio" id="seleccio" disabled="false" /></td>
                    </tr>
                </tbody>
            </table>
            <input type="button" id="mostrarC" value="Mostrar dades" />
            <input type="button" id="borrarC" value="Esborrar seleccionats" />
            <input type="button" id="actualitzarCliente" value="Actualitzar seleccionats" />
            <hr class="divider">
            <!------------------------------------------------------------------------------------------------------------------------------------------------>
            <table>
                <caption>Llibres</caption>
                <thead>
                    <tr>
                        <th>ISBN</th>
                        <th>Autor</th>
                        <th>Titol</th>
                        <th>Preu</th>
                        <th>Selecció</th>
                    </tr>
                </thead>
                <tbody id="inputsL">
                    <tr>
                        <td><input type="text" name="ISBN" id="isbn"></td>
                        <td><input type="text" name="autor" id="autor"></td>
                        <td><input type="text" name="titol" id="titol"></td>
                        <td><input type="text" name="preu" id="preu"></td>
                        <td><input type="checkbox" name="seleccioL" id="seleccioL" disabled="false" /></td>
                    </tr>
                </tbody>
            </table>
            <input type="button" id="mostrarL" value="Mostrar dades" />
            <input type="button" id="borrarL" value="Esborrar seleccionats" />
            <input type="button" id="actualitzarL" value="Actualitzar seleccionats" />
            <hr class="divider">
            <!------------------------------------------------------------------------------------------------------------------------------------------------>
            <table>
                <caption>Insereix Llibres</caption>
                <thead>
                    <tr>
                        <th>ISBN</th>
                        <th>Autor</th>
                        <th>Titol</th>
                        <th>Preu</th>
                    </tr>
                </thead>
                <tbody id="insertBooks">
                    <tr>
                        <td><input type="text" name="ISBN" id="isbnInsert"></td>
                        <td><input type="text" name="autor" id="autorInsert"></td>
                        <td><input type="text" name="titol" id="titolInsert"></td>
                        <td><input type="text" name="preu" id="preuInsert"></td>
                    </tr>
                </tbody>
            </table>
            <input type="button" id="insertL" value="Insereix Llibres" />
            <hr class="divider">
        </div>
            <!------------------------------------------------------------------------------------------------------------------------------------------------>
        <?php } else if ($userType === 'user') { ?>
        <div id="userTable">
            <table>
                <caption>Clients</caption>
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Nom</th>
                        <th>Direcció</th>
                        <th>Ciutat</th>
                        <th>Selecció</th>
                    </tr>
                </thead>
                <tbody id="inputsC">
                    <tr>
                        <td><input type="text" name="id" id="id2"></td>
                        <td><input type="text" name="nom" id="nom2"></td>
                        <td><input type="text" name="adreça" id="adreça2"></td>
                        <td><input type="text" name="ciutat" id="ciutat2"></td>
                        <td><input type="checkbox" name="seleccio" id="seleccio" disabled="false" /></td>
                    </tr>
                </tbody>
            </table>
        
            
        </div>
        
        <input type="button" id="showCredentialID" value="Mostrar ID Credencial" />
        <?php } ?>

        <p class="logout"><input name="sortir" type="button" id="exit" value="SORTIR" /></p>

        <div style="clear:both"></div>
    </div>
</div>

<?php
}
?>

</body>
</html>