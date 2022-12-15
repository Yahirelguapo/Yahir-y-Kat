

<?php

require "Conexion.php";

$sql = "SELECT Nombre FROM datos";
$resultado = $mysqli->query($sql);

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/jquery.dataTables.min.css">
    <title>Reporte</title>
</head>

<body background="img/1654625669417.gif" bgcolor="FFCECB">

    <h2>INFORMACION DEL PACIENTE</h2>
<div class="div-1" class="col-11">
    <?php
        require "Conexion.php";

        $Nombre = $_POST['Nombre'];

        $sql = "SELECT ID_Paciente, Nombre, Sexo, Edad, HR, SPO2 FROM datos WHERE Nombre LIKE '$Nombre'";
        $resultado = $mysqli -> query($sql);


while ($fila = $resultado ->fetch_assoc())
        {
            echo'<tr>
               <label>ID_Paciente: </label>
               <label id="Paciente">'.$fila['ID_Paciente'].'</label>

                <br>
                <label name="Nombre"> Nombre: </label>
                <label>'.$fila['Nombre'].'</label>
                <br>
                <label>Sexo: </label>
                <td>'.$fila['Sexo'].'</td>
                <br>
                <label>Edad: </label>
                <td>'.$fila['Edad'].'</td>
                <br>
                <label>Ritmo Cardiaco: </label>
                <td>'.$fila['HR'].'</td>
                <br>
                <label>Oxigenacion: </label>
                <td>'.$fila['SPO2'].'</td>
            
            </tr>';
        }

?>
 <br />
  <br />
   <br />
</div>

<div  id="formulario2" class="btn btn-danger">


<?php

require "conexion.php";

$sql = "SELECT Nombre FROM valores";
$resultado = $mysqli->query($sql);

?>

    <form action="reporte.php" method="post" autocomplete="off">

        Selecciona el Nombre del Paciente
        
        <select id="Nombre" name="Nombre">
            <option value="">Selecciona una opcion</option>
            <?php while ($fila = $resultado->fetch_assoc()) { ?>
                <option value="<?php echo $fila['Nombre']; ?>"><?php echo $fila['Nombre']; ?></option>
            <?php } ?>
        </select>

        <br />
          <div class="col-6">
        <button type="submit" class="btn btn-primary"> Generar Reporte PDF</button>
        </div>
    </form>


</div>
<br />
<br />
<br />
     
<br />
<br />
<br />
<br />


</body>

</html>