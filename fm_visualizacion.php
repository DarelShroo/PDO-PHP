<?php
    include './conexionBD.php';
    echo '<link rel="stylesheet" href="./estilos.css" type="text/css">';
    echo '<script src="borrarModificar.js"></script>';
    $db = conectaDb();
    $stmt = $db -> query('SELECT * FROM habitaciones INNER JOIN hoteles on hoteles.codHotel=habitaciones.codHotel');
    echo '<form action="baja.php" method="POST" id="visualizar">
            <table border="2">
                <tr>
                    <td colspan="8">Darel Martínez Caballero</td>
                </tr>
                <tr>
                    <td colspan="8">HOTELES</td>
                </tr>
                <tr>
                    <td>codHotel</td>
                    <td>numHabitacion</td>
                    <td>NomHotel</td>
                    <td>capacidad</td>
                    <td>preciodia</td>
                    <td>activa</td>
                    <td><button type="submit" onclick="formActionBaja()">Dar de baja</button></td></td>
                    <td><button type="submit" onclick="formActionActualizar()">Modificar</button></td></td>
                    </tr>';
                $idregistro= 0;
                foreach ($stmt as $row) {
                    echo '<tr>
                             <td>'.$row["codHotel"].'</td>'.
                             '<td>'.$row["nomHotel"].'</td>'.
                             '<td>'.$row["numHabitacion"].'</td>'.
                             '<td>'.$row["capacidad"].'</td>'.
                             '<td>'.$row["preciodia"].'</td>'.
                             '<td>'.$row["activa"].'</td>'.
                             '<td colspan="2" style="text-align:center"><input type="checkbox" id="'.$idregistro.'" name="'.$idregistro.'"></input></td>'.
                         '</tr>';
                    $idregistro++;
                }     
                echo '<td><select onchange="location = this.value;">';
                echo '<option selected="selected" value="fm_visualizacion.php">Procedimientos Almacenados</option>';
                echo '<option value="./procedimientos/lista_habitaciones_nomHotel.php">lista_habitaciones_nomHotel</option>';
                echo '<option value="./procedimientos/insertarHabitacion.php">insertarHabitacion</option>';
                echo '<option value="./procedimientos/cantidadHabitaciones.php">cantidadHabitaciones</option>';
                echo '</select></td>';
            
                echo '<td><select onchange="location = this.value;">';
                echo '<option selected="selected" value="fm_visualizacion.php">Funciones</option>';
                echo '<option value="./funciones/sumaTotalEstancias.php">sumaTotalEstancias</option>';
                echo '</select></td>';
                echo '<td colspan="5"></td>
                      <td colspan="2"><a href="fm_altaHabitacion.php"><button type="button">Alta habitación</button></a></td>';
               echo '</tr></table></form>';
?>