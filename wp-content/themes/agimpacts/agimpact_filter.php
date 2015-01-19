<?php
/**
 * Template Name: Estimate search
 * @package WordPress
 * @subpackage AMKNToolbox
 */
//require('../../../../wp-load.php');
get_header();
?>
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/js/select2/4.0.0/select2.css">
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/js/tablesorter/css/theme.green.css">
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/tablesorter/js/jquery.tablesorter.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/select2/4.0.0/select2.min.js"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/agimpact_filter.js"></script>
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/agimpact_filter.css">
<div id="loading"><img style="" src="<?php echo get_template_directory_uri(); ?>/img/loading.gif" alt="Loader" /></div>
<section id="content" class="row"> 

  <form action="action" method="POST" class="pure-form pure-form-aligned">
    <fieldset>
      <legend>Crop and Region</legend>
      <div class="pure-g">
        <div class="pure-u-1 pure-u-md-1-3" style="height: 45px">
          <label for="crop">Crop</label>
          <select class="js-data-ajax" style="width: 300px;" name="crop" id="crop">
          </select>
          <!--<input type="hidden" name="crop" id="crop" class="input-xlarge" style="width:350px;" data-placeholder="Choose An Option.." />-->
        </div>
        <div class="pure-u-1 pure-u-md-1-3" style="height: 45px">
          <label for="model">Multi Model Ensemble</label>
          <!--<input type="hidden" name="model" id="model" class="input-xlarge" style="width:350px;" data-placeholder="Choose An Option.." />-->
          <select class="js-data-ajax" style="width: 300px;" name="model" id="model">
          </select>
        </div>
        <div class="pure-u-1 pure-u-md-1-3" style="height: 45px">
          <label for="scale">Spatial Scale</label>
          <!--<input type="hidden" name="scale" id="scale"  data-placeholder="Choose An Option.." />-->
          <select class="js-data-ajax" style="width: 300px;" name="scale" id="scale">
          </select>
        </div>
        <div class="pure-u-1 pure-u-md-1-3" style="height: 45px">
          <label for="continents">Continent</label>
          <!--<input type="hidden" name="continents" id="continents" class="input-xlarge" style="width:350px;" data-placeholder="Choose An Option.." />-->
          <select class="js-data-ajax" style="width: 300px;" name="continents" id="continents">
          </select>
        </div>
        <div class="pure-u-1 pure-u-md-1-3" style="height: 45px">
          <label for="regions">Region</label>
          <!--<input type="hidden" name="regiosn" id="regions" class="input-xlarge" style="width:350px;" data-placeholder="Choose An Option.." />-->
          <select class="js-data-ajax" style="width: 300px;" name="regions" id="regions">
          </select>
        </div>
        <div class="pure-u-1 pure-u-md-1-3" style="height: 45px">
          <label for="country">Country</label>
          <!--<input type="hidden" name="country" id="country" class="input-xlarge" style="width:350px;" data-placeholder="Choose An Option.." />-->
          <select class="js-data-ajax" style="width: 300px;" name="country" id="country">
          </select>
        </div>
    </fieldset>
    <fieldset>
      <legend>Climate Scenario</legend>
      <div class="pure-u-1 pure-u-md-1-3" style="height: 45px">
        <label for="doi">Emission Scenario</label>
        <!--<input type="hidden" name="climate" id="climate" class="input-xlarge" style="width:350px;" data-placeholder="Choose An Option.." />-->
        <select class="js-data-ajax" style="width: 300px;" name="climate" id="climate">
        </select>
      </div>

      <div class="pure-u-1 pure-u-md-1-3" style="height: 45px">
        <label for="baseline">Baseline Period</label>
        <!--<input type="hidden" name="baseline" id="baseline" class="input-xlarge" style="width:200px;" data-placeholder="Choose An Option.." />-->
        <select class="js-data-ajax" style="width: 300px;" name="baseline" id="baseline">
        </select>
      </div>

      <div class="pure-u-1 pure-u-md-1-3" style="height: 45px">
        <label for="period">Projection Period</label>
        <!--<input type="hidden" name="period" id="period" class="input-xlarge" style="width:200px;" data-placeholder="Choose An Option.." />-->
        <select class="js-data-ajax" style="width: 300px;" name="period" id="period">
        </select>
      </div>
    </fieldset>
    <fieldset>
      <legend>Adaptation</legend>
      <div class="pure-u-1 pure-u-md-1-3" style="height: 45px">
        <label for="doi">Adaptation Column</label>
        <!--<input type="hidden" name="adaptation" id="adaptation" class="input-xlarge" style="width:350px;" data-placeholder="Choose An Option.." />-->
        <select class="js-data-ajax" style="width: 300px;" name="adaptation" id="adaptation">
        </select>
      </div>
      <button class="pure-button pure-button-primary" type="button" name="search" id="search">Search</button>
      <button class="pure-button pure-button-primary" type="button" name="reset" id="reset">Reset</button>
      </div>
    </fieldset>
  </form>
  <p>
  <div id="results"><h3>Results</h3></div>
</p>
<div id="success"></div>
</section>
<?php get_footer(); ?>