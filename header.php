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
    <title><?php wp_title(); ?></title>
    <!-- <meta name="description" content="<?php bloginfo('description'); ?>"> -->
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="keywords" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <?php if(is_singular() && pings_open(get_queried_object())): ?>
      <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
    <?php endif; ?>
    <?php wp_head(); ?>
  </head>

<body <?php body_class(); ?>>
