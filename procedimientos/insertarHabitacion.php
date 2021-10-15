<?php
    include '../conexionBD.php';

    function insertarHabitacion()
    {
        $pdo = conectaDb();
        $stmt = $pdo->prepare("call insertarHabitacion(?, ?, ?, ?, ?, @out1, @out2)");
        if(isset($_POST['codHotelOption']) &&
        isset($_POST['numHabitacionInput']) &&
        isset($_POST['capacidadInput']) &&
        isset($_POST['preciodiaInput']) 
        ){
            $codHotel=$_POST["codHotelOption"];
            $numHabitacion=$_POST["numHabitacionInput"];
            $capacidad=$_POST["capacidadInput"];
            $preciodia=$_POST["preciodiaInput"];
            if(isset($_POST["activaInput"])){
                $activa=1;

            }else {
                $activa =0;
            }

            $stmt -> bindParam(1, $codHotel, PDO::PARAM_STR);
            $stmt -> bindParam(2, $numHabitacion, PDO::PARAM_STR);
            $stmt -> bindParam(3, $capacidad, PDO::PARAM_INT);
            $stmt -> bindParam(4, $preciodia, PDO::PARAM_INT);
            $stmt -> bindParam(5, $activa, PDO::PARAM_BOOL);

            $stmt->execute();
        }
        $stmt = $pdo -> query('select @out1 as salida1, @out2 as salida2');
        $row = $stmt->fetch(); 
        
        echo '<table>
                <tr> 
                    <th>Salida1</th>
                    <th>Salida2</th>
                </tr>
                <tr>
                    <td>'.$row['salida1'].'</td>
                    <td>'.$row['salida2'].'</td>
                </tr>
              </table>';
    }
    echo '<form id="insertarHabitacion" method="POST" onload="insertarHabitacion()">
            <table>
                <tr>
                    <th><label for="codHotel">Código Hotel</label><br></th>
                    <th><label for="numHabitacion">numHabitacion</label><br></th>
                    <th><label for="capacidad">capacidad</label><br></th>
                    <th><label for="preciodia">preciodia</label><br></th>
                    <th><label for="activa">activa</label><br></th>
                </tr>
                <tr>
                    <td><select name="codHotelOption" id="codHotelOption">';
                    $pdo = conectaDb();
                    $stmt = $pdo -> query('SELECT codHotel, nomHotel FROM hoteles');
                    foreach ($stmt as $row) {
                        echo '<option value="'.$row["codHotel"].'"  id="'.$row["codHotel"].'" name="'.$row["codHotel"].'">'.$row["codHotel"].'+'.$row["nomHotel"].'</option>';
                    }
                    echo '</select></td>
                    <td><input type="text" id="numHabitacionInput" name="numHabitacionInput" minlength="1" maxlength="4" value="Ej: 501" required></td>
                    <td><input type="number" id="capacidadInput" name="capacidadInput" min="1" max="255" value="Ej: 4" required></td>
                    <td><input type="number" id="preciodiaInput" name="preciodiaInput" min="-128" max="255"  required></td>
                    <td><input type="checkbox" id="activaInput" name="activaInput" check=""></td>
                    <td><button type="submit">Ejecutar Procedimiento</button></td>
                </tr>
            </table>
          </form> ';

    insertarHabitacion();
    echo '<br><a href="./../fm_visualizacion.php"><button>Volver</button></a>';

?>