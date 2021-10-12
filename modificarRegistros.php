<?php
    include './conexionBD.php';
    echo '<link rel="stylesheet" href="./estilos.css" type="text/css">';
    
    $db = conectaDb();
    $stmt = $db -> query('SELECT * FROM habitaciones');

    $i = 0;
    try {
        foreach ($stmt as $row) {
            if (isset($_POST['codHotel'.$i])) {
                $sql = "UPDATE habitaciones SET codHotel=?,numHabitacion=?,capacidad=?, preciodia=?, activa=?
                                            WHERE codHotel=? && numHabitacion=?";
                $statement =$db -> prepare($sql);
                $codHotel = $_POST['codHotel'.$i];
                $codHotelOld = $_POST['codHotelOld'.$i];
                $numHabitacionOld = $_POST['numHabitacionOld'.$i];
                $numHabitacion = $_POST['numHabitacion'.$i];
                $capacidad = $_POST['capacidad'.$i];
                $preciodia = $_POST['preciodia'.$i];
                
                if (isset($_POST['activa'.$i])) {
                    $activa = 1;
                } else {
                    $activa = 0;
                }
                
                $statement -> execute([$codHotel,$numHabitacion,$capacidad, $preciodia, $activa, $codHotelOld, $numHabitacionOld]);
                
                echo "El registro: codHotel( ";
                echo $codHotel;
                echo " ) numHabitacion( ";
                echo $numHabitacion;
                echo " ) capacidad( ";
                echo $capacidad;
                echo " ) preciodia ( ";
                echo $preciodia;
                echo " ) activa( ";
                echo $activa;
                echo " ) Se a ACTUALIZADO<br>";
            }
            $i++;
        }
    } catch (Exception $e) {
        echo "El registro: codHotel( ";
        echo $codHotel;
        echo " ) numHabitacion( ";
        echo $numHabitacion;
        echo " ) capacidad( ";
        echo $capacidad;
        echo " ) preciodia ( ";
        echo $preciodia;
        echo " ) activa( ";
        echo $activa;
        echo " ) no se a podido ACTUALIZAR<br>";
    }
    echo '<br><a href="fm_visualizacion.php"><button type="button">Volver</button></a>';
?>