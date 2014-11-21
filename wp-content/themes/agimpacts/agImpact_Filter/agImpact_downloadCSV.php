<?php
	// This needs to be set, in order for the script work, 
	//in the case when the request variable is empty, throws 
	//an e_notice of the empty array
	error_reporting(0);
	
	$conexion = new mysqli('localhost','root','','agimpacts',3306);
    if (mysqli_connect_errno()) {
        printf("The conexion to the server failed: %s\n", mysqli_connect_error());
    exit();
    }

    //echo "<pre>";print_r($_REQUEST);echo "</pre>";
    $doi = $_REQUEST['doi'];
    $scale = $_REQUEST['scale'];
    $crop = $_REQUEST['crop'];
    $model = $_REQUEST['model'];
    $baseline_start = $_REQUEST['baseline_start'];
    $baseline_end = $_REQUEST['baseline_end'];
    $period_start = $_REQUEST['period_start'];
    $period_end = $_REQUEST['period_end'];
    $country = $_REQUEST['country'];
    $subcontinents = $_REQUEST['subcontinents'];
    $climate = $_REQUEST['climate'];
    $adaptation = $_REQUEST['adaptation'];
    $where= "  ";
    if($doi !=""){$where = $where." AND a.doi_article = '".$doi."' ";}
    if($scale !=""){$where = $where." AND e.spatial_scale = '".$scale."' ";}
    if($crop !=""){$where = $where." AND e.crop = '".$crop."' ";}
    if($model !=""){$where = $where." AND e.impact_models = '".$model."' ";}
    if($baseline_start !=""){$where = $where." AND e.base_line_start >= '".$baseline_start."' ";}
    if($baseline_end !=""){$where = $where." AND e.base_line_end <= '".$baseline_end."' ";}
    if($period_start !=""){$where = $where." AND e.projection_start >= '".$period_start."' ";}
    if($period_end !=""){$where = $where." AND e.projection_end <= '".$period_end."' ";}
    if($country !=""){$where = $where." AND e.country = '".$country."' ";}
    if($subcontinents !=""){$where = $where." AND e.region = '".$subcontinents."' ";}
    if($climate !=""){$where = $where." AND e.climate_scenario = '".$climate."' ";}
    if($adaptation !=""){$where = $where." AND e.adaptation = '".$adaptation."' ";}

    $result= "SELECT a.doi_article,e.spatial_scale,e.crop,e.impact_models,"
            . "CONCAT(e.base_line_start,' - ',e.base_line_end) as baseline,"
            . "CONCAT(e.projection_start,' - ',e.projection_end) as projection,"
            . "e.yield_change, CONCAT(e.region,' - ',e.country) as geograph_scope,"
            . "e.temp_change,e.climate_scenario "
            . "FROM wp_estimate e "
            . "INNER JOIN wp_article a ON e.article_id=a.id "
            . "WHERE 1 "
            . $where
            . "ORDER BY a.doi_article ";
    //echo $result; exit();
    $resultado = $conexion->query($result);
	$headers = array('DOI', 'Spatial Scale', 'Crop', 'Multi-Model','Baseline Period', 'Projection Period', 'Percentage Yield Change', 'Geographical Scope','Local Mean Temperature Change', 'Climate Scenario');
    if($resultado->num_rows > 0 ){

		$fp = fopen('php://output', 'w');
		if ($fp && $resultado) {
			header('Content-Type: text/csv');
			header('Content-Disposition: attachment; filename="Crop_Estimate.csv"');
			header('Pragma: no-cache');
			header('Expires: 0');
			fputcsv($fp, $headers);
			while ($row = $resultado->fetch_array(MYSQLI_NUM)) {
				fputcsv($fp, array_values($row));
			}
			die;
		}
	}
	else{
            echo "<script language='javascript'>alert('No Data Found');</script>";
            
	}
?>