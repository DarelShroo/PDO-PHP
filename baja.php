<?php
    include './conexionBD.php';
    echo '<link rel="stylesheet" href="estilos.css" type="text/css">';
    
    $db = conectaDb();
    $stmt = $db -> query('SELECT * FROM habitaciones INNER JOIN hoteles on hoteles.codHotel=habitaciones.codHotel');
    
    $i = 0;

    foreach ($stmt as $row) {
        if (isset($_POST[$i])) {
            try {
                $sql = "DELETE FROM habitaciones WHERE codHotel=:codhotel && numHabitacion =:numhabitacion";
                $statement = $db -> prepare($sql);
                $codHotel = $row['codHotel'];
                $numHabitacion = $row['numHabitacion'];
                $statement->bindParam('codhotel', $codHotel, PDO::PARAM_STR);
                $statement->bindParam('numhabitacion', $numHabitacion, PDO::PARAM_STR);
                $statement -> execute();
                

                echo "El registro: codHotel( ";
                echo $row['codHotel'];
                echo " ) numHabitacion( ";
                echo $row['numHabitacion'];
                echo " ) capacidad( ";
                echo $row['capacidad'];
                echo " ) preciodia ( ";
                echo $row['preciodia'];
                echo " ) activa( ";
                echo $row['activa'];
                echo " ) Se a eliminado<br>";
            } catch (Exception $e) {
                echo "El registro: codHotel( ";
                echo $row['codHotel'];
                echo " ) numHabitacion( ";
                echo $row['numHabitacion'];
                echo " ) capacidad( ";
                echo $row['capacidad'];
                echo " ) preciodia ( ";
                echo $row['preciodia'];
                echo " ) activa( ";
                echo $row['activa'];
                echo " ) no se a podido eliminar<br>";
            }
        }
        $i++;
    }
    echo '<br><a href="fm_visualizacion.php"><button type="button">Volver</button></a>';
?>