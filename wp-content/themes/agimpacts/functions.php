<?php

register_sidebar();

register_sidebar(array(
  'name' => 'Secundario',
  'id' => 'secundario'
        )
);

register_nav_menu('main-menu', 'Zona Header');
