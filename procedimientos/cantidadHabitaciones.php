<?php
    include '../conexionBD.php';
    echo '<link rel="stylesheet" href="estilos.css" type="text/css">';
    function lista_habitaciones_nomHotel()
    {
        $pdo = conectaDb();
        $stmt = $pdo->prepare("Call cantidadHabitaciones(?,?,?,@out1, @out2)");
        if(isset($_POST['codHotelInput']) &&
        isset($_POST["nomHotelInput"]) &&
        isset($_POST['preciodiaInput']) 
        ){
            $codHotel=$_POST["codHotelInput"];
            $nomHotel=$_POST["nomHotelInput"];
            $capacidad=$_POST["preciodiaInput"];
            $stmt -> bindParam(1, $codHotel, PDO::PARAM_STR);
            $stmt -> bindParam(2, $nomHotel, PDO::PARAM_STR);
            $stmt -> bindParam(3, $capacidad, PDO::PARAM_INT);
            $stmt->execute();
        }
        $row = $stmt->fetch();
        $stmt = $pdo -> query('select @out1 as salida1, @out2 as salida2');
        $row = $stmt->fetch(); 
        echo '<table border="2">';
        echo '<tr>';
        echo '<th>numHabitacion</th>';
        echo '<th>capacidad</th>';
        echo '</tr>';

            echo '<tr>';
            echo '<td>'.$row['salida1'].'</td>';
            echo '<td>'.$row['salida2'].'</td>';
            echo '</tr>';
        
        echo '</table>';
    }
    echo '<form id="lista_habitaciones_nomHotel" method="POST" onload="lista_habitaciones_nomHotel()">
            <table>
                <tr>
                    <th><label for="codHotel">Codigo Hotel</label><br></th>
                    <th><label for="nombreHotel">Nombre Hotel</label><br></th>
                    <th><label for="capacida">Precio dia</label><br></th>
                </tr>
                <tr>
                    <td><input type="text" id="codHotelInput" name="codHotelInput" value="Ej: A00" maxlength="6" required></td>
                    <td><input type="text" id="nomHotelInput" name="nomHotelInput" value="Ej: Mariachi" minlength="0" maxlength="4"  maxlength="4" required></td>
                    <td><input type="number" id="preciodiaInput" name="preciodiaInput" value="Ej: 5" min="-128" max="255" required></td>                    
                    <td><input type="submit" value="Ejecutar Procedimiento"></td>
                </tr>
            </table>
          </form> ';

    lista_habitaciones_nomHotel();
    echo '<br><br><a href="./../fm_visualizacion.php"><button>Volver</button></a>';

?>