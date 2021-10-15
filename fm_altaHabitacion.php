<?php
    include './conexionBD.php';
    try {
        echo '<link rel="stylesheet" href="estilos.css" type="text/css">';
        $pdo = conectaDb();
        $stmt = $pdo -> query('SELECT codHotel, nomHotel FROM hoteles');
        $insertNewHotel = $pdo->prepare("INSERT INTO habitaciones (codHotel, numHabitacion, capacidad, preciodia, activa) VALUES (:codHotel, :numHabitacion, :capacidad, :preciodia, :activa)");
        function form($insertNewHotel, $activa)
        {
            $codHotel = $_POST["codHotel"];
            $numHabitacion=$_POST["numHabitacion"];
            $capacidad = $_POST["capacidad"];
            $preciodia = $_POST["preciodia"];

            $insertNewHotel->bindParam(':codHotel', $codHotel, PDO::PARAM_STR);
            $insertNewHotel->bindParam(':numHabitacion', $numHabitacion, PDO::PARAM_STR);
            $insertNewHotel->bindParam(':capacidad', $capacidad, PDO::PARAM_INT);
            $insertNewHotel->bindParam(':preciodia', $preciodia, PDO::PARAM_INT);
            $insertNewHotel->bindParam(':activa', $activa, PDO::PARAM_INT);
            $insertNewHotel -> execute();

            echo "                  Se han añadido nuevos campos";
        }
   
        echo '<form action="fm_altaHabitacion.php" method="POST" onload="form()">
            <table border="2">
                <tr>
                    <td colspan="8">Darel Martínez Caballero</td>
                </tr>
                <tr>
                    <td colspan="8">HOTELES</td>
                </tr>
                <tr>
                    <td>codHotel+nomHotel</td>
                    <td>numHabitacion</td>
                    <td>capacidad</td>
                    <td>preciodia</td>
                    <td>activa</td>
                </tr>';
        echo '<tr>
                        <td>
                            <select name="codHotel" id="codHotel" required>';
        foreach ($stmt as $row) {
            echo '<option value="'.$row["codHotel"].'"  id="'.$row["codHotel"].'" name="'.$codHotel["codHotel"].'">'.$row["codHotel"].'+'.$row["nomHotel"].'</option>';
        }
        echo '</select>';
        echo '</td>
                        <td><input type="text" class="inputs" id="numHabitacion" name="numHabitacion"  maxlength="4" required></td>
                        <td><input type="number" class="inputs" id="capacidad" name="capacidad" min="1" max="127" required></td>
                        <td><input type="number" class="inputs" id="preciodia" name="preciodia" min="1" max="2147483647" required></td>
                        <td><input type="checkbox" title="el valor debe ser 0 o 1" class="inputs" id="activa" name="activa" checked></td>
                     </tr>';
        echo '</tr>
                        <td colspan="4"></td>
                        <td><button type="submit">Alta habitación</button></td>
                      </tr>
            </table>
          </form>';
        echo '<a href="./fm_visualizacion.php"><button>Volver</button></a>';
        $activa=null;
        if (isset($_POST['codHotel'])|| isset($_POST['numHabitacion']) || isset($_POST['capacidad']) || isset($_POST['preciodia']) || isset($_POST['activa'])) {
            if (isset($_POST['activa'])) {
                $activa = 1;
            } else {
                $activa = 0;
            }
            form($insertNewHotel, $activa);
        }
    } catch (Exception $e) {
        echo " No se han insertado los campos";
    }
?>