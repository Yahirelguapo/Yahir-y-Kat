<?php

require "conexion.php";
require "plantilla.php";


$Nombre = $_POST['Nombre'];

$sql = "SELECT ID_Paciente, Nombre, Sexo, Edad, HR, SPO2 FROM datos WHERE Nombre LIKE '$Nombre'";
$resultado = $mysqli -> query($sql);

$resultado = $mysqli -> query($sql);




$pdf = new PDF("P", "mm", "letter");
    $pdf->AliasNBPages();
    $pdf->AddPage();
    $pdf->SetFont("Arial", "B", 12);
    $pdf->Ln(20);
    $pdf->Cell(190, 5, "DIAGNOSTICO", 0, 1, "C");
    
    $pdf->Ln(10);


        while ($fila = $resultado ->fetch_assoc()) {
     $pdf->Cell(30,5,"ID_Paciente: ",0,1,"C");
        $pdf->Cell(65,-5,$fila['ID_Paciente'],0,1,"C");
    
    $pdf->Ln(10);

    $pdf->Cell(23,5,"Nombre: ",0,1,"C");
        $pdf->Cell(100,-5,$fila['Nombre'],0,1,"C");


    $pdf->Ln(8); 

    $pdf->Cell(300,-30,"Sexo: ",0,1,"C");
        $pdf->Cell(337,30,$fila['Sexo'],0,1,"C");


    $pdf->Ln(10);    

    $pdf->Cell(300,-30,"Edad: ",0,1,"C");
        $pdf->Cell(320,30,$fila['Edad'],0,1,"C");




$pdf->Ln(10);


    $pdf->Cell(60,10,"Ritmo Cardiaco",1,0,"C");
        $pdf->Cell(30,10,$fila['HR'],1,0,"C");



    $pdf->Ln(10);  

    $pdf->Cell(60,10,"Oxigenacion en la Sangre",1,0,"C");
        $pdf->Cell(30,10,$fila['SPO2'],1,0,"C");


    }




//enfermedades
$sqlrecomendacion = "SELECT * FROM valores WHERE Nombre = '$Nombre'";
$resultado2 = $mysqli -> query($sqlrecomendacion);
$resultado2 = $mysqli -> query($sqlrecomendacion);

//consulta2
    while ($fila = $resultado2 ->fetch_assoc()) {

 $ritmo = $fila['HR'];
 $oxigenacion = $fila['SPO2'];
 





    $pdf->Ln(20);


$pdf->Ln(10);

$pdf->Cell(190, 5, "POSIBLES ENFERMEDADES", 0, 1, "C");

$pdf->Ln(10);


//TAQUICARDIA

$sen = (($ritmo >= 101 && $ritmo <= 130) && ($oxigenacion >= 101 && $oxigenacion <= 130)) ? "Puedes padecer de taquicardia" : "NO";
    if ($sen == "Puedes padecer de taquicardia") {
        $pdf->Cell(80, -5, $sen, 0, 1, 'RIGHT');
    } else { 
    }


//BRAQUICARDIA

$sen = (($ritmo >= 0 && $ritmo <= 60) && ($oxigenacion >= 0 && $oxigenacion <= 60)) ? "Puedes padecer de BRAQUICARDIA" : "NO";
    if ($sen == "Puedes padecer de taquicardia") {
        $pdf->Cell(80, -0, $sen, 0, 1, 'RIGHT');
    } else { 
    }

$pdf->Ln(5);  


//COVID 19
$sen = (($ritmo >= 120 && $ritmo <= 150) && ($oxigenacion >= 60 && $oxigenacion <= 93)) ? "Puedes padecer de posible COVID - 19" : "NO";
   if ($sen == "Puedes padecer de posible COVID - 19") {
        $pdf->Cell(80, 5, $sen, 0, 1, 'RIGHT');
    } else {

    }

//VALIDAR SI ESTA BIEN DE SALUD
$sen = (($ritmo >= 60 && $ritmo <= 100) && ($oxigenacion >= 75 && $oxigenacion <= 100)) ? "Ritmo cardiaco y oxigenacion en la sangre estables -> NO PADECES DE NINGUNA ENFERMEDAD" : "NO";
    if ($sen == "Ritmo cardiaco y oxigenacion en la sangre estables -> NO PADECES DE NINGUNA ENFERMEDAD") {
        $pdf->Cell(200, -5, $sen, 0, 1, 'RIGHT');
    } else { 

    }


    $pdf->Ln(50); 



    }





    //RECOMENDACIONES



$pdf->Ln(10);

$pdf->Cell(190, 5, "RECOMENDACIONES", 0, 1, "C");

$pdf->Ln(10);




//VALIDAR SUGERENCIA DE SALUD
$sen = (($ritmo >= 60 && $ritmo <= 100) && ($oxigenacion >= 75 && $oxigenacion <= 100)) ? "Sin ninguna recomendacion" : "NO";
    if ($sen == "Sin ninguna recomendacion") {
        $pdf->Cell(200, -5, $sen, 0, 1, 'RIGHT');
    } else { 
        
    }



//VALIDAR SUGERENCIA DE TAQUICARDIA


$sen = (($ritmo >= 101 && $ritmo <= 130) && ($oxigenacion >= 101 && $oxigenacion <= 130)) ? "Mantenerse hidratado" : "NO";
    if ($sen == "Mantenerse hidratado") {
        $pdf->Cell(80, 5, $sen, 0, 1, 'RIGHT');
    } else { 
    }

$sen = (($ritmo >= 101 && $ritmo <= 130) && ($oxigenacion >= 101 && $oxigenacion <= 130)) ? "Hacer ejercicio regularmente" : "NO";
    if ($sen == "Hacer ejercicio regularmente") {
        $pdf->Cell(80, 5, $sen, 0, 1, 'RIGHT');
    } else { 
    }

$sen = (($ritmo >= 101 && $ritmo <= 130) && ($oxigenacion >= 101 && $oxigenacion <= 130)) ? "Realizar tecnicas de relajacion" : "NO";
    if ($sen == "Realizar tecnicas de relajacion") {
        $pdf->Cell(80, 5, $sen, 0, 1, 'RIGHT');
    } else { 
    }



    $pdf->output();

