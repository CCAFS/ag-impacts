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
global $wpdb;
$article = $_GET['article'];
$updates = $_POST;
$updates['article']['status'] = 1;
foreach($updates as $table => $data) {
  if($table == 'article'){
    $rows_affected = $wpdb->update($wpdb->prefix . $table, $data, array( 'id' => $article ));
  } else if ($table == 'estimate') {
    foreach ($data as $estimate => $regs) {
      $rows_affected = $wpdb->update($wpdb->prefix . $table, $regs, array( 'idEstimate' => $estimate ));
    }
  }
}
if(!$rows_affected) {
  $wpdb->show_errors();
  $wpdb->print_error();
}
//echo "<pre>".print_r($updates,true)."</pre>";

