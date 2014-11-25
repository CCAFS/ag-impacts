<?php
/**
 * Template Name: Estimate search
 * @package WordPress
 * @subpackage AMKNToolbox
 */
//require('../../../../wp-load.php');
get_header();
?>
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/js/select2/select2.css">
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/js/tablesorter/css/theme.green.css">
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/tablesorter/js/jquery.tablesorter.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/select2/select2.min.js"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/agimpact_filter.js"></script>
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/agimpact_filter.css">
<section id="content" class="row"> 

  <form action="action" method="POST" class="pure-form pure-form-aligned">
    <fieldset>
      <legend>Filter</legend>
      <div class="pure-g">
        <div class="pure-u-1 pure-u-md-1-3" style="height: 45px">
          <label for="crop">Crop</label>
          <input type="hidden" name="crop" id="crop" class="input-xlarge" style="width:350px;" data-placeholder="Choose An Option.." />
        </div>
        <div class="pure-u-1 pure-u-md-1-3" style="height: 45px">
          <label for="model">Crop Model</label>
          <input type="hidden" name="model" id="model" class="input-xlarge" style="width:350px;" data-placeholder="Choose An Option.." />
        </div>
        
        <div class="pure-u-1 pure-u-md-1-3" style="height: 45px">
          <label for="doi">Emission Scenario</label>
          <input type="hidden" name="climate" id="climate" class="input-xlarge" style="width:350px;" data-placeholder="Choose An Option.." />
        </div>

        <div class="pure-u-1 pure-u-md-1-3" style="height: 45px">
          <label for="baseline_start">Baseline Period Start</label>
          <input type="hidden" name="baseline_start" id="baseline_start" class="input-xlarge" style="width:80px;" data-placeholder="Choose An Option.." />
        </div>
        <div class="pure-u-1 pure-u-md-1-3" style="height: 45px">
          <label for="baseline_end">Baseline Period End</label>
          <input type="hidden" name="baseline_end" id="baseline_end" class="input-xlarge" style="width:80px;" data-placeholder="Choose An Option.." />
        </div>

        <div class="pure-u-1 pure-u-md-1-3" style="height: 45px">
          <label for="period_start">Projection Period Start</label>
          <input type="hidden" name="period_start" id="period_start" class="input-xlarge" style="width:80px;" data-placeholder="Choose An Option.." />
        </div>
        <div class="pure-u-1 pure-u-md-1-3" style="height: 45px">
          <label for="period_end">Projection Period End</label>
          <input type="hidden" name="period_end" id="period_end" class="input-xlarge" style="width:80px;" data-placeholder="Choose An Option.." />
        </div>
        <div class="pure-u-1 pure-u-md-1-3" style="height: 45px">
          <label for="scale">Spatial Scale</label>
          <input type="hidden" name="scale" id="scale"  data-placeholder="Choose An Option.." />
        </div>

        <div id="location">
          <div class="pure-u-1 pure-u-md-1-3" style="height: 45px">
            <label for="subcontinents">Continent</label>
            <input type="hidden" name="subcontinents" id="subcontinents" class="input-xlarge" style="width:350px;" data-placeholder="Choose An Option.." />
          </div>
          <div class="pure-u-1 pure-u-md-1-3" style="height: 45px">
            <label for="region">Region</label>
            <input type="hidden" name="region" id="region" class="input-xlarge" style="width:350px;" data-placeholder="Choose An Option.." />
          </div>
          <div class="pure-u-1 pure-u-md-1-3" style="height: 45px">
            <label for="country">Country</label>
            <input type="hidden" name="country" id="country" class="input-xlarge" style="width:350px;" data-placeholder="Choose An Option.." />
          </div>
        </div>

        <div class="pure-u-1 pure-u-md-1-3" style="height: 45px">
          <label for="doi">Adaptation Column</label>
          <input type="hidden" name="adaptation" id="adaptation" class="input-xlarge" style="width:350px;" data-placeholder="Choose An Option.." />
        </div>
        <button class="pure-button pure-button-primary" type="button" name="search" id="search">Search</button>
      </div>
    </fieldset>
  </form>
  <p>
  <div id="results"><h3>Results</h3></div>
</p>
<div id="success"></div>
</section>
<?php get_footer(); ?>