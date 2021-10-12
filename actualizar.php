<?php
  include './conexionBD.php';
  echo '<link rel="stylesheet" href="estilos.css" type="text/css">';
  
  $db = conectaDb();
  $stmt = $db -> query('SELECT * FROM habitaciones INNER JOIN hoteles on hoteles.codHotel=habitaciones.codHotel');

  echo '<form action="modificarRegistros.php" method="POST" id="actualizar" >
  <table border="2">
      <tr>
          <td colspan="8">Darel Martínez Caballero mod</td>
      </tr>
      <tr>
          <td colspan="8">HOTELES</td>
      </tr>
      <tr>
          <td>codHotel</td>
          <td>numHabitacion</td>
          <td>capacidad</td>
          <td>preciodia</td>
          <td>activa</td>
      </tr>';
  
      $i = 0;
      $idregistro= 0;
  foreach ($stmt as $row) {
      $check = $row["activa"];
      if (isset($_POST[$i])) {
          $stmt2 = $db -> query('SELECT codHotel, nomHotel FROM hoteles');
          echo '<input style="visibility:hidden;width:0px;height0px;" type="text" id="codHotelOld'.$idregistro.'" name="codHotelOld'.$idregistro.'" value="'.$row["codHotel"].'" >'.
        '<input style="visibility:hidden;width:0px;height0px;" type="text" id="numHabitacionOld'.$idregistro.'" name="numHabitacionOld'.$idregistro.'" value="'.$row["numHabitacion"].'" value="'.$row["numHabitacion"].'">';
          echo '<td><select name="codHotel'.$idregistro.'" id="codHotel'.$idregistro.'">';
          foreach ($stmt2 as $row2) {
              if ($row2["codHotel"]==$row["codHotel"]) {
                  echo '<option value="'.$row2["codHotel"].'"  id="codHotel'.$row2["codHotel"].'" name="codHotel" selected="selected">'.$row2["codHotel"];
              } else {
                  echo '<option value="'.$row2["codHotel"].'"  id="codHotel'.$row2["codHotel"].'" name="codHotel">'.$row2["codHotel"];
              };
              echo '</option>';
          }
          echo '</select></td>';
          echo
                        '<td><input type="text" id="numHabitacion'.$idregistro.'" name="numHabitacion'.$idregistro.'"  value="'.$row["numHabitacion"].'"></td>'.
                        '<td><input type="text" id="capacidad'.$idregistro.'" name="capacidad'.$idregistro.'" value="'.$row["capacidad"].'" ></td>'.
                        '<td><input type="text" id="preciodia'.$idregistro.'" name="preciodia'.$idregistro.'" value="'.$row["preciodia"].'"></td>';
          if ($row["activa"]==1) {
              $check = 'checked';
          } else {
              $check = '';
          }
          echo '<td><input type="checkbox" id="activa'.$idregistro.'" name="activa'.$idregistro.'" '.$check.'></td>'.
                     '</tr>';
          $idregistro++;
      }
      $i++;
  }
  
              
  echo '</tr>
  <td colspan="4"></td>
  <td><a href="modificarRegistros.php"><button type="submit">Modificar registros</button></a></td>
</tr>
</table> 
</form>';
  echo '<a href="fm_visualizacion.php"><button type="button">Volver</button></a>';
?>



