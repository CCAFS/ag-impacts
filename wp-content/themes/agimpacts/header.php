<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->

  <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <title>Agriculture Impacts</title>
      <meta name="description" content="">
      <meta name="viewport" content="width=device-width, initial-scale=1">

      <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->

      
      <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/pure-min-custom.css">
      <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" >
      <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/main.css">
      <script src="<?php echo get_template_directory_uri(); ?>/js/vendor/modernizr-2.6.2.min.js"></script>
      <?php wp_head(); ?>
  </head>
  <body <?php body_class(); ?> > 
    <header> 
      <nav class="clearfix"> 
        <div class="row">
          <!--[if lt IE 7]>
            <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
          <![endif]--> 
          <?php wp_nav_menu(array('theme_location' => 'main-menu', 'menu_class' => 'main-menu')); ?>
          <div id="login" class="right">
          <form class="pure-form">
            <button type="submit" id="btn-signup" class="pure-button button-small">Sign up</button>
            - 
            <input type="text" id="input-username" placeholder="Username" />
            <input type="password" id="input-password" placeholder="Password" />
            <button type="submit" id="btn-login" class="pure-button button-small"> Log in</button>
          </form>
        </div>
        </div>
      </nav>
      <div class="row">
        <div id="ag-logo" class="left" ><img src="<?php echo get_template_directory_uri(); ?>/img/ag-logo.png"></div>
        <div id="partners-logo" class="right"><img src="<?php echo get_template_directory_uri(); ?>/img/partners-logo.png"></div>
      </div>
    </header>  
     
   