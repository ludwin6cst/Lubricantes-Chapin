<?php
require('fpdf/fpdf.php');
require 'Connection.php'; // Conexión a la base de datos

class PDF extends FPDF
{
    function Header()
    {
        // Logo
        $this->Image('img/logo.png', 10, 6, 30);
        $this->SetFont('Arial', 'B', 16);
        $this->Cell(0, 10, utf8_decode('Lista de Productos - Lubricantes Chapin'), 0, 1, 'C');
        $this->Ln(20); 
    }

    function Footer()
    {
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, 'Pagina ' . $this->PageNo(), 0, 0, 'C');
    }

    function ProductTable($Conn)
    {
        // Encabezado de la tabla con colores azul y amarillo
        $this->SetFont('Arial', 'B', 10);
        $this->SetFillColor(0, 153, 204); // Azul
        $this->SetTextColor(255, 255, 255); // Texto blanco
        $this->Cell(90, 10, utf8_decode('Nombre'), 1, 0, 'C', true); // Se mantiene el ancho de la columna de nombre
        $this->Cell(30, 10, 'Precio', 1, 0, 'C', true);
        $this->Cell(30, 10, 'Stock', 1, 0, 'C', true);
        $this->Cell(30, 10, 'Marca', 1, 1, 'C', true); // Se añade la columna "Marca"

        // Datos de la tabla con color alterno amarillo
        $this->SetFont('Arial', '', 10);
        $sql = "SELECT nombre, precio, stock, marca FROM tbl_products"; // Ajustada la consulta para incluir 'marca'
        $Resulta = mysqli_query($Conn, $sql);
        $fill = false;

        while ($Rows = mysqli_fetch_array($Resulta)) {
            $this->SetFillColor(255, 255, 0); // Amarillo para las filas
            $this->SetTextColor(0, 0, 0); // Texto negro

            // Corregir la codificación de los nombres y otros campos
            $this->Cell(90, 10, utf8_decode($Rows['nombre']), 1, 0, 'C', $fill);
            $this->Cell(30, 10, '$' . number_format($Rows['precio'], 2), 1, 0, 'C', $fill);
            $this->Cell(30, 10, $Rows['stock'], 1, 0, 'C', $fill);
            $this->Cell(30, 10, utf8_decode($Rows['marca']), 1, 1, 'C', $fill); // Mostramos la marca

            $fill = !$fill; // Alterna el color de fondo
        }
    }
}

$pdf = new PDF();
$pdf->AddPage();
$pdf->ProductTable($Conn);
$pdf->Output('D', 'productos.pdf');
?>