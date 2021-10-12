<?php
    include '../conexionBD.php';
    echo '<link rel="stylesheet" href="estilos.css" type="text/css">';
    function lista_habitaciones_nomHotel()
    {
        $pdo = conectaDb();
        $nomHotel = "";
        $stmt = $pdo->prepare("Call lista_habitaciones_nomHotel(?)");
        if(isset($_POST["nomHotelInput"])){
            $nomHotel=$_POST["nomHotelInput"];
        }
        $stmt->execute([$nomHotel]);
        echo '<table border="2">';
        echo '<tr>';
        echo '<th>numHabitacion</th>';
        echo '<th>capacidad</th>';
        echo '<th>preciodia</th>';
        echo '<th>activa</th>';
        echo '</tr>';
        foreach ($stmt as $row) {
            echo '<tr>';
            echo '<td>'.$row['numHabitacion'].'</td>';
            echo '<td>'.$row['capacidad'].'</td>';
            echo '<td>'.$row['preciodia'].'</td>';
            echo '<td>'.$row['activa'].'</td>';
            echo '</tr>';
        }
        echo '</table>';
    }
    echo '<form id="lista_habitaciones_nomHotel" method="POST" onload="lista_habitaciones_nomHotel()">
            <table>
                <tr>
                    <th><label for="nombreHotel">Nombre Hotel</label><br></th>
                </tr>
                <tr>
                    <td><input type="text" id="nomHotelInput" name="nomHotelInput" value="Ej: Mariachi"></td>
                    <td><input type="submit" value="Ejecutar Procedimiento"></td>
                </tr>
            </table>
          </form> ';

    lista_habitaciones_nomHotel();
    echo '<br><br><a href="./../fm_visualizacion.php"><button>Volver</button></a>';

?>