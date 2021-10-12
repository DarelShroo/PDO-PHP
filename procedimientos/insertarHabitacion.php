<?php
    include '../conexionBD.php';
    function insertarHabitacion()
    {
        $pdo = conectaDb();
        $stmt = $pdo->prepare("call insertarHabitacion(?, ?, ?, ?, ?, @out1, @out2)");
        if(isset($_POST['codHotelInput']) &&
        isset($_POST['numHabitacionInput']) &&
        isset($_POST['capacidadInput']) &&
        isset($_POST['preciodiaInput']) 
        ){
            $codHotel=$_POST["codHotelInput"];
            $numHabitacion=$_POST["numHabitacionInput"];
            $capacidad=$_POST["capacidadInput"];
            $preciodia=$_POST["preciodiaInput"];
            if(isset($_POST["activaInput"])){
                $activa=1;

            }else {
                $activa =0;
            }
            $stmt->execute([$codHotel,$numHabitacion, $capacidad, $preciodia, $activa]);
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
                    <td><input type="text" id="codHotelInput" name="codHotelInput" value="Ej: 002"></td>
                    <td><input type="text" id="numHabitacionInput" name="numHabitacionInput" value="Ej: 501"></td>
                    <td><input type="text" id="capacidadInput" name="capacidadInput" value="Ej: 4"></td>
                    <td><input type="text" id="preciodiaInput" name="preciodiaInput" value="Ej: 20"></td>
                    <td><input type="checkbox" id="activaInput" name="activaInput" check=""></td>
                    <td><input type="submit" value="Ejecutar Procedimiento"></td>
                </tr>
            </table>
          </form> ';

    insertarHabitacion();
    echo '<br><a href="./../fm_visualizacion.php"><button>Volver</button></a>';

?>