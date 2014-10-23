<html>

  <head>

    <meta charset="utf-8">
    <title>Agriculture Impacts</title>

    <link href="<?php echo get_template_directory_uri(); ?>/css/main.css" rel="stylesheet" type="text/css">

    <?php wp_head(); ?>
  </head>

  <body <?php body_class(); ?> >

    <div class="wrapper">
      <div style="vertical-align:top;">
        <img src="<?php echo get_template_directory_uri(); ?>/img/image.png">
      </div>
      <div class="header">			

        <?php wp_nav_menu(array('theme_location' => 'main-menu', 'menu_class' => 'main-menu')); ?>
      </div>