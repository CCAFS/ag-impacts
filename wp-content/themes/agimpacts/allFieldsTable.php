<?php
/**
 * Template Name: Full view article
 * @package WordPress
 * @subpackage AMKNToolbox
 */
/*
 * Copyright (C) 2015 CRSANCHEZ
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */
if (isset($_REQUEST['custom'])) {
  require('../../../wp-load.php');
  ?><script src="<?php  echo get_template_directory_uri();  ?>/js/jquery-1.11.1.min.js"></script><?php
} else {
  get_header();
}
global $wpdb;
?>
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/js/tablesorter/css/theme.green.css">
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/tablesorter/js/jquery.tablesorter.js"></script>
<?php
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

if ($crop != "null") {
  $where = $where . " AND e.crop = '" . $crop . "' ";
}
if ($model != "null") {
  $where = $where . " AND e.impact_models = '" . $model . "' ";
}
if ($climate != "null") {
  $where = $where . " AND e.climate_scenario = '" . $climate . "' ";
}
if ($baseline != "null") {
  $baselinearray[] = explode(" - ", $baseline);
  $where = $where . " AND e.base_line_start = '" . $baselinearray[0][0] . "' AND e.base_line_end = '" . $baselinearray[0][1] . "' ";
}
if ($period != "null") {
  $periodarray[] = explode(" - ", $period);
  $where = $where . " AND e.projection_start = '" . $periodarray[0][0] . "' AND e.projection_end='" . $periodarray[0][1] . "' ";
}
if ($scale != "null") {
  $where = $where . " AND e.spatial_scale = '" . $scale . "' ";
}
if ($subcontinents != "null") {
  $where = $where . " AND e.region = '" . $subcontinents . "' ";
}
if ($country != "null") {
  $where = $where . " AND e.country = '" . $country . "' ";
}
if ($adaptation != "null") {
  $where = $where . " AND e.adaptation = '" . $adaptation . "' ";
}


$result = "SELECT a.*,e.*,"
        . " CONCAT(e.base_line_start,' - ',e.base_line_end) as baseline,"
        . " CONCAT(e.projection_start,' - ',e.projection_end) as projection,"
        . " CONCAT(e.region,' - ',e.country) as geograph_scope "
        . " FROM wp_estimate e "
        . " INNER JOIN wp_article a ON e.article_id=a.id "
        . " WHERE 1 "
        . $where
        . " ORDER BY a.id ";
//echo $result; exit();
$dataResult = $wpdb->get_results($result, ARRAY_A);
if (count($dataResult)) {
  $table = "
	<table id='resulttable' class='tablesorter'>
	<thead>
		<tr>
			<th>DOI <!--<input type=\"checkbox\" name='columns' value='doi'>--></th>
                        <th>Author</th>
                        <th>Year</th>
                        <th>Journal</th>
                        <th>Volume</th>
                        <th>Issue</th>
                        
                        <th>Start Page</th>
                        <th>End Page</th>
                        <th>Reference</th>
                        <th>Title</th>
                        <th>Crop</th>
                        <th>Scientific name</th>
                        <th>CO2 Projected</th>
                        <th>CO2 Baseline</th>
                        <th>Temp Change</th>
                        <th>Precipitation change</th>
                        <th>Yield Change</th>
                        <th>Projec yield change start</th>
                        <th>Projec yield change end</th>
                        <th>Adaptation</th>
                        <th>Climate scenario</th>
                        <th># GCM used</th>
                        <th>GCM(s)</th>
                        <th># Impact model used</th>
                        <th>Impact model(s)</th>
                        <th>Baseline start</th>
                        <th>Baseline end</th>
                        <th>Projection start</th>
                        <th>Projection end</th>
                        <th>Geo scope</th>
                        <th>Region</th>
                        <th>Country</th>
                        <th>State</th>
                        <th>City</th>
                        <th>Latitude</th>
                        <th>Longitude</th>
			<th>Spatial Scale <!--<input type=\"checkbox\" name='columns' value='doi'>--></th>
			<th>Comments <!--<input type=\"checkbox\" name='columns' value='doi'>--></th>
			<th>Contributor <!--<input type=\"checkbox\" name='columns' value='doi'>--></th>
			<th>Status <!--<input type=\"checkbox\" name='columns' value='doi'>--></th>
		</tr>
	</thead>
	<tbody>";
//  if (count($result) != 0) {
  for ($i = 0; $i < count($dataResult); $i++) {
    $status = ($dataResult[$i]['doi_article'] == 0) ? 'new' : 'Validated';
    $tr = $tr . "<tr>
                    <td>" . $dataResult[$i]['doi_article'] . "</td>
                    <td>" . $dataResult[$i]['author'] . "</td>
                    <td>" . $dataResult[$i]['year'] . "</td>
                    <td>" . $dataResult[$i]['journal'] . "</td>
                    <td>" . $dataResult[$i]['volume'] . "</td>
                    <td>" . $dataResult[$i]['issue'] . "</td>
                    <td>" . $dataResult[$i]['page_start'] . "</td>
                    <td>" . $dataResult[$i]['page_end'] . "</td>
                    <td>" . $dataResult[$i]['reference'] . "</td>
                    <td>" . $dataResult[$i]['paper_title'] . "</td>
                    <td>" . $dataResult[$i]['crop'] . "</td>
                    <td>" . $dataResult[$i]['scientific_name'] . "</td>
                    <td>" . $dataResult[$i]['projection_co2'] . "</td>
                    <td>" . $dataResult[$i]['baseline_co2'] . "</td>
                    <td>" . $dataResult[$i]['temp_change'] . "</td>
                    <td>" . $dataResult[$i]['precipitation_change'] . "</td>
                    <td>" . $dataResult[$i]['yield_change'] . "</td>
                    <td>" . $dataResult[$i]['projec_yield_change_start'] . "</td>
                    <td>" . $dataResult[$i]['projec_yield_change_end'] . "</td>
                    <td>" . $dataResult[$i]['adaptation'] . "</td>
                    <td>" . $dataResult[$i]['climate_scenario'] . "</td>
                    <td>" . $dataResult[$i]['num_gcm_used'] . "</td>
                    <td>" . $dataResult[$i]['gcm'] . "</td>
                    <td>" . $dataResult[$i]['num_impact_model_used'] . "</td>
                    <td>" . $dataResult[$i]['impact_models'] . "</td>
                    <td>" . $dataResult[$i]['base_line_start'] . "</td>
                    <td>" . $dataResult[$i]['base_line_end'] . "</td>
                    <td>" . $dataResult[$i]['projection_start'] . "</td>
                    <td>" . $dataResult[$i]['projection_end'] . "</td>
                    <td>" . $dataResult[$i]['geo_scope'] . "</td>
                    <td>" . $dataResult[$i]['region'] . "</td>
                    <td>" . $dataResult[$i]['country'] . "</td>
                    <td>" . $dataResult[$i]['state'] . "</td>
                    <td>" . $dataResult[$i]['city'] . "</td>
                    <td>" . $dataResult[$i]['latitude'] . "</td>
                    <td>" . $dataResult[$i]['longitude'] . "</td>
                    <td>" . $dataResult[$i]['spatial_scale'] . "</td>
                    <td>" . $dataResult[$i]['comments'] . "</td>
                    <td>" . $dataResult[$i]['contributor'] . "</td>
                    <td>" . $status . "</td>
            </tr>";
  }
  echo $table . $tr . "</tbody>
                </table>";
  echo "<script language='javascript'>$('#resulttable').tablesorter({theme: 'green'});</script>";
} else {
  echo "<script language='javascript'>alert('No Data Found');</script>";
}


  