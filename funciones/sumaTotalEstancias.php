<?php
    include '../conexionBD.php';
    echo '<link rel="stylesheet" href="estilos.css" type="text/css">';
    function funcSumaTotalEstancias()
    {
        $pdo = conectaDb();
        $coddnionie = "";
        $stmt = $pdo->prepare("select sumaTotalEstancias(?)");
        if(isset($_POST["coddnionieInput"])){
            $coddnionie=$_POST["coddnionieInput"];
        }
        $stmt -> bindParam(1, $coddnionie, PDO::PARAM_STR);
        $stmt->execute();
        echo '<table border="2">';
        echo '<tr>';
        echo '<th>sumaTotalEstancias</th>';
        echo '</tr>';
        foreach ($stmt as $row) {
            echo '<tr>';
            echo '<td>'.$row[0].'</td>';
            echo '</tr>';
        }
        echo '</table>';
    }
    echo '<form id="formSumaTotalEstancias" method="POST" onload="funcSumaTotalEstancias()-">
            <table>
                <tr>
                    <th><label for="coddnionie">Codigo de DNI o NIE</label><br></th>
                </tr>
                <tr>
                    <td><input type="text" id="coddnionieInput" name="coddnionieInput" value="Ej: 20304050G"></td>
                    <td><input type="submit" value="Ejecutar Función"></td>
                </tr>
            </table>
          </form> ';

          funcSumaTotalEstancias();
    echo '<br><br><a href="./../fm_visualizacion.php"><button>Volver</button></a>';
?>


