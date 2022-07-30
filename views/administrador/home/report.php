<?php

use Dompdf\Dompdf;
use Dompdf\Option;
use Dompdf\Exception as DomException;
use Dompdf\Options;


$contenido =
  '<!DOCTYPE html>
                  <html>
                    <head>
                    </head>
                    <body>
                         <h1>REPORTE DE PDF report</h1>
                    </body>
                  </html>';
// Nombre del pdf
$filename = 'reporte.pdf';

// Opciones para prevenir errores con carga de imágenes
$options = new Options();
$options->set('isRemoteEnabled', true);

// Instancia de la clase
$dompdf = new Dompdf($options);

// Cargar el contenido HTML
$dompdf->loadHtml($contenido);

// Formato y tamaño del PDF
$dompdf->setPaper('A4', 'portrait');

// Renderizar HTML como PDF
$dompdf->render();

// Salida para descargar
$dompdf->stream($filename, ['Attachment' => true]);

?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  <style>
    h2{
      font-family: Verdana, Geneva, Tahoma, sans-serif;
      text-align: center;
    }
    table{
      font-family: Arial, Helvetica, sans-serif;
      border-collapse: collapse;
      width: 80%;
    }

    td,th{
      border: 1px solid #444;
      padding: 8px;
      text-align: left;
    }

    .my-table{
      text-align: right;
    }

    #sing{
      padding-top: 50px;
      text-align: right;
    }

  </style>

  <table>
    <thead>
      <tr>
        <th>ID</th>
        <th>ID</th>
        <th>ID</th>
        <th>ID</th>
        <th>ID</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td colspan="4" class="my-table">1</td>
        <td colspan="4" class="my-table">2</td>
        <td colspan="4" class="my-table">3</td>
        <td colspan="4" class="my-table">4</td>
        <td colspan="4" class="my-table">5</td>
      </tr>
    </tbody>
  </table>
</body>
</html>
