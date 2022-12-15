<?php
    include ("./fpdf/fpdf.php");
    include ("conexion.php");
    class PDF extends FPDF 
    {
        function Header()
        {
            $this->SetFont('Arial','B',20);
            $this->Cell(160, 50, utf8_decode('REPORTE DE USUARIOS'),0, 0, "C");
            $this->Image('../img/TESSFP.png',10,10,50);
            $this->SetFont("Arial", "", 10);
            $this->Cell(25, 5, "Fecha: ". date("d/m/Y"), 0, 1, "C");
            $this->Ln(30);
        }
        function ImprimirTexto($file)
        {
            $txt = file_get_contents($file);
            $this->SetFont('Arial','',12);
            $this->MultiCell(0,5,$txt);
        }

        Function Footer()
        {
            $this->SetY(-15);
            $this->SetFont('Arial','I',12);
            $this->Cell(0,10,utf8_decode('Página ').$this->PageNo().'/{nb}',0,0,'C');
        }
    }
    $pdf=new PDF('P', 'mm', 'Letter');
    $pdf->SetMargins(25, 15);
    $pdf->AliasNbPages();
    $pdf->AddPage();

    $pdf->SetTextColor(0x00, 0x00, 0x00);
    $pdf->SetFont("Arial", "b", 12);

    $query = 'SELECT *FROM datos order by id';
    $result = mysqli_query($conexion,$query);
    if (!$result)
    {
        die(mysql_error($conexion));
    }

    $pdf->Ln(10);

    $pdf->Cell(15,10,'Id',1,0,"C");
    $pdf->Cell(35,10,'Clave',1,0,"C");
    $pdf->Cell(35,10,'Nombre',1,0,"C");
    $pdf->Cell(35,10,'Edad',1,1,"C");
    $contador=0;
    while($row = mysqli_fetch_array($result))
    {
        $pdf->Cell(15,10,$row[0],1,0,"C");
        $pdf->Cell(35,10,$row[1],1,0,"C");
        $pdf->Cell(35,10,utf8_decode($row[2]),1,0,"C");
        $pdf->Cell(35,10,utf8_decode($row[3]),1,1,"C");
        $contador++;
    }
    $pdf->Ln();
    $pdf->Output();
?>