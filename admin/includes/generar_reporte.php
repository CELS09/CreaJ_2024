<?php
require('../includes/fpdf.php'); // Ajusta la ruta según sea necesario

class PDF extends FPDF
{
    // Sobrescribimos el método Header para que el encabezado aparezca en cada página
    function Header()
    {
        // Agregar la imagen en la esquina superior izquierda
        $this->Image('../../assets/images/WorkFusion.png', 10, 6, 30);

        // Configurar la fuente y color para el texto del encabezado
        $this->SetFont('Arial', 'B', 16);
        $this->SetTextColor(0, 102, 204); // Color azul para el texto
        $this->Cell(0, 10, 'WorkFusion', 0, 1, 'R');

        // Agregar un espacio después del encabezado
        $this->Ln(10);

        // Agregar el botón de regresar al inicio del PDF con más estilo
        $this->SetFont('Arial', 'U', 16); // Cambiar a subrayado
        $this->SetTextColor(0, 0, 255); // Color azul para el enlace

        // Obtener el ancho del enlace
        $link_text = 'Regresar a Dashboard';
        $width = $this->GetStringWidth($link_text);

        // Posición del enlace
        $x = ($this->GetPageWidth() - $width) / 2;
        $y = $this->GetY();

        // Imprimir el texto del enlace
        $this->SetXY($x, $y);
        $this->Cell($width, 10, $link_text, 0, 1, 'C', false, 'http://localhost/CreaJ_2024/admin/dashboard.php');

        // Volver al color negro para el texto restante
        $this->SetTextColor(0, 0, 0); 
        $this->Ln(5); // Espacio después del enlace
    }
}

// Crear una instancia del objeto PDF
$pdf = new PDF('L', 'mm', 'A4'); // 'L' para orientación horizontal (Landscape)
$pdf->AddPage();


// Aquí continúa el código original

// Conectar a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "workfusion";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Función para agregar una tabla al PDF
function addTable($pdf, $header, $data, $widths)
{
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->SetFillColor(200, 220, 255);

    // Crear cabeceras de tabla con ancho personalizado
    foreach ($header as $key => $col) {
        $pdf->Cell($widths[$key], 10, $col, 1, 0, 'C', true);
    }
    $pdf->Ln();

    $pdf->SetFont('Arial', '', 12);

    // Crear contenido de tabla
    foreach ($data as $row) {
        foreach ($row as $key => $col) {
            $pdf->Cell($widths[$key], 10, $col, 1);
        }
        $pdf->Ln();
    }
}

// Obtener la cantidad de empleados
$sql = "SELECT COUNT(*) AS total_employees FROM tblemployees";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$total_employees = $row['total_employees'];

$pdf->SetFont('Arial', 'B', 14);
$pdf->SetTextColor(0, 0, 0); // Asegurarse de que el texto sea negro
$pdf->Cell(0, 10, "Cantidad de Empleados: $total_employees", 0, 1);
$pdf->Ln(4);

// Obtener la cantidad de departamentos
$sql = "SELECT COUNT(*) AS total_departments FROM tbldepartments";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$total_departments = $row['total_departments'];

$pdf->Cell(0, 10, "Cantidad de Departamentos: $total_departments", 0, 1);
$pdf->Ln(4);

// Obtener la cantidad de licencias
$sql = "SELECT COUNT(*) AS total_leaves FROM tblleaves";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$total_leaves = $row['total_leaves'];

$pdf->Cell(0, 10, "Cantidad de Tipos de Permisos: $total_leaves", 0, 1);
$pdf->Ln(10);

// Obtener las últimas aplicaciones de licencia
$sql = "SELECT LeaveType, FromDate, ToDate FROM tblleaves ORDER BY PostingDate DESC LIMIT 10";
$result = $conn->query($sql);

$data = [];
while ($row = $result->fetch_assoc()) {
    $data[] = [$row['LeaveType'], $row['FromDate'], $row['ToDate']];
}

$pdf->SetFont('Arial', 'B', 14);
$pdf->SetTextColor(0, 0, 0); // Asegurarse de que el texto sea negro
$pdf->Cell(0, 10, "Ultimos Tipos de Permisos Agregados", 0, 1);
$pdf->Ln(5);

$header = ['Tipo de Licencia', 'Fecha de Inicio', 'Fecha de Fin'];
$widths = [60, 60, 60]; // Anchos personalizados para cada columna
addTable($pdf, $header, $data, $widths);

// Obtener todos los datos de empleados
$sql = "SELECT * FROM tblemployees";
$result = $conn->query($sql);

$employee_data = [];
while ($row = $result->fetch_assoc()) {
    $employee_data[] = [
        $row['EmpId'],
        $row['FirstName'],
        $row['LastName'],
        $row['EmailId'],
        $row['Department'],
        $row['RegDate']
    ];
}
$pdf->Ln(10);

$pdf->SetFont('Arial', 'B', 14);
$pdf->SetTextColor(0, 0, 0); // Asegurarse de que el texto sea negro
$pdf->Cell(0, 10, "Detalles de Empleados", 0, 1);
$pdf->Ln(5);

$header = ['ID', 'Nombre', 'Apellido', 'Email', 'Departamento', 'Fecha de Registro'];
$widths = [30, 40, 40, 60, 60, 50]; // Anchos personalizados para cada columna
addTable($pdf, $header, $employee_data, $widths);

// Obtener todos los datos de departamentos
$sql = "SELECT * FROM tbldepartments";
$result = $conn->query($sql);

$department_data = [];
while ($row = $result->fetch_assoc()) {
    $department_data[] = [
        $row['DepartmentName'],
        $row['DepartmentShortName'],
        $row['DepartmentCode'],
        $row['CreationDate']
    ];
}
$pdf->Ln(10);

$pdf->SetFont('Arial', 'B', 14);
$pdf->SetTextColor(0, 0, 0); // Asegurarse de que el texto sea negro
$pdf->Cell(0, 5, "Detalles de Departamentos", 0, 1);
$pdf->Ln(5);

$header = ['Nombre', 'Nombre Corto', 'Codigo', 'Fecha de Creacion'];
$widths = [60, 50, 50, 60]; // Anchos personalizados para cada columna
addTable($pdf, $header, $department_data, $widths);

// Obtener todos los datos de tipos de licencia
$sql = "SELECT * FROM tblleavetype";
$result = $conn->query($sql);

$leave_type_data = [];
while ($row = $result->fetch_assoc()) {
    $leave_type_data[] = [
        $row['LeaveType'],
        $row['Description'],
        $row['CreationDate']
    ];
}
$pdf->Ln(30);

$pdf->SetFont('Arial', 'B', 14);
$pdf->SetTextColor(0, 0, 0); // Asegurarse de que el texto sea negro
$pdf->Cell(0, 5, "Detalles de Tipos de Permisos", 0, 1);
$pdf->Ln(5);

$header = ['Tipo de Licencia', 'Descripcion', 'Fecha de Creacion'];
$widths = [60, 90, 60]; // Anchos personalizados para cada columna
addTable($pdf, $header, $leave_type_data, $widths);

// Agregar el pie de página con líneas para firmas
$pdf->SetY(-50); // Posicionar a 50 mm del fondo de la página
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(0, 10, '_____________________________________                  _____________________________________', 0, 1, 'C');
$pdf->Cell(0, 10, 'Firma del Gerente                                                         Firma del Empleado', 0, 1, 'C');
// LO AGREGUE 2 VECES PARA QUE SE VEA EN NEGRITA 
$pdf->SetY(-50); // Posicionar a 50 mm del fondo de la página
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(0, 10, '_____________________________________                  _____________________________________', 0, 1, 'C');
$pdf->Cell(0, 10, 'Firma del Gerente                                                         Firma del Empleado', 0, 1, 'C');

// Cerrar la conexión
$conn->close();

// Salida del PDF
$pdf->Output();
?>
