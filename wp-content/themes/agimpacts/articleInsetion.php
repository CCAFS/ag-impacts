<?php

/**
 * Template Name: Article creation
 * @package WordPress
 * @subpackage AMKNToolbox
 */
get_header();
?>
<div id="loading"><img style="" src="<?php echo get_template_directory_uri(); ?>/img/loading.gif" alt="Loader" /></div>
<section id="content" class="row"> 
  <div id="home-content">
    <h1>Reference Article</h1>
    <form id="articleForm" class="pure-form pure-form-aligned">
      <fieldset>
        <div class="pure-control-group">
          <label for="name">DOI</label>
          <input id="doi" name="doi" type="text" class="pure-input-1-3" placeholder="DOI">
        </div>
        <div class="pure-controls">
            <button type="button" class="pure-button pure-button-primary" onclick="validDoi($('#doi').val())">Validate</button>
        </div>
        <hr>
        <div class="pure-control-group">
          <label for="title">Title</label>
          <input id="title" name="title" type="text" class="pure-input-1-3" placeholder="Title">
        </div>
        <div class="pure-control-group">
          <label for="author">Author(s)</label>
          <input id="author" name="author" type="text" class="pure-input-1-3" placeholder="Author">
        </div>
        <div class="pure-control-group">
          <label for="year">Year</label>
          <input id="year" name="year" type="text" class="pure-input-1-3" placeholder="Year">
        </div>
        <div class="pure-control-group">
          <label for="journal">Journal</label>
          <input id="journal" name="journal" type="text" class="pure-input-1-3" placeholder="Journal">
        </div>
        <div class="pure-control-group">
          <label for="volume">Volume</label>
          <input id="volume" name="volume" type="text" class="pure-input-1-3" placeholder="Volume">
        </div>
        <div class="pure-control-group">
          <label for="issue">Issue</label>
          <input id="issue" name="issue" type="text" class="pure-input-1-3" placeholder="Issue">
        </div>
        <div class="pure-control-group">
          <label for="pstart">Page Start</label>
          <input id="pstart" name="pstart" type="text" class="pure-input-1-3" placeholder="DOI">
        </div>
        <div class="pure-control-group">
          <label for="pend">Page End</label>
          <input id="pend" name="pend" type="text" class="pure-input-1-3" placeholder="DOI">
        </div>
        <div class="pure-control-group">
          <label for="reference">Reference</label>
          <input id="reference" name="reference" type="text" class="pure-input-1-3" placeholder="Reference">
        </div>
        <div class="pure-controls">
            <button type="button" class="pure-button pure-button-primary" onclick="saveArticle($('#articleForm').serialize())">Save</button>
        </div>
      </fieldset>
    </form>
    
  </div>
</section>
<script>
  $('#doi').on('keyup', function(e) {
    if (e.which == 13) {
//        e.preventDefault();
        validDoi($('#doi').val())
    }
});
</script>
<?php get_footer(); ?>