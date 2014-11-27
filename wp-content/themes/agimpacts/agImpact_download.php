<?php

require('../../../wp-load.php');
global $wpdb;
// This needs to be set, in order for the script work, 
//in the case when the request variable is empty, throws 
//an e_notice of the empty array
//error_reporting(0);


require_once ("/lib/PHPExcel/PHPExcel.php");
//    require_once("conexion/conexion.php");
//    $conexion = new mysqli('localhost','root','','agimpacts',3306);
//    if (mysqli_connect_errno()) {
//        printf("The conexion to the server failed: %s\n", mysqli_connect_error());
//    exit();
//    }
$crop = $_REQUEST['crop'];
  $model = $_REQUEST['model'];
  $climate = $_REQUEST['climate'];
  $baseline = $_REQUEST['baseline'];
  $period = $_REQUEST['period'];
  $scale = $_REQUEST['scale'];
  $country = $_REQUEST['country'];
  $subcontinents = $_REQUEST['subcontinents'];  
  $adaptation = $_REQUEST['adaptation'];
  $where = "  ";

  if ($crop != "") {
    $where = $where . " AND e.crop = '" . $crop . "' ";
  }
  if ($model != "") {
    $where = $where . " AND e.impact_models = '" . $model . "' ";
  }
  if ($climate != "") {
    $where = $where . " AND e.climate_scenario = '" . $climate . "' ";
  }
  if ($baseline != "") {
    $baselinearray[] = explode(" - ", $baseline);
    $where = $where . " AND e.base_line_start = '" . $baselinearray[0][0] . "' AND e.base_line_end = '".$baselinearray[0][1]."' ";
  }
  if ($period != "") {
    $periodarray[] = explode(" - ", $period);
    $where = $where . " AND e.projection_start = '" . $periodarray[0][0] . "' AND e.projection_end='". $periodarray[0][1] ."' ";
  }
  if ($scale != "") {
    $where = $where . " AND e.spatial_scale = '" . $scale . "' ";
  }
  if ($subcontinents != "") {
    $where = $where . " AND e.region = '" . $subcontinents . "' ";
  }
  if ($country != "") {
    $where = $where . " AND e.country = '" . $country . "' ";
  }
  if ($adaptation != "") {
    $where = $where . " AND e.adaptation = '" . $adaptation . "' ";
  }

  
  $result = "SELECT a.id,e.idEstimate,a.doi_article,e.spatial_scale,e.crop,e.impact_models,"
          . " CONCAT(e.base_line_start,' - ',e.base_line_end) as baseline,"
          . " CONCAT(e.projection_start,' - ',e.projection_end) as projection,"
          . " e.yield_change, CONCAT(e.region,' - ',e.country) as geograph_scope,"
          . " e.temp_change,e.climate_scenario "
          . " FROM wp_estimate e "
          . " INNER JOIN wp_article a ON e.article_id=a.id "
          . " WHERE 1 "
          . $where
          . " ORDER BY a.doi_article ";
//echo $result; exit();
$dataResult = $wpdb->get_results($result, ARRAY_A);
if (count($dataResult)) {
  // Create the PHPExcel Object
  $objPHPExcel = new PHPExcel();

  // Assign the book properties
  $objPHPExcel->getProperties()->setCreator("CCAFS CGIAR - University of Leeds") //Autor
          ->setLastModifiedBy("CCAFS CGIAR - University of Leeds")
          ->setTitle("Crop_Estimate")
          ->setSubject("Crop_Estimate")
          ->setDescription("Crop_Estimate")
          ->setKeywords("Crop Estimate DOI")
          ->setCategory("Crop_Estimate");

  $titleReport = "Crops Estimate";
  $titleColumns = array('DOI', 'Spatial Scale', 'Crop', 'Multi-Model', 'Baseline Period', 'Projection Period', 'Percentage Yield Change', 'Geographical Scope', 'Local Mean Temperature Change', 'Climate Scenario');

  $objPHPExcel->setActiveSheetIndex(0)
          ->mergeCells('A1:J1');

  // Add the titles
  $objPHPExcel->setActiveSheetIndex(0)
          ->setCellValue('A1', $titleReport)
          ->setCellValue('A3', $titleColumns[0])
          ->setCellValue('B3', $titleColumns[1])
          ->setCellValue('C3', $titleColumns[2])
          ->setCellValue('D3', $titleColumns[3])
          ->setCellValue('E3', $titleColumns[4])
          ->setCellValue('F3', $titleColumns[5])
          ->setCellValue('G3', $titleColumns[6])
          ->setCellValue('H3', $titleColumns[7])
          ->setCellValue('I3', $titleColumns[8])
          ->setCellValue('J3', $titleColumns[9]);

  //Then add the data
  $i = 4;
  foreach ($dataResult as $row) {
    $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A' . $i, $row['doi_article'])
            ->setCellValue('B' . $i, $row['spatial_scale'])
            ->setCellValue('C' . $i, $row['crop'])
            ->setCellValue('D' . $i, $row['impact_models'])
            ->setCellValue('E' . $i, $row['baseline'])
            ->setCellValue('F' . $i, $row['projection'])
            ->setCellValue('G' . $i, $row['yield_change'])
            ->setCellValue('H' . $i, $row['geograph_scope'])
            ->setCellValue('I' . $i, $row['temp_change'])
            ->setCellValue('J' . $i, $row['climate_scenario']);
    $i++;
  }

  $titleStyle = array(
    'font' => array(
      'name' => 'Verdana',
      'bold' => true,
      'italic' => false,
      'strike' => false,
      'size' => 11,
      'color' => array(
        'rgb' => '000000'
      )
    ),
    'fill' => array(
      'type' => PHPExcel_Style_Fill::FILL_SOLID,
      'color' => array('argb' => '416725')
    ),
    'borders' => array(
      'allborders' => array(
        'style' => PHPExcel_Style_Border::BORDER_THIN
      )
    ),
    'alignment' => array(
      'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
      'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
      'rotation' => 0,
      'wrap' => TRUE
    )
  );

  $columnStyle = array(
    'font' => array(
      'name' => 'Arial',
      'bold' => true,
      'color' => array(
        'rgb' => '000000'
      )
    ),
    'fill' => array(
      'type' => PHPExcel_Style_Fill::FILL_GRADIENT_LINEAR,
      'rotation' => 90,
      'startcolor' => array(
        'rgb' => 'FFFFFF'
      ),
      'endcolor' => array(
        'argb' => 'FFFFFF'
      )
    ),
    'borders' => array(
      'top' => array(
        'style' => PHPExcel_Style_Border::BORDER_MEDIUM,
        'color' => array(
          'rgb' => '416725'
        )
      ),
      'bottom' => array(
        'style' => PHPExcel_Style_Border::BORDER_MEDIUM,
        'color' => array(
          'rgb' => '416725'
        )
      )
    ),
    'alignment' => array(
      'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
      'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
      'wrap' => TRUE
    )
  );

  $dataStyle = new PHPExcel_Style();
  $dataStyle->applyFromArray(
          array(
            'font' => array(
              'name' => 'Arial',
              'color' => array(
                'rgb' => '000000'
              )
            ),
            'fill' => array(
              'type' => PHPExcel_Style_Fill::FILL_SOLID,
              'color' => array('argb' => 'FFFFFF')
            ),
            'borders' => array(
              'left' => array(
                'style' => PHPExcel_Style_Border::BORDER_THIN,
                'color' => array(
                  'rgb' => '3a2a47'
                )
              )
            )
          )
  );

  $objPHPExcel->getActiveSheet()->getStyle('A1:J1')->applyFromArray($titleStyle);
  $objPHPExcel->getActiveSheet()->getStyle('A3:J3')->applyFromArray($columnStyle);
  $objPHPExcel->getActiveSheet()->setSharedStyle($dataStyle, "A4:J" . ($i - 1));

  for ($i = 'A'; $i <= 'J'; $i++) {
    $objPHPExcel->setActiveSheetIndex(0)
            ->getColumnDimension($i)->setAutoSize(TRUE);
  }

  // Name of the Sheet
  $objPHPExcel->getActiveSheet()->setTitle('Estimate');

  // Activate the Sheet, to show when the file opens.
  $objPHPExcel->setActiveSheetIndex(0);
  // Inmovilize panels 
  $objPHPExcel->getActiveSheet(0)->freezePane('A4');
  $objPHPExcel->getActiveSheet(0)->freezePaneByColumnAndRow(0, 4);

  // Send the file to the browser, with the desire name(Excel2007)
  header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
  header('Content-Disposition: attachment;filename="Crop_Estimate.xlsx"');
  header('Cache-Control: max-age=0');

  $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
  $objWriter->save('php://output');
  exit;
} else {
  echo "<script language='javascript'>alert('No Data Found');</script>";
}
?>