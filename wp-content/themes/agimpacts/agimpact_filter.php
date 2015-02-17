<?php
/**
 * Template Name: Estimate search
 * @package WordPress
 * @subpackage AMKNToolbox
 */
//require('../../../../wp-load.php');
get_header();
?>
<script type='text/javascript' src='http://maps.google.com/maps/api/js?sensor=false'></script>
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/js/select2/4.0.0/select2.css">
<script src="<?php echo get_template_directory_uri(); ?>/js/select2/4.0.0/select2.min.js"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/agimpact_filter.js"></script>
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/agimpact_filter.css">
<link rel="stylesheet" href="//cdn.datatables.net/plug-ins/3cfcc339e89/integration/jqueryui/dataTables.jqueryui.css">
<script type="text/javascript" src="//cdn.datatables.net/1.10.4/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css">
<script type="text/javascript" src="http://google-maps-utility-library-v3.googlecode.com/svn/trunk/infobox/src/infobox.js"></script>
<div id="loading" style="z-index:9999"><img style="" src="<?php echo get_template_directory_uri(); ?>/img/loading.gif" alt="Loader" /></div>
<section id="content" class="row"> 

  <form id="filtersh" class="pure-form pure-form-aligned">
    <fieldset>
      <legend>Crop and Region</legend>
      <div class="pure-g">
        <div class="pure-u-1 pure-u-md-1-3" style="height: 45px">
          <label for="crop">Crop</label>
          <select class="js-data-ajax" style="width: 300px;" name="crop" id="crop">
            <?php
            if (isset($_GET['crop'])) {
              echo "<option value'" . $_GET['crop'] . "' selected='selected'>" . $_GET['crop'] . "</option>";
            }
            ?>
          </select>
          <!--<input type="hidden" name="crop" id="crop" class="input-xlarge" style="width:350px;" data-placeholder="Choose An Option.." />-->
        </div>
        <div class="pure-u-1 pure-u-md-1-3" style="height: 45px">
          <label for="model">Impact model(s)</label>
          <!--<input type="hidden" name="model" id="model" class="input-xlarge" style="width:350px;" data-placeholder="Choose An Option.." />-->
          <select class="js-data-ajax" style="width: 300px;" name="model" id="model">
            <?php
            if (isset($_GET['model'])) {
              echo "<option value'" . $_GET['model'] . "' selected='selected'>" . $_GET['model'] . "</option>";
            }
            ?>
          </select>
        </div>
        <div class="pure-u-1 pure-u-md-1-3" style="height: 45px">
          <label for="scale">Spatial Scale</label>
          <!--<input type="hidden" name="scale" id="scale"  data-placeholder="Choose An Option.." />-->
          <select class="js-data-ajax" style="width: 300px;" name="scale" id="scale">
            <?php
            if (isset($_GET['scale'])) {
              echo "<option value'" . $_GET['scale'] . "' selected='selected'>" . $_GET['scale'] . "</option>";
            }
            ?>
          </select>
        </div>
        <div class="pure-u-1 pure-u-md-1-3" style="height: 45px">
          <label for="continents">Continent</label>
          <!--<input type="hidden" name="continents" id="continents" class="input-xlarge" style="width:350px;" data-placeholder="Choose An Option.." />-->
          <select class="js-data-ajax" style="width: 300px;" name="continents" id="continents">
            <?php
            if (isset($_GET['continents'])) {
              echo "<option value'" . $_GET['continents'] . "' selected='selected'>" . $_GET['continents'] . "</option>";
            }
            ?>
          </select>
        </div>
        <div class="pure-u-1 pure-u-md-1-3" style="height: 45px">
          <label for="regions">Region</label>
          <!--<input type="hidden" name="regiosn" id="regions" class="input-xlarge" style="width:350px;" data-placeholder="Choose An Option.." />-->
          <select class="js-data-ajax" style="width: 300px;" name="regions" id="regions">
            <?php
            if (isset($_GET['regions'])) {
              echo "<option value'" . $_GET['regions'] . "' selected='selected'>" . $_GET['regions'] . "</option>";
            }
            ?>
          </select>
        </div>
        <div class="pure-u-1 pure-u-md-1-3" style="height: 45px">
          <label for="country">Country</label>
          <!--<input type="hidden" name="country" id="country" class="input-xlarge" style="width:350px;" data-placeholder="Choose An Option.." />-->
          <select class="js-data-ajax" style="width: 300px;" name="country" id="country">
            <?php
            if (isset($_GET['country'])) {
              echo "<option value'" . $_GET['country'] . "' selected='selected'>" . $_GET['country'] . "</option>";
            }
            ?>
          </select>
        </div>
    </fieldset>
    <fieldset>
      <legend>Climate Scenario</legend>
      <div class="pure-u-1 pure-u-md-1-3" style="height: 45px">
        <label for="doi">Emission Scenario</label>
        <!--<input type="hidden" name="climate" id="climate" class="input-xlarge" style="width:350px;" data-placeholder="Choose An Option.." />-->
        <select class="js-data-ajax" style="width: 300px;" name="climate" id="climate">
          <?php
          if (isset($_GET['climate'])) {
            echo "<option value'" . $_GET['climate'] . "' selected='selected'>" . $_GET['climate'] . "</option>";
          }
          ?>
        </select>
      </div>

      <div class="pure-u-1 pure-u-md-1-3" style="height: 45px">
        <label for="baseline">Baseline Period</label>
        <!--<input type="hidden" name="baseline" id="baseline" class="input-xlarge" style="width:200px;" data-placeholder="Choose An Option.." />-->
        <select class="js-data-ajax" style="width: 300px;" name="baseline" id="baseline">
          <?php
          if (isset($_GET['baseline'])) {
            echo "<option value'" . $_GET['baseline'] . "' selected='selected'>" . $_GET['baseline'] . "</option>";
          }
          ?>
        </select>
      </div>

      <div class="pure-u-1 pure-u-md-1-3" style="height: 45px">
        <label for="period">Projection Period</label>
        <!--<input type="hidden" name="period" id="period" class="input-xlarge" style="width:200px;" data-placeholder="Choose An Option.." />-->
        <select class="js-data-ajax" style="width: 300px;" name="period" id="period">
          <?php
          if (isset($_GET['period'])) {
            echo "<option value='" . $_GET['period'] . "' selected='selected'>" . $_GET['period'] . "</option>";
          }
          ?>
        </select>
      </div>
    </fieldset>
    <fieldset>
      <legend>Adaptation</legend>
      <div style="height: 45px">
        <label for="adaptation">Adaptation Column</label>
        <!--<input type="hidden" name="adaptation" id="adaptation" class="input-xlarge" style="width:350px;" data-placeholder="Choose An Option.." />-->
        <select class="js-data-ajax" style="width: 300px;box-shadow: none!important;" name="adaptation[]" id="adaptation" multiple="multiple">
          <?php
          $adaptationDesc = array('CA'=>'Cultivar adaptation', 'FO'=>'Fertilizer optimization', 'TC'=>'TC', 'PDA'=>'Planting date adjustment', 'IO'=>'Irrigation optimization', 'PCA'=>'PCA');
          if (isset($_GET['adaptation'])) {
            foreach ($_GET['adaptation'] as $key => $adapt) {
              echo "<option value='" . $adapt . "' selected='selected'>" . ((isset($adaptationDesc[$adapt]))? $adaptationDesc[$adapt] : $adapt) . "</option>";
            }
          }
          ?>
        </select>
      </div>
      <br>
      <button class="pure-button pure-button-primary" type="submit" >Search</button>
      <button class="pure-button pure-button-primary" type="button" name="reset" id="reset">Reset</button>
    </fieldset>
  </form>

  <p>
  <div id='downloadFile'>
    <h3>Download Data</h3>
    <a href='#' onClick='downloadData()' title='Download Data for Excel'><img style='heigth:60px;width:60px;' src='<?php echo get_template_directory_uri() ?>/img/excel.png'></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <a href='#' onClick='downloadDataCSV()'title='Download Data for CSV'><img style='heigth:60px;width:60px;' src='<?php echo get_template_directory_uri() ?>/img/csv.png'></a>
    <!--<button class='pure-button pure-button-primary' type='button' name='viewall' id='viewall' onClick='viewAllFields()'>View all fields</button>-->
    <!--<button class='pure-button pure-button-primary' type='button' name='viewall' id='viewall' onClick='viewAllFieldsh()'>View all fields header</button>-->
  </div>
  <div id="resultsx"><h3>Results</h3>
    <table id='resulttablex' name='resulttablex' class="display">
      <thead>
        <tr>
                <!--<th>DOI <input type=\"checkbox\" name='columns' value='doi'></th>-->
                <!--<th>Spatial Scale <input type=\"checkbox\" name='columns' value='doi'></th>-->
                <th>Crop <!--<input type=\"checkbox\" name='columns' value='doi'>--></th>
                <th>Multi-Model <!--<input type=\"checkbox\" name='columns' value='doi'>--></th>
                <th>Baseline Period <!--<input type=\"checkbox\" name='columns' value='doi'>--></th>
                <th>Projection Period <!--<input type=\"checkbox\" name='columns' value='doi'>--></th>
                <th>Percentage Yield Change <!--<input type=\"checkbox\" name='columns' value='doi'>--></th>
                <th>Geographical Scope <!--<input type=\"checkbox\" name='columns' value='doi'>--></th>
                <th>Local Mean Temperature Change <!--<input type=\"checkbox\" name='columns' value='doi'>--></th>
                <th>Climate Scenario <!--<input type=\"checkbox\" name='columns' value='doi'>--></th>
          <th>Adaptation</th>
    <!--<th>Validate</th>-->
        </tr>
      </thead>
    </table>
  </div>
</p>
<br>
<h3>Map view</h3>
<div style="width:700px;height:400px;" id="map-canvas"></div>
<br>
</section>
<script>
  var map;
  var markerArray = {};
  function initialize() {
    var myLatlng = new google.maps.LatLng(12.968888, 10.138147);
    var mapOptions = {
      zoom: 2,
      center: myLatlng
    }
    map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
    var script = document.createElement('script');
    script.src = templateUrl + "/wp-content/themes/agimpacts/filteredTable.php?" + $('#filtersh').serialize();
    var s = document.getElementsByTagName('script')[0];
    s.parentNode.insertBefore(script, s);

  }

  window.eqfeed_callback = function(results) {
//    var image = "<?php // bloginfo('template_directory');     ?>/images/ccafs_sites-miniH.png";
    var infobox;
    var markeri = new google.maps.Marker();
    for (var i = 0; i < results.features.length; i++) {
      idx = i;
      var coords = results.features[i].geometry.coordinates;
      var latLng = new google.maps.LatLng(coords[1], coords[0]);
      var marker = new google.maps.Marker({
        position: latLng,
        map: map,
//        icon: image
        //              title: results.features[i].properties.title
      });

//      markerArray[results.features[i].id] = marker;
//      //            google.maps.event.addListener(marker, 'click', function(event) {alert(results.features[idx].properties.title)});
      google.maps.event.addListener(marker, 'mouseover', (function(marker, i, results) {
        return function() {
          if (infobox) {
            eval(infobox).close();
          }
          if (markeri) {
            eval(markeri).setMap(null);
          }
          var contentString = infoWindowContent(results.features[i]);
          infobox = getBox(contentString);
          infobox.open(map, marker);
          google.maps.event.addListener(infobox, "closeclick", function() {
            markeri.setMap(null);
          });
//          var imagei = "<?php // bloginfo('template_directory');     ?>/images/ccafs_sites-miniI.png";
          var coords = results.features[i].geometry.coordinates;
          var latLng = new google.maps.LatLng(coords[1], coords[0]);
          markeri = new google.maps.Marker({
            position: latLng,
            map: map,
            zIndex: 9999999,
//            icon: imagei
          });
//          google.maps.event.addListener(markeri, 'click', (function(i, results) {
//            return function() {
//              document.location = "./?p=" + results.features[i].id;
//            };
//          })(i, results));
        };
      })(marker, i, results));
      google.maps.event.addListener(map, "click", function() {
        infobox.close();
//        markeri.setMap(null);
      });
    }
  }

  function infoWindowContent(result) {
    return '<div class="gmap" id="content"><b>' + result.properties.crop + ' [' + result.geometry.coordinates[0] + ' - ' + result.geometry.coordinates[1] + '] </b><br>DOI: ' + result.properties.doi + '<br>'
            + '</div>';
  }

  function getBox(contentString) {
    return new InfoBox({
      content: contentString,
      disableAutoPan: false,
      maxWidth: 150,
      pixelOffset: new google.maps.Size(-140, 0),
      zIndex: null,
      boxStyle: {
        background: "url('" + templatePath + "/img/tipbox1.gif') no-repeat",
        width: "200px"
      },
      closeBoxMargin: "12px 4px 2px 2px",
      closeBoxURL: "http://www.google.com/intl/en_us/mapfiles/close.gif",
      infoBoxClearance: new google.maps.Size(1, 1)
    });
  }

  google.maps.event.addDomListener(window, 'load', initialize);

  $(document).ready(function() {
    $('#resulttablex').dataTable({
      'scrollX': true,
      'jQueryUI': true,
      "processing": true,
      "serverSide": true,
      "ajax": {
        url: templateUrl + "/wp-content/themes/agimpacts/dataTableFilter.php",
        data: function(d) {
          d.crop = $('#crop').val();
          d.model = $('#model').val();
          d.scale = $('#scale').val();
          d.climate = $('#climate').val();
          d.baseline = $('#baseline').val();
          d.period = $('#period').val();
          d.country = $('#country').val();
          d.subcontinents = $('#subcontinents').val();
          d.adaptation = $('#adaptation').val();
        }
      }
    });
  });
</script>
<?php
get_footer();
?>