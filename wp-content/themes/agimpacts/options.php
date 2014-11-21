<?php
require('../../../wp-load.php');
// This needs to be set, in order for the plugin work, 
//in the case when the request variable is empty, throws 
//an e_notice of the empty array
//error_reporting(0);

$option = $_REQUEST['option'];

switch ($option) {
  case 1 : doiQuery();
    break;
  case 2 : scaleQuery();
    break;
  case 3 : cropQuery();
    break;
  case 4 : modelQuery();
    break;
  case 5 : baselineQuery();
    break;
  case 6 : periodQuery();
    break;
  case 7 : countryQuery();
    break;
  case 8 : subcontinentsQuery();
    break;
  case 9 : climateQuery();
    break;
  case 10 : adaptationQuery();
    break;
  case 11 : dataTable();
    break;
  default:
    break;
}

function doiQuery() {
  global $wpdb;
  $doi = $_REQUEST['doi'];
  $result = $wpdb->get_results("SELECT id,doi_article FROM wp_article WHERE doi_article LIKE '%$doi%' ORDER BY id ASC ", ARRAY_A);
  if (count($result) != 0) {
    for ($i = 0; $i < count($result); $i++) {
      $answer[] = array("id" => $result[$i]['id'], "text" => $result[$i]['id'] . " - " . $result[$i]['doi_article']);
    }
  } else {
    $answer[] = array("id" => "0", "text" => "No Results Found..");
  }
  echo json_encode($answer);
}

function scaleQuery() {
  global $wpdb;
  $scale = $_REQUEST['scale'];
  $doi = $_REQUEST['doi'];
  $result = $wpdb->get_results("SELECT DISTINCT(e.spatial_scale) "
          . "FROM wp_estimate e "
          . "INNER JOIN wp_article a ON e.article_id=a.id "
          . "WHERE "
          . "e.spatial_scale LIKE '%%' "
          . "ORDER BY spatial_scale ASC ", ARRAY_A);
  if (count($result) != 0) {
    for ($i = 0; $i < count($result); $i++) {
      $answer[] = array("id" => $result[$i]['spatial_scale'], "text" => $result[$i]['spatial_scale']);
    }
  } else {
    $answer[] = array("id" => "0", "text" => "No Results Found..");
  }
  echo json_encode($answer);
}

function cropQuery() {
  global $wpdb;
  $result = $wpdb->get_results("SELECT DISTINCT(e.crop) "
          . "FROM wp_estimate e "
          . "INNER JOIN wp_article a ON e.article_id=a.id "
          . "WHERE "
          . "e.crop LIKE '%%' "
          . "ORDER BY e.crop ASC ", ARRAY_A);
  if (count($result) != 0) {
    for ($i = 0; $i < count($result); $i++) {
      $answer[] = array("id" => $result[$i]['crop'], "text" => $result[$i]['crop']);
    }
  } else {
    $answer[] = array("id" => "0", "text" => "No Results Found..");
  }
  echo json_encode($answer);
}

function modelQuery() { //impact model or multimodel
  global $wpdb;
  $result = $wpdb->get_results("SELECT DISTINCT(e.impact_models) "
          . "FROM wp_estimate e "
          . "INNER JOIN wp_article a ON e.article_id=a.id "
          . "WHERE "
          . " e.impact_models LIKE '%%' "
          . " ORDER BY e.impact_models ASC", ARRAY_A);
  if (count($result) != 0) {
    for ($i = 0; $i < count($result); $i++) {
      $answer[] = array("id" => $result[$i]['impact_models'], "text" => $result[$i]['impact_models']);
    }
  } else {
    $answer[] = array("id" => "0", "text" => "No Results Found..");
  }
  echo json_encode($answer);
}

function baselineQuery() {
  global $wpdb;
  $suboption = $_REQUEST['suboption'];
  if ($suboption == 1) {
    $baseline = " e.base_line_start ";
    $baselineforresult = "base_line_start";
  } else if ($suboption == 2) {
    $baseline = " e.base_line_end ";
    $baselineforresult = "base_line_end";
  }
  $result = $wpdb->get_results("SELECT DISTINCT(" . $baseline . ") "
          . "FROM wp_estimate e "
          . "INNER JOIN wp_article a ON e.article_id=a.id "
          . "WHERE "
          . $baseline . " LIKE '%%' "
          . "ORDER BY " . $baseline . " ASC ", ARRAY_A);
  if (count($result) != 0) {
    for ($i = 0; $i < count($result); $i++) {
      $answer[] = array("id" => $result[$i][$baselineforresult], "text" => $result[$i][$baselineforresult]);
    }
  } else {
    $answer[] = array("id" => "0", "text" => "No Results Found..");
  }
  echo json_encode($answer);
}

function periodQuery() {
  global $wpdb;
  $suboption = $_REQUEST['suboption'];
  if ($suboption == 1) {
    $period = " e.projection_start ";
    $periodforresult = "projection_start";
  } else if ($suboption == 2) {
    $period = " e.projection_end ";
    $periodforresult = "projection_end";
  }
  $result = $wpdb->get_results("SELECT DISTINCT(" . $period . ") "
          . "FROM wp_estimate e "
          . "INNER JOIN wp_article a ON e.article_id=a.id "
          . "WHERE "
          . $period . " LIKE '%%' "
          . "ORDER BY spatial_scale ASC ", ARRAY_A);
  if (count($result) != 0) {
    for ($i = 0; $i < count($result); $i++) {
      $answer[] = array("id" => $result[$i][$periodforresult], "text" => $result[$i][$periodforresult]);
    }
  } else {
    $answer[] = array("id" => "0", "text" => "No Results Found..");
  }
  echo json_encode($answer);
}

function countryQuery() {
  global $wpdb;
  $result = $wpdb->get_results("SELECT DISTINCT(e.country) "
          . "FROM wp_estimate e "
          . "INNER JOIN wp_article a ON e.article_id=a.id "
          . "WHERE "
          . "e.country LIKE '%%' "
          . "ORDER BY e.country ASC ", ARRAY_A);

  if (count($result) != 0) {
    for ($i = 0; $i < count($result); $i++) {
      $answer[] = array("id" => $result[$i]['country'], "text" => $result[$i]['country']);
    }
  } else {
    $answer[] = array("id" => "0", "text" => "No Results Found..");
  }
  //print_r($answer);
  echo json_encode($answer);
}

function subcontinentsQuery() {
  global $wpdb;
  $country = $_REQUEST['country'];
  $where = " ";
  if ($country != "") {
    $where = $where . " e.country ='" . $country . "' AND ";
  }

  $result = $wpdb->get_results("SELECT DISTINCT(e.region) "
          . "FROM wp_estimate e "
          . "INNER JOIN wp_article a ON e.article_id=a.id "
          . "WHERE "
          . $where
          . "e.region LIKE '%%' "
          . "ORDER BY e.region ASC ", ARRAY_A);

  if (count($result) != 0) {
    for ($i = 0; $i < count($result); $i++) {
      $answer[] = array("id" => $result[$i]['region'], "text" => $result[$i]['region']);
    }
  } else {
    $answer[] = array("id" => "0", "text" => "No Results Found..");
  }
  echo json_encode($answer);
}

function climateQuery() {
  global $wpdb;
  $result = $wpdb->get_results("SELECT DISTINCT(e.climate_scenario) "
          . "FROM wp_estimate e "
          . "INNER JOIN wp_article a ON e.article_id=a.id "
          . "WHERE "
          . "e.climate_scenario LIKE '%%' "
          . "ORDER BY e.climate_scenario ASC ", ARRAY_A);
  if (count($result) != 0) {
    for ($i = 0; $i < count($result); $i++) {
      $answer[] = array("id" => $result[$i]['climate_scenario'], "text" => $result[$i]['climate_scenario']);
    }
  } else {
    $answer[] = array("id" => "0", "text" => "No Results Found..");
  }
  echo json_encode($answer);
}

function adaptationQuery() {
  global $wpdb;
  $result = $wpdb->get_results("SELECT DISTINCT(e.adaptation) "
          . "FROM wp_estimate e "
          . "INNER JOIN wp_article a ON e.article_id=a.id "
          . "WHERE "
          . "e.adaptation LIKE '%%' "
          . "ORDER BY e.adaptation ASC ", ARRAY_A);
  if (count($result) != 0) {
    for ($i = 0; $i < count($result); $i++) {
      $answer[] = array("id" => $result[$i]['adaptation'], "text" => $result[$i]['adaptation']);
    }
  } else {
    $answer[] = array("id" => "0", "text" => "No Results Found..");
  }
  echo json_encode($answer);
}

function dataTable() {
  global $wpdb;
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
  $where = "  ";
  if ($doi != "") {
    $where = $where . " AND a.doi_article = '" . $doi . "' ";
  }
  if ($scale != "") {
    $where = $where . " AND e.spatial_scale = '" . $scale . "' ";
  }
  if ($crop != "") {
    $where = $where . " AND e.crop = '" . $crop . "' ";
  }
  if ($model != "") {
    $where = $where . " AND e.impact_models = '" . $model . "' ";
  }
  if ($baseline_start != "") {
    $where = $where . " AND e.base_line_start >= '" . $baseline_start . "' ";
  }
  if ($baseline_end != "") {
    $where = $where . " AND e.base_line_end <= '" . $baseline_end . "' ";
  }
  if ($period_start != "") {
    $where = $where . " AND e.projection_start >= '" . $period_start . "' ";
  }
  if ($period_end != "") {
    $where = $where . " AND e.projection_end <= '" . $period_end . "' ";
  }
  if ($country != "") {
    $where = $where . " AND e.country = '" . $country . "' ";
  }
  if ($subcontinents != "") {
    $where = $where . " AND e.region = '" . $subcontinents . "' ";
  }
  if ($climate != "") {
    $where = $where . " AND e.climate_scenario = '" . $climate . "' ";
  }
  if ($adaptation != "") {
    $where = $where . " AND e.adaptation = '" . $adaptation . "' ";
  }

  $tr = "";
  $result = $wpdb->get_results("SELECT a.id,e.idEstimate,a.doi_article,e.spatial_scale,e.crop,e.impact_models,"
          . "CONCAT(e.base_line_start,' - ',e.base_line_end) as baseline,"
          . "CONCAT(e.projection_start,' - ',e.projection_end) as projection,"
          . "e.yield_change, CONCAT(e.region,' - ',e.country) as geograph_scope,"
          . "e.temp_change,e.climate_scenario "
          . "FROM wp_estimate e "
          . "INNER JOIN wp_article a ON e.article_id=a.id "
          . "WHERE 1 "
          . $where
          . "ORDER BY a.doi_article ", ARRAY_A);

  $table = "<p>
	<div id='downloadFile'>
		<h3>Download Data</h3>
		<a href='#' onClick='downloadData()' title='Download Data for Excel'><img style='heigth:60px;width:60px;' src='".get_template_directory_uri()."/img/excel.png'></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<a href='#' onClick='downloadDataCSV()'title='Download Data for CSV'><img style='heigth:60px;width:60px;' src='".get_template_directory_uri()."/img/csv.png'></a>
	</div>

	<table id='resulttable' class='tablesorter'>
	<thead>
		<tr>
			<th>DOI <!--<input type=\"checkbox\" name='columns' value='doi'>--></th>
			<th>Spatial Scale <!--<input type=\"checkbox\" name='columns' value='doi'>--></th>
			<th>Crop <!--<input type=\"checkbox\" name='columns' value='doi'>--></th>
			<th>Multi-Model <!--<input type=\"checkbox\" name='columns' value='doi'>--></th>
			<th>Baseline Period <!--<input type=\"checkbox\" name='columns' value='doi'>--></th>
			<th>Projection Period <!--<input type=\"checkbox\" name='columns' value='doi'>--></th>
			<th>Percentage Yield Change <!--<input type=\"checkbox\" name='columns' value='doi'>--></th>
			<th>Geographical Scope <!--<input type=\"checkbox\" name='columns' value='doi'>--></th>
			<th>Local Mean Temperature Change <!--<input type=\"checkbox\" name='columns' value='doi'>--></th>
			<th>Climate Scenario <!--<input type=\"checkbox\" name='columns' value='doi'>--></th>
			<th>Validate</th>
		</tr>
	</thead>
	<tbody>";
  if (count($result) != 0) {
    for ($i = 0; $i < count($result); $i++) {
      $status = ($result[$i]['doi_article'] == 0)?'new':'Validated';
      $tr = $tr . "<tr>
                    <td>" . $result[$i]['doi_article'] . "</td>
                    <td>" . $result[$i]['spatial_scale'] . "</td>
                    <td>" . $result[$i]['crop'] . "</td>
                    <td>" . $result[$i]['impact_models'] . "</td>
                    <td>" . $result[$i]['baseline'] . "</td>
                    <td>" . $result[$i]['projection'] . "</td>
                    <td>" . $result[$i]['yield_change'] . "</td>
                    <td>" . $result[$i]['geograph_scope'] . "</td>
                    <td>" . $result[$i]['temp_change'] . "</td>
                    <td>" . $result[$i]['climate_scenario'] . "</td>
                    <td>".$status."</td>
            </tr>";
    }
    echo $table . $tr . "</tbody>
                </table>";
  } else {

    echo $tr = "<div style='text-align:center;'><h3>No data Found</h3></div>";
  }
}

?>