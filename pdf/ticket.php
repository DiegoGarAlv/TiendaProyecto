<?php 
	session_start();
	require('fpdf/fpdf.php');

class PDF extends FPDF
{

	// Cabecera de página
	function Header()
	{
		// Logo
    	$this->Image('../logo.png',10,8,33);
	    // Arial bold 15
	    $this->SetFont('Arial','B',15);
	    // Movernos a la derecha
	    $this->Cell(45);
	    // Título
	    $this->Cell(30,10,'WOODENOFFICE',0,0,'C');
	    // Salto de línea
        $this->Ln(20);

        $this->Cell(160,20,'Ticket de compra del usuario: '.$_SESSION['usuario'].'',0,0,'C');
	    // Salto de línea
	    $this->Ln(20);
	}

	// Tabla coloreada
	function FancyTable($header, $data, $precio, $unidades,$total)
	{
	    // Colores, ancho de línea y fuente en negrita
	    $this->SetFillColor(52,58,64);
	    $this->SetTextColor(255);
	    $this->SetDrawColor(52,58,64);
	    $this->SetLineWidth(.3);
	    $this->SetFont('Arial','B',12);
	    // Cabecera
	    $w = array(100, 25, 25, 25);
	    for($i=0;$i<count($header);$i++)
	        $this->Cell($w[$i],7,utf8_decode($header[$i]),1,0,'C',true);
	    $this->Ln();
	    // Restauración de colores y fuentes
	    $this->SetFillColor(191,191,191);
	    $this->SetTextColor(0);
	    $this->SetFont('');
	    // Datos
	    $fill = false;
	    foreach($data as $indice=>$valor)
	    {
	        $this->Cell($w[0],6,utf8_decode($data[$indice]),'TB',0,'L',$fill);
	        $this->Cell($w[1],6,utf8_decode($unidades[$indice]),'TB',0,'C',$fill);
	        $this->Cell($w[2],6,utf8_decode($precio[$indice]),'TB',0,'C',$fill);
	        $this->Cell($w[3],6,utf8_decode($precio[$indice]*$unidades[$indice]),'TB',0,'C',$fill);
	        $this->Ln();
	        $fill = !$fill;
	    }

	    // Línea de cierre
	    $this->Cell(array_sum($w),0,'','T');
	    $this->Ln();
	    $this->Cell(150,10,utf8_decode("TOTAL:"),'TB',0,'L',false);
	    $this->Cell(25,10,$total." ".chr(128),'TB',0,'C',false);
	    
	}

	// Pie de página
	function Footer()
	{
	    // Posición: a 1,5 cm del final
	    $this->SetY(-15);
	    // Arial italic 8
	    $this->SetFont('Arial','I',8);
	    // Número de página
	    $this->Cell(0,10,utf8_decode('Página ').$this->PageNo().'/{nb}',0,0,'C');
	}
}
    $pdf = new PDF();
   
	// Títulos de las columnas
	$header = array('Artículo', 'Unidades', 'Precio', 'Subtotal');
	// Carga de datos
	$data = $_SESSION["producto"];
	$precio = $_SESSION["precio"];
	$unidades = $_SESSION["unidades"];
	$total = $_SESSION["total"];
	$pdf->SetFont('Arial','B',14);
	$pdf->AddPage();
	$pdf->FancyTable($header,$data,$precio,$unidades,$total);
	$pdf->AliasNbPages();
	$pdf->Output();
 ?>