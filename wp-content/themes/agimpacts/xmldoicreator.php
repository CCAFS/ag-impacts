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
  $doi = $_POST['doi'];
  $stringData = validDoi($doi);
  if ($stringData != "") {
    echo $stringData;
  } else {
    echo "null";
  }
  $fh = fopen("doi.xml", 'w');
  fwrite($fh, $stringData);
  fclose($fh);
//  echo 'doi.xml created successfully';
