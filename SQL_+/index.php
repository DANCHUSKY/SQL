<!--Daniel-->
<?php

function loginUser()
{
    $db = new mysqli('localhost', 'bookadmin', '1111', 'webbooks');
    if ($db->connect_errno) {
        echo "Fallada al connectar a MySQL: (" . $db->connect_errno . ") " . $db->connect_error;
    }
    //count
    $sql = "SELECT COUNT(*) FROM credencials WHERE usuari = ? AND contrassenya = ?";
    $stmt = $db->prepare($sql);
    $stmt->bind_param('ss', $_POST['user'], $_POST['pass']);
    $stmt->execute();
    $stmt->bind_result($count);
    $stmt->fetch();
    $stmt->close();
    if ($count == 1) {

        return true;
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
                <input type="text" name="pass" id="pass" /> 
		<input type="submit" name="enter" id="enter" value="Enter" />
	</form>
	</div>
	';
}

if (isset($_POST['user'])) {
    $isUserExisting = loginUser();
    if (!$isUserExisting) {
        echo '<span class="error">Siusplau introdueix usuari i contrassenya</span>';

    } else {
        echo "Has iniciado sesión correctamente";

    }
}


?>
<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <title>Chat</title>

    <script type="text/javascript" src="jquery-1.7.2.min.js"></script>
    <script type="text/javascript">

        $(document).ready(function () {

            //Si l'usuari vol tancar la sessió
            $("#exit").click(function () {
                var exit = confirm("Estas segur que vols abandonar la sessio?");
                if (exit == true) {
                    window.location = 'index.php';
                }
            });
        });

    </script>

    <style type="text/css">
        /* CSS Document */
        body {
            font: 12px arial;
            color: #222;
            text-align: center;
            padding: 35px;
        }

        form,
        p,
        span {
            margin: 0;
            padding: 0;
        }

        input {
            font: 13px arial;
        }

        #wrapper {
            margin: 0 auto;
            margin-top: 60px;
            padding-bottom: 25px;
            padding-left: 25px;
            background: #EBF4FB;
            width: 850px;
            height: auto;
            border: 10px ridge cadetblue;
            box-shadow: 3px 3px 7px grey;
            border-radius: 9px;
            opacity: 0.7;
        }

        #loginform {
            margin: 0 auto;
            margin-top: 60px;
            padding-bottom: 25px;
            background: #EBF4FB;
            width: 504px;
            border: 10px ridge cadetblue;
            box-shadow: 3px 3px 7px grey;
            border-radius: 9px;
            opacity: 0.7;
        }

        body {
            background-image: url(fons2.png);
        }

        strong {
            color: grey;
            letter-spacing: 2px;
        }

        #nom {
            text-align: left;
            font-weight: bold;
        }

        #loginform {
            padding-top: 18px;
        }

        #loginform p {
            margin: 5px;
        }

        #submitmsg {
            box-shadow: 3px 3px 7px grey;
        }

        #submit {
            width: 60px;
        }

        .error {
            color: #ff0000;
        }

        #menu {
            padding: -15px 25px 12.5px 25px;
        }

        .welcome {
            float: left;
        }

        .logout {
            float: right;
        }

        #name,
        #pass {
            border-radius: 4px;
            box-shadow: 3px 3px 7px grey;
            border: 1px solid aqua;
            padding-left: 4px;
            color: grey;
        }

        #name,
        #pass {
            margin-right: 9px;
        }

        #enter {
            border-radius: 4px;
            box-shadow: 3px 3px 7px grey;
            border: 1px solid aqua;
            text-align: center;
            font-weight: bold;
            color: darkslategrey;
        }

        #exit {
            border-radius: 4px;
            box-shadow: 3px 3px 7px grey;
            border: 1px solid aqua;
            text-align: center;
            font-weight: bold;
            color: darkslategrey;
            width: 100px;
            margin-right: 380px;
        }

        table {
            border: 2px solid;

            border-collapse: collapse;
        }

        thead {

            border-bottom: 2px solid;
            background-color: red;
        }

        th {
            padding: 5px;
            align: center;
            border: 1px solid;
        }

        td {
            padding: 5px;
            align: center;
            border: 1px solid;
        }

        caption {
            background-color: oldlace;
            border-top: 1px solid;
            padding: 5px;
        }

        .divider {
            border: none;
            height: 1px;
            /* Altura de la barra divisoria */
            background-color: #ccc;
            /* Color de la barra divisoria */
            margin: 20px 0;
            /* Margen superior e inferior para separar visualmente */
        }
    </style>
</head>
<!------------------------------------------------------------------------------------------------------------------------------------------------------------->
<?php
//Check if userExisting has data
if (!isset($isUserExisting)) {
    $isUserExisting = false;
}


if (!$isUserExisting) {
    loginForm();
} else {
    ?>
<div id="wrapper">
    <div id="menu">
        <?php echo '<p class="welcome">Benvingut, ' . '<div id="nom"> ' . $_POST['user'] . '</div>'; ?>
        </p>



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









        <!------------------------------------------------------------------------------------------------------------>
            <input type="button" id="mostrarC" value="Mostrar dades" />
            <input type="button" id="borrarC" value="Esborrar seleccionats" />
            <input type="button" id="actualizarC" value="Actualitzar seleccionats" />

            <hr class="divider">

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







            <!------------------------------------------------------------------------------------------------------------>
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

            <input type="button" id="mostrarL" value="Mostrar dades" />
            <input type="button" id="borrarL" value="Esborrar seleccionats" />
            <input type="button" id="actualizarL" value="Actualitzar seleccionats" />
            <input type="button" id="insertL" value="Insereix Llibres" />
            <hr class="divider">
                <!------------------------------------------------------------------------------------------------------------------>
           
                <table>
                            <caption>Comprar Libro</caption>
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>ISBN</th>
                                    <th>Cantidad</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <select id="dropdownId" name="id">
                                            
                                        </select>
                                    </td>
                                    <td>
                                        <select id="dropdownIsbn" name="isbn">
                                            
                                        </select>
                                    </td>
                                    <td>
                                        <select id="dropdownCantidad" name="cantidad">
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                            <option value="6">6</option>
                                            <option value="7">7</option>
                                            <option value="8">8</option>
                                            <option value="9">9</option>
                                            <option value="10">10</option>
                                        </select>
                                    </td>
                                </tr>
                            </tbody>
                        </table>


                        


                <button id="comprarLibros">Comprar</button>




                <!---------------------------------------------------------------------------------------------------------------------->
                <table>
                <caption>CL</caption>
                <thead>
                    <tr>
                        <th>ISBN</th>
                        <th>ID</th>
                        <th>CANTIDAD</th>
                        
                    </tr>
                </thead>
                <tbody id="inputsCL">
                    <tr>
                        <td><input type="text" name="ISBN" id="isbnCL"></td>
                        <td><input type="text" name="ID" id="idCL"></td>
                        <td><input type="text" name="CANTIDAD" id="cantidadCL"></td>
                        
                    </tr>
                </tbody>
            </table>





            <!---------------------------------------------------------------------------------------------------------------------------->
            <input type="button" id="mostrarCL" value="Mostrar CL" />


            <input type="button" id="borrarCL" value="Borrar CL" />
            
            <p class="logout"><input name="sortir" type="button" id="exit" value="SORTIR" /></p>

            <div style="clear:both"></div>
        </div>

    </div>

    <?php
}
?>

</body>













































<!------------------------------------------------------------------------------------------------------------------------>
<script>
    $(document).ready(function () {
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
        /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
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
        /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        $("#mostrarCL").click(function () {
            $.ajax({
                url: "querys/showCL.php",
                type: "POST",
                success: function (response) {
                    console.log(response);
                    document.getElementById("inputsCL").innerHTML = response;
                }
            });
        });

        


















        ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        $("#insertL").click(function () {
            // Recojo los datos de la tabla de inserción de libros
            var isbn = $("#isbnInsert").val();
            var autor = $("#autorInsert").val();
            var titol = $("#titolInsert").val();
            var preu = $("#preuInsert").val();

            // Envío los datos recogidos en un POST
            var postData = {
                ISBN: isbn,
                autor: autor,
                titol: titol,
                preu: preu
            };

            // Creo un ajax, enviando por post al fichero INSERTBOOK.PHP los datos
            $.ajax({
                url: "querys/insertBooks.php",
                type: "POST",
                data: postData,
                success: function (response) {
                    console.log(response);

                }
            });
        });
       

        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        $("#borrarL").click(function () {
            var selectedBooks = [];

            // Recoge los ISBN de los libros seleccionados
            //En name 'SELECCIONAR' está recogiendo el name de SHOWBOOKS.PHP
            $("input[name='seleccionar']:checked").each(function () {
                selectedBooks.push($(this).closest("tr").find("input[name='ISBN']").val());
            });

            // Enviar los ISBN al servidor mediante AJAX
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


        /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        $("#actualizarL").click(function () {
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
















        /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        $(document).ready(function () {
                // Cargar los IDs de los usuarios cuando la página se carga por primera vez
                showIds();

                // Función para cargar los IDs de los usuarios
                function showIds() {
                    $.ajax({
                        url: "querys/showId.php",
                        type: "GET",
                        success: function (response) {
                            // Insertar el HTML del desplegable en el elemento con el id "dropdownId"
                            $("#dropdownId").html(response);
                        },
                        error: function (xhr, status, error) {
                            // Manejar errores si la solicitud AJAX falla
                            console.error("Error en la solicitud AJAX: " + status, error);
                        }
                    });
                }

                
            });











            ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
            $(document).ready(function () {

                 // Cargar los ISBN de los libros cuando la página se carga por primera vez
                 showIsbn();
                    
                    function showIsbn() {
                        $.ajax({
                            url: "querys/showIsbn.php",
                            type: "GET",
                            success: function (response) {
                                
                                $("#dropdownIsbn").html(response);
                            },
                            error: function (xhr, status, error) {
                                
                                console.error("Error en la solicitud AJAX: " + status, error);
                            }
                        });
                    }

                  
                    
                });









                /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
                $(document).ready(function () {
                        $("#comprarLibros").click(function () {
                            // Obtener los valores seleccionados del formulario
                            var isbn = $("select[name='isbn']").val();
                            var id = $("select[name='id']").val();
                            var cantidad = $("select[name='cantidad']").val(); 
                            
                            // datos a enviar
                            var data = {
                                isbn: isbn,
                                id: id,
                                cantidad: cantidad 
                            };

                            
                            $.ajax({
                                url: "querys/buyBooks.php",
                                type: "POST",
                                data: data,
                                success: function (response) {
                                    console.log(response);
                                    
                                },
                                error: function (xhr, status, error) {
                                    console.error(xhr.responseText);
                                   
                                }
                            });
                        });
                    });



                    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
                $(document).ready(function () {
                        $("#borrarCL").click(function () {
                            // Obtener los valores seleccionados del formulario
                            var isbn = $("select[name='isbn']").val();
                            var id = $("select[name='id']").val();
                            var cantidad = $("select[name='cantidad']").val(); 
                            
                            // datos a enviar
                            var data = {
                                isbn: isbn,
                                id: id,
                                cantidad: cantidad 
                            };

                            
                            $.ajax({
                                url: "querys/deleteCL.php",
                                type: "POST",
                                data: data,
                                success: function (response) {
                                    console.log(response);
                                    
                                },
                                error: function (xhr, status, error) {
                                    console.error(xhr.responseText);
                                   
                                }
                            });
                        });
                    });




    });


</script>

</html>