<?php

/* 
 * Copyright (C) 2014 CRSANCHEZ
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
$article = array();
$article['doi_article'] = $_GET['doi'];
$article['author'] = $_GET['author'];
$article['year'] = $_GET['year'];
$article['journal'] = $_GET['journal'];
$article['valume'] = $_GET['volume'];
$article['issue'] = $_GET['issue'];
$article['page_start'] = $_GET['pstart'];
$article['page_end'] = $_GET['pend'];
$article['reference'] = $_GET['reference'];
$article['paper_title'] = $_GET['title'];
$tablename = $wpdb->prefix . 'article';
$rows_affected = $wpdb->insert($tablename, $article);
//echo "<pre>".print_r($_GET,true)."</pre>";
if(!$rows_affected) {
  $wpdb->show_errors();
  $wpdb->print_error();
} else {
  echo 1;
}

