<?php
/**
 * Template Name: Estimate search
 * @package WordPress
 * @subpackage AMKNToolbox
 */
//require('../../../../wp-load.php');
get_header();
$version = '1.2';
?>
<script type='text/javascript' src='http://maps.google.com/maps/api/js?sensor=false'></script>
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/js/select2/4.0.0/select2.css?<?php echo $version; ?>">
<script src="<?php echo get_template_directory_uri(); ?>/js/select2/4.0.0/select2.min.js?<?php echo $version; ?>"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/agimpact_filter.js?<?php echo $version; ?>"></script>
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/agimpact_filter.css?<?php echo $version; ?>">
<link rel="stylesheet" href="//cdn.datatables.net/plug-ins/3cfcc339e89/integration/jqueryui/dataTables.jqueryui.css">
<script type="text/javascript" src="//cdn.datatables.net/1.10.4/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css">
<script type="text/javascript" src="http://google-maps-utility-library-v3.googlecode.com/svn/trunk/infobox/src/infobox.js"></script>
<div id="loading" style="z-index:9999;display: block"><img style="" src="<?php echo get_template_directory_uri(); ?>/img/loading.gif" alt="Loader" /></div>
<section id="content" class="row"> 

  <form id="filtersh" class="pure-form pure-form-aligned" style="background: #e2e2e2; padding: 20px;">
    <table style="border: none!important">
      <tr>
        <td style="width: 50%;border: none">
          <fieldset>
            <legend style="border-bottom: 1px solid #080808; font-weight: bold">Crop and Region</legend>
            <!--<div class="pure-g">-->
            <table class="clear-table" style="border: none!important">
              <tr>
                <td>
                  <label for="crop">Crop</label>
                </td>
                <td>
                  <select class="js-data-ajax" style="width: 300px;" name="crop" id="crop">
                    <?php
                    if (isset($_GET['crop'])) {
                      echo "<option value'" . $_GET['crop'] . "' selected='selected'>" . $_GET['crop'] . "</option>";
                    }
                    ?>
                  </select>
                </td>
              </tr>
              <tr>
                <td>
                  <label for="model">Impact model(s)</label>
                </td>
                <td>
                  <select class="js-data-ajax" style="width: 300px;" name="model" id="model">
                    <?php
                    if (isset($_GET['model'])) {
                      echo "<option value'" . $_GET['model'] . "' selected='selected'>" . $_GET['model'] . "</option>";
                    }
                    ?>
                  </select>
                </td>
              </tr>
              <tr>
                <td>
                  <label for="scale">Spatial Scale</label>
                </td>
                <td>
                  <select class="js-data-ajax" style="width: 300px;" name="scale" id="scale">
                    <?php
                    if (isset($_GET['scale'])) {
                      echo "<option value'" . $_GET['scale'] . "' selected='selected'>" . $_GET['scale'] . "</option>";
                    }
                    ?>
                  </select>
                </td>
              </tr>
              <tr>
                <td>
                  <label for="continents">Continent</label>
                </td>
                <td>
                  <select class="js-data-ajax" style="width: 300px;" name="continents" id="continents">
                    <?php
                    if (isset($_GET['continents'])) {
                      echo "<option value'" . $_GET['continents'] . "' selected='selected'>" . $_GET['continents'] . "</option>";
                    }
                    ?>
                  </select>
                </td>
              </tr>
              <tr>
                <td>
                  <label for="regions">Region</label>
                </td>
                <td>
                  <select class="js-data-ajax" style="width: 300px;" name="regions" id="regions">
                    <?php
                    if (isset($_GET['regions'])) {
                      echo "<option value'" . $_GET['regions'] . "' selected='selected'>" . $_GET['regions'] . "</option>";
                    }
                    ?>
                  </select>
                </td>
              </tr>
              <tr>
                <td>
                  <label for="country">Country</label>
                </td>
                <td>
                  <select class="js-data-ajax" style="width: 300px;" name="country" id="country">
                    <?php
                    if (isset($_GET['country'])) {
                      echo "<option value'" . $_GET['country'] . "' selected='selected'>" . $_GET['country'] . "</option>";
                    }
                    ?>
                  </select>
                </td>
              </tr>
            </table>
          </fieldset>
        </td>
        <td style="vertical-align: top; border: none">
          <fieldset>
            <legend style="border-bottom: 1px solid #080808; font-weight: bold">Climate Scenario</legend>
            <table class="clear-table" style="border: none!important">
              <tr>
                <td>
                  <label for="doi">Emission Scenario</label>
                </td>
                <td>
                  <select class="js-data-ajax" style="width: 300px;" name="climate" id="climate">
                    <?php
                    if (isset($_GET['climate'])) {
                      echo "<option value'" . $_GET['climate'] . "' selected='selected'>" . $_GET['climate'] . "</option>";
                    }
                    ?>
                  </select>
                </td>
              </tr>
              <tr>
                <td>
                  <label for="baseline">Baseline Period</label>
                </td>
                <td>
                  <select class="js-data-ajax" style="width: 300px;" name="baseline" id="baseline">
                    <?php
                    if (isset($_GET['baseline'])) {
                      echo "<option value'" . $_GET['baseline'] . "' selected='selected'>" . $_GET['baseline'] . "</option>";
                    }
                    ?>
                  </select>
                </td>
              </tr>
              <tr>
                <td>
                  <label for="period">Projection Period</label>
                </td>
                <td>
                  <select class="js-data-ajax" style="width: 300px;" name="period" id="period">
                    <?php
                    if (isset($_GET['period'])) {
                      echo "<option value='" . $_GET['period'] . "' selected='selected'>" . $_GET['period'] . "</option>";
                    }
                    ?>
                  </select>
                </td>
              </tr>
            </table>
          </fieldset>
        </td>
      </tr>
      <tr>
        <td style="border: none">
          <fieldset>
            <legend style="border-bottom: 1px solid #080808; font-weight: bold">Adaptation</legend>
            <table class="clear-table" style="border: none!important">
              <tr>
                <td>
                  <label for="adaptation">Adaptation Column</label>
                </td>
                <td>
                  <select class="js-data-ajax" style="width: 300px;box-shadow: none!important;" name="adaptation[]" id="adaptation" multiple="multiple">
                    <?php
                    $adaptationDesc = array('CA' => 'Cultivar adaptation', 'FO' => 'Fertilizer optimization', 'TC' => 'TC', 'PDA' => 'Planting date adjustment', 'IO' => 'Irrigation optimization', 'PCA' => 'PCA');
                    if (isset($_GET['adaptation'])) {
                      foreach ($_GET['adaptation'] as $key => $adapt) {
                        echo "<option value='" . $adapt . "' selected='selected'>" . ((isset($adaptationDesc[$adapt])) ? $adaptationDesc[$adapt] : $adapt) . "</option>";
                      }
                    }
                    ?>
                  </select>
                </td>
              </tr>
            </table>
            <br>
            <button class="pure-button pure-button-primary" type="submit" >Search</button>
            <button class="pure-button pure-button-primary" type="button" name="reset" id="reset">Reset</button>
          </fieldset>
        </td>
      </tr>
    </table>
  </form>

  <p>
  <div id='downloadFile'>
    <h3>Download Data</h3>
    <a href='#' onClick='downloadData()' title='Download Data for Excel'><img style='heigth:60px;width:60px;' src='<?php echo get_template_directory_uri() ?>/img/excel.png'></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <a href='#' onClick='downloadDataCSV()'title='Download Data for CSV'><img style='heigth:60px;width:60px;' src='<?php echo get_template_directory_uri() ?>/img/csv.png'></a>
    <!--<button class='pure-button pure-button-primary' type='button' name='viewall' id='viewall' onClick='viewAllFields()'>View all fields</button>-->
    <button class='pure-button pure-button-primary' type='button' name='viewall' id='viewall' onClick='viewAllFieldsh()'>View all fields</button>
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
<!--<h3 id="map_title_chart" name="map_title" style="display: none">Column Chart</h3>-->
<div style="width:1020px;height:600px;display: none" id="column-chart"></div>
<br>
<!--<h3 id="map_title" name="map_title">Map view</h3>
<div style="width:1020px;height:600px;" id="map-canvas"></div>
<br>-->
<!--<h3 id="map_title" name="map_title">Map geochart</h3>-->
<div id="mapBox" style="display: none">
  <div class="selector">
    <!--<button id="btn-prev-map" class="prev-next"><i class="fa fa-angle-left"></i></button>-->
    <select id="mapDropdown" class="ui-widget combobox">
      <option value="0" selected="true">Median</option>
      <option value="1">Mean</option>
    </select>
    <!--<button id="btn-next-map" class="prev-next"><i class="fa fa-angle-right"></i></button>-->
  </div>
  <div style="width:1020px;height:600px;" id="map-geochart"></div> 
</div>
<br>
<!--<h3 id="scatter_title" name="scatter_title" style="display: none">Scatter Chart</h3>-->
<div style="width:1020px;height:600px;display: none" id="scatter-chart"></div>
<br>
</section>
<script>
//  var map;
//  var markerArray = {};
//  function initialize() {
//    var myLatlng = new google.maps.LatLng(12.968888, 10.138147);
//    var mapOptions = {
//      zoom: 2,
//      center: myLatlng
//    }
//    map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
//    var script = document.createElement('script');
//    script.src = templateUrl + "/wp-content/themes/agimpacts/filteredTable.php?" + $('#filtersh').serialize();
//    var s = document.getElementsByTagName('script')[0];
//    s.parentNode.insertBefore(script, s);
//
//  }
//
//  window.eqfeed_callback = function(results) {
////    var image = "<?php // bloginfo('template_directory');                                     ?>/images/ccafs_sites-miniH.png";
//    var infobox;
//    var markeri = new google.maps.Marker();
//    $("#map_title").append("<bold> (" + results.features.length + " estimates on the map)</bold>");
//    for (var i = 0; i < results.features.length; i++) {
//      idx = i;
//      var coords = results.features[i].geometry.coordinates;
//      var latLng = new google.maps.LatLng(coords[1], coords[0]);
//      var marker = new google.maps.Marker({
//        position: latLng,
//        map: map,
////        icon: image
//        //              title: results.features[i].properties.title
//      });
//
////      markerArray[results.features[i].id] = marker;
////      //            google.maps.event.addListener(marker, 'click', function(event) {alert(results.features[idx].properties.title)});
//      google.maps.event.addListener(marker, 'mouseover', (function(marker, i, results) {
//        return function() {
//          if (infobox) {
//            eval(infobox).close();
//          }
//          if (markeri) {
//            eval(markeri).setMap(null);
//          }
//          var contentString = infoWindowContent(results.features[i]);
//          infobox = getBox(contentString);
//          infobox.open(map, marker);
//          google.maps.event.addListener(infobox, "closeclick", function() {
//            markeri.setMap(null);
//          });
////          var imagei = "<?php // bloginfo('template_directory');                                     ?>/images/ccafs_sites-miniI.png";
//          var coords = results.features[i].geometry.coordinates;
//          var latLng = new google.maps.LatLng(coords[1], coords[0]);
//          markeri = new google.maps.Marker({
//            position: latLng,
//            map: map,
//            zIndex: 9999999,
////            icon: imagei
//          });
////          google.maps.event.addListener(markeri, 'click', (function(i, results) {
////            return function() {
////              document.location = "./?p=" + results.features[i].id;
////            };
////          })(i, results));
//        };
//      })(marker, i, results));
//      google.maps.event.addListener(map, "click", function() {
//        infobox.close();
////        markeri.setMap(null);
//      });
//    }
//  }
//
//  function infoWindowContent(result) {
//    return '<div class="gmap" id="content"><b>' + result.properties.crop + ' [' + result.geometry.coordinates[0] + ' - ' + result.geometry.coordinates[1] + '] </b><br>DOI: ' + result.properties.doi + '<br>'
//            + '</div>';
//  }
//
//  function getBox(contentString) {
//    return new InfoBox({
//      content: contentString,
//      disableAutoPan: false,
//      maxWidth: 150,
//      pixelOffset: new google.maps.Size(-140, 0),
//      zIndex: null,
//      boxStyle: {
//        background: "url('" + templatePath + "/img/tipbox1.gif') no-repeat",
//        width: "200px"
//      },
//      closeBoxMargin: "12px 4px 2px 2px",
//      closeBoxURL: "http://www.google.com/intl/en_us/mapfiles/close.gif",
//      infoBoxClearance: new google.maps.Size(1, 1)
//    });
//  }
//
  //  google.maps.event.addDomListener(window, 'load', initialize);
//
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
          d.continents = $('#continents').val();
          d.regions = $('#regions').val();
          d.adaptation = $('#adaptation').val();
        }
      }
    });
  });
</script>
<script src="http://code.highcharts.com/highcharts.js"></script>
<script src="http://code.highcharts.com/highcharts-more.js"></script>
<script src="http://code.highcharts.com/maps/modules/map.js"></script>
<script src="http://code.highcharts.com/maps/modules/data.js"></script>
<script src="http://code.highcharts.com/mapdata/custom/world.js"></script>
<script src="http://code.highcharts.com/modules/exporting.js"></script>

<!--<script type="text/javascript" src="https://www.google.com/jsapi"></script>-->
<script type="text/javascript">
//  google.load("visualization", "1", {packages: ["geochart"]});
//  google.setOnLoadCallback(drawRegionsMap);
//
//  function drawRegionsMap() {
//
//    $.ajax({
//      url: templateUrl + "/wp-content/themes/agimpacts/filteredTable.php?type=geochart",
//      type: "POST",
//      data: $('#filtersh').serialize(),
//      success: function(result) {
//        if (!result) {
//          var objJSON = [
//            ['Country', 'DY'],
//          ];
//        } else {
//          var objJSON = eval("(function(){return " + result + ";})()");
//        }
//        var data = google.visualization.arrayToDataTable(objJSON);
//        /*
//         [
//         ['Country','DY'],
//         ['Germany', 200],
//         ['United States', 300],
//         ['Brazil', 400],
//         ['Canada', 500],
//         ['France', 600],
//         ['RU', 700]
//         ] 
//         */
//        var options = {
////      region: '002', // Africa
////      colorAxis: {colors: ['#00853f', 'black', '#e31b23']},
//          backgroundColor: '#81d4fa'
//        };
//
//        var chart = new google.visualization.GeoChart(document.getElementById('map-canvas'));
//        chart.draw(data, options);
//      },
//      complete: function() {
////        $("#loading").fadeOut('slow');
  ////      $("#result").show();
//      }
//    });
//  }

  $(function() {
    $("#mapDropdown").change(function() {
      var $selectedItem = $("option:selected", this),
              mapDesc = $selectedItem.text(),
              mapKey = this.value;
      minColor = '#F75945', maxColor = '#102D4C';
      if (mapKey == 1) {
        //        minColor = '#990041',
//        maxColor = '#990041';
      }

      $.ajax({
        url: templateUrl + "/wp-content/themes/agimpacts/filteredTable.php?type=highmap",
        type: "POST",
        data: $('#filtersh').serialize(),
        success: function(result) {
          if (result == 'null') {
            var objJSON = [
              ['Country', 'DY'],
            ];
          } else {
            var objJSON = eval("(function(){return " + result + ";})()");
            $('#mapBox').show();
          }
          var data = objJSON;
          $('#map-geochart').highcharts('Map', {
            chart: {
//              borderWidth: 1
            },
            colors: ['rgba(19,64,117,0.05)', 'rgba(19,64,117,0.2)', 'rgba(19,64,117,0.4)',
              'rgba(19,64,117,0.5)', 'rgba(19,64,117,0.6)', 'rgba(19,64,117,0.8)', 'rgba(19,64,117,1)'],
            title: {
              text: 'Projected yield change by country'
            },
            mapNavigation: {
              enabled: true
            },
            legend: {
              title: {
                text: mapDesc + ' projected yield change (%)',
                style: {
                  color: (Highcharts.theme && Highcharts.theme.textColor) || 'black'
                }
              },
//              align: 'left',
//              verticalAlign: 'bottom',
//              floating: true,
//              layout: 'vertical',
//              valueDecimals: 0
            },
            colorAxis: {
//              minColor: '#313695',
//              maxColor: '#a50026',
              min: -100,
              max: 100,
              stops: [
                [0, '#a50026'],
                [0.5, '#e7f5ea'],
                [0.9, '#313695']
            ]
//              dataClasses: [{
//                  from: 75,
//                  to: 100,
//                  color: '#313695'
//                }, {
//                  from: 50,
//                  to: 75,
//                  color: '#588cc0'
//                }, {
//                  from: 25,
//                  to: 50,
//                  color: '#a1d1e4'
//                }, {
//                  from: 0,
//                  to: 25,
//                  color: '#e7f5ea'
//                }, {
//                  from: -25,
//                  to: 0,
//                  color: '#fee79b'
//                }, {
//                  from: -50,
//                  to: -25,
//                  color: '#fba25b'
//                }, {
//                  from: -75,
//                  to: -50,
//                  color: '#e34932'
//                }, {
//                  from: -100,
//                  to: -75,
//                  color: '#a50026'
//                }]
            },
            series: [{
                name: 'median',
                data: data[mapKey],
                mapData: Highcharts.geojson(Highcharts.maps['custom/world']),
                joinBy: ['iso-a2', 'code'],
                animation: true,
                name: 'Projected yield change',
                        states: {
                          hover: {
                            color: '#BADA55'
                          }
                        },
                tooltip: {
                  //                valueSuffix: '%',
                  useHTML: true,
                  headerFormat: '<span style="font-weight: bold;">{point.key}</span><br/>',
                  pointFormat: '<span style="font-weight: bold;">Median</span>: {point.median:.1f} ± {point.dev:.1f}%<br><span style="font-weight: bold;">Mean</span>: {point.mean:.1f} %<br><span style="font-weight: bold;">Range</span>: [{point.min:.1f}, {point.max:.1f}]<br><span style="font-weight: bold;">N. of stimates</span>: {point.num}'
                }
              }]
          });
        },
        complete: function() {
        }
      })
    });
    $('#mapDropdown').change();

    $.ajax({
      url: templateUrl + "/wp-content/themes/agimpacts/filteredTable.php?type=columnChart",
      type: "POST",
      data: $('#filtersh').serialize(), success: function(result) {
        if (result == 'null') {
          return;
        } else {
          var objJSON = eval("(function(){return " + result + ";})()");
          $('#column-chart').show();
        }
        var data = objJSON;
        $('#column-chart').highcharts({
          chart: {
            zoomType: 'xy'
          },
          title: {
            text: 'Projected yield change by country'
          },
          tooltip: {
            shared: true
          }, yAxis: {// Secondary yAxis
            title: {
              text: 'Yield change (%)',
              style: {
                //                color: Highcharts.getOptions().colors[0]
              }
            },
            labels: {format: '{value} %',
              style: {
                //                color: Highcharts.getOptions().colors[0]
              }
            },
            //            opposite: true
          },
          xAxis: {
            type: 'category',
            labels: {
              rotation: -45,
              style: {
                fontSize: '13px',
                fontFamily: 'Verdana, sans-serif'
              }
            }
          },
          credits: {
            enabled: false
          },
          series: [{
              name: 'Delta Yield',
              type: 'column',
              data: data[0],
              tooltip: {
                pointFormat: '<span style="font-weight: bold; color: {series.color}">ΔYield</span>: <b>{point.y:.1f} %</b> '
              },
              dataLabels: {
                enabled: true, //                rotation: -90,
                color: '#FFFFFF',
                align: 'center',
                format: '{point.y:.1f}', // one decimal
                y: 10, // 10 pixels down from the top
                style: {
                  fontSize: '13px',
                  fontFamily: 'Verdana, sans-serif'
                }
              }
            }, {
              name: 'Crop error',
              type: 'errorbar',
              //              yAxis: 1,
              data: data[1],
              tooltip: {
                pointFormat: '(error range: ({point.low})-({point.high}) %)<br/>'
              }
            }]
        });
      },
      complete: function() {
      }
    });

    $.ajax({
      url: templateUrl + "/wp-content/themes/agimpacts/filteredTable.php?type=scatterChart",
      type: "POST",
      data: $('#filtersh').serialize(), success: function(result) {
        if (result == 'null') {
          return;
        } else {
          var objJSON = eval("(function(){return " + result + ";})()");
          $('#scatter-chart').show();
        }
        var data = objJSON;
        $('#scatter-chart').highcharts({
          xAxis: {
            title: {
              text: 'ΔTemperature change(C°)'
            }
          },
          yAxis: {
            title: {
              text: 'ΔYield change (%)'
            }
          },
          tooltip: {
            shared: true
          },
          title: {
            text: 'Yield response by Temperature change'
          },
          series: [{
              type: 'scatter',
              name: 'Temperature',
              data: data[0],
              tooltip: {
                pointFormat: 'Temperature: {point.x:.1f}C° <br/>Yield: {point.y:.1f}%<br/>'
              },
              marker: {
                radius: 4
              }
            }, {
              type: 'spline',
              name: 'Moving average',
              data: data[1],
              tooltip: {
                headerFormat: '',
                pointFormat: 'Yield moving average: {point.y:.2f}%<br/>'
              },
              marker: {
                lineWidth: 2,
                lineColor: Highcharts.getOptions().colors[3],
                fillColor: 'white'
              }
            }]
        });
      }
    });
  });
</script>
<?php
get_footer();
?>