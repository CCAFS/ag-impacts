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
require('../../../wp-load.php');
//get_header('embed');
global $wpdb;

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

if ($crop) {
  $where .= " AND e.crop = '" . $crop . "' ";
}
if ($model) {
  $where .= " AND e.impact_models = '" . $model . "' ";
}
if ($climate) {
  $where .= " AND e.climate_scenario = '" . $climate . "' ";
}
if ($baseline) {
  $baselinearray[] = explode(" - ", $baseline);
  $where .= " AND e.base_line_start = '" . $baselinearray[0][0] . "' AND e.base_line_end = '" . $baselinearray[0][1] . "' ";
}
if ($period) {
  $periodarray[] = explode(" - ", $period);
  $where .= " AND e.projection_start = '" . $periodarray[0][0] . "' AND e.projection_end='" . $periodarray[0][1] . "' ";
}
if ($scale) {
  $where .= " AND e.spatial_scale = '" . $scale . "' ";
}
if ($subcontinents) {
  $where .= " AND e.region = '" . $subcontinents . "' ";
}
if ($country) {
  $where .= " AND e.country = '" . $country . "' ";
}
if ($adaptation) {
  $adaptation = explode(',', $adaptation);
  $where .= " AND (";
  foreach ($adaptation as $val) {
    $where .= " e.adaptation LIKE '%" . trim($val) . "%' OR";
  }
  $where = substr($where, 0, -2);
  $where .= ") ";
}

$sql1 = "SELECT e.latitude, e.longitude, e.idEstimate, "
        . " e.crop ,"
        . " a.doi_article,"
        . " a.paper_title "
        . " FROM wp_estimate e "
        . " INNER JOIN wp_article a ON e.article_id=a.id "
        . " WHERE e.latitude NOT IN ('','N/A') AND e.longitude NOT IN ('','N/A') "
        . $where
        . " ORDER BY a.doi_article $limit";
//  echo $sql1;
$result = $wpdb->get_results($sql1, ARRAY_A);
if (count($result) != 0) {
  echo 'eqfeed_callback({ "type": "FeatureCollection",
          "features": [';
  for ($i = 0; $i < count($result); $i++) {
    if (is_numeric($result[$i]['latitude']) && is_numeric($result[$i]['longitude'])){
    echo '
             { "type": "Feature",
              "id": "' . $result[$i]['idEstimate'] . '",
              "geometry": {"type": "Point", "coordinates": [' . $result[$i]['latitude'] . ', ' . $result[$i]['longitude'] . ']},
              "properties": {
                 '
          . '"crop":"' . $result[$i]['crop'] . '", '
          . '"doi":"' . $result[$i]['doi_article'] . '"'
          . '}
             }, 
            ';
    }
  }
  echo ']
     });';
}
