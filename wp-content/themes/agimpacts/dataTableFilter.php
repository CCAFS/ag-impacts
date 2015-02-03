<?php

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

/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * Easy set variables
 */
require('../../../wp-load.php');
$crop = $_GET['crop'];
$model = $_REQUEST['model'];
$climate = $_REQUEST['climate'];
$baseline = $_REQUEST['baseline'];
$period = $_REQUEST['period'];
$scale = $_REQUEST['scale'];
$country = $_REQUEST['country'];
$subcontinents = $_REQUEST['subcontinents'];
$adaptation = $_GET['adaptation'];
$where = "  ";

if ($crop != "") {
  $where = $where . " AND e.crop = '" . $crop . "' ";
}
if ($model) {
  $where = $where . " AND e.impact_models = '" . $model . "' ";
}
if ($climate) {
  $where = $where . " AND e.climate_scenario = '" . $climate . "' ";
}
if ($baseline) {
  $baselinearray[] = explode(" - ", $baseline);
  $where = $where . " AND e.base_line_start = '" . $baselinearray[0][0] . "' AND e.base_line_end = '" . $baselinearray[0][1] . "' ";
}
if ($period != '') {
  $periodarray[] = explode(" - ", $period);
  $where = $where . " AND e.projection_start = '" . $periodarray[0][0] . "' AND e.projection_end='" . $periodarray[0][1] . "' ";
}
if ($scale) {
  $where = $where . " AND e.spatial_scale = '" . $scale . "' ";
}
if ($subcontinents) {
  $where = $where . " AND e.region = '" . $subcontinents . "' ";
}
if ($country) {
  $where = $where . " AND e.country = '" . $country . "' ";
}
if ($adaptation) {
//  $adaptation = explode(',', $adaptation);
  $where .= " AND (";
  foreach ($adaptation as $val) {
    $where .= " e.adaptation LIKE '%" . trim($val) . "%' OR";
  }
  $where = substr($where, 0, -2);
  $where .= ") ";
}
//$where = "  ";
$sql1 = "SELECT count(*) as total"
        . " FROM wp_estimate e "
        . " INNER JOIN wp_article a ON e.article_id=a.id "
        . " WHERE 1 "
        . $where;
//echo $sql1;
$result = $wpdb->get_row($sql1);

$total_rows = $result->total;
// DB table to use
$limit = 'LIMIT ' . $_GET['start'] . ',' . $_GET['length'];
$sql1 = "SELECT a.doi_article,e.spatial_scale,e.crop,e.impact_models,"
          . " CONCAT(e.base_line_start,' - ',e.base_line_end) as baseline,"
          . " CONCAT(e.projection_start,' - ',e.projection_end) as projection,"
          . " e.yield_change, CONCAT(e.region,' - ',e.country) as geograph_scope,"
          . " e.temp_change,e.climate_scenario, e.adaptation "
          . " FROM wp_estimate e "
          . " INNER JOIN wp_article a ON e.article_id=a.id "
          . " WHERE 1 "
          . $where
          . " ORDER BY a.doi_article $limit";
//  echo $sql1;
  $result = $wpdb->get_results($sql1,ARRAY_N);

echo json_encode(
        array(
//          "draw"=> 1,
          "recordsTotal" => $total_rows,
          "recordsFiltered" => $total_rows,
          "data" => $result
        )
);

