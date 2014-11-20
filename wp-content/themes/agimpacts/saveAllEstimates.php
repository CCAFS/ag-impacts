<?php

/*
 * Copyright (C) 20'ppt' CRSANCHEZ
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
global $wpdb;
$estimate = array();
$estimate['article_id'] = $_GET['article'];
$estimate['crop'] = $_POST['crop'];
$estimate['scientific_name'] = $_POST['sname'];
$estimate['projection_co2'] = (trim($_POST['projected']) != '' && $_POST['projected'] != 'N/A') ? $_POST['projected'] : 0;
$estimate['baseline_co2'] = (trim($_POST['co2base']) != '' && $_POST['co2base'] != 'N/A') ? $_POST['co2base'] : 0;
$estimate['temp_change'] = (trim($_POST['dtemp']) != '' && $_POST['dtemp'] != 'N/A') ? $_POST['dtemp'] : 0;
$estimate['precipitation_change'] = ($_POST['ppt'] != '' && $_POST['ppt'] != 'N/A') ? $_POST['ppt'] : 0;
$estimate['yield_change'] = ($_POST['ychange'] != '' && $_POST['ychange'] != 'N/A') ? $_POST['ychange'] : 0;
$estimate['projec_yield_change_start'] = ($_POST['rstart'] != '' && $_POST['rstart'] != 'N/A') ? $_POST['rstart'] : 0;
$estimate['project_yield_change_end'] = ($_POST['rend'] != '' && $_POST['rend'] != 'N/A') ? $_POST['rend'] : 0;
//$estimate['adaptation'] = $_POST[19];
$estimate['climate_scenario'] = $_POST['scenario'];
//$estimate['num_gcm_used'] = ($_POST[21] != '' && $_POST[21] != 'N/A') ? $_POST[21] : 0;
$estimate['gcm'] = $_POST['gcm'];
//$estimate['num_impact_model_used'] = ($_POST[23] != '' && $_POST[23] != 'N/A') ? $_POST[23] : 0;
$estimate['impact_models'] = $_POST['model'];
$estimate['base_line_start'] = ($_POST['bstart'] != '' && $_POST['bstart'] != 'N/A') ? $_POST['bstart'] : 0;
$estimate['base_line_end'] = ($_POST['bend'] != '' && $_POST['bend'] != 'N/A') ? $_POST['bend'] : 0;
$estimate['projection_start'] = ($_POST['pstart'] != '' && $_POST['pstart'] != 'N/A') ? $_POST['pstart'] : 0;
$estimate['projection_end'] = (trim($_POST['pend']) != '' && $_POST['pend'] != 'N/A') ? $_POST['pend'] : 0;
$estimate['geo_scope'] = $_POST['scope'];
//$estimate['region'] = $_POST[32];
//$estimate['country'] = $_POST[33];
//$estimate['state'] = $_POST[34];
//$estimate['city'] = $_POST[35];
$estimate['latitude'] = $_POST['lat'];
$estimate['longitude'] = $_POST['lon'];
$estimate['spatial_scale'] = $_POST['scale'];
$estimate['comments'] = $_POST['comment'];
$estimate['contributor'] = $_POST['contributor'];
$estimate['wp_users_ID'] = get_current_user_id();
$estimate['status'] = '0';
$tablename = $wpdb->prefix . 'estimate';
$rows_affected = $wpdb->insert($tablename, $estimate);
//echo "<pre>".print_r($_GET,true)."</pre>";
if(!$rows_affected) {
  $wpdb->show_errors();
  $wpdb->print_error();
} else {
//  echo 1;
}
