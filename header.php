<?php

  /*
    This is the template for the header

    @package OnWeb Noelhuis
  */

  // http://www.ilberretto.nl/

?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>
  <head>
    <title>Catholic Worker Amsterdam <?php wp_title(); ?></title>
    <!-- <meta name="description" content="<?php bloginfo('description'); ?>"> -->
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="keywords" content="">
    <meta name="description" content="Catholic Worker Amsterdam">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <?php if(is_singular() && pings_open(get_queried_object())): ?>
      <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
    <?php endif; ?>
    <?php wp_head(); ?>
  </head>

  <nav class="navigatie">
      <ul>
        <img src="<?php echo bloginfo('template_url');?>/img/logo_cwa.png" alt="Catholic Worker Amsterdam" class="navimage">
        <p class="tekstonderlogo">Nieuwsbrief Jeannette Noëlhuis</p>
        <!-- <li>colofon</li>
        <li>agenda</li>
        <li>archief</li>
        <li><a class="active">voorpagina</a></li> -->
        <div class="float-right">
          <?php
            $footer_primary = array(
              'container'       => false,
              'echo'            => false,
              'items_wrap'      => '%3$s',
              'depth'           => 0,
              'theme_location' => 'header_primary'
            );
            echo strip_tags(wp_nav_menu( $footer_primary ), '<li><a>' );
          ?>
        </div>
      </ul>
    </nav>

<body <?php body_class(); ?>>
