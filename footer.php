<?php

  /*
    This is the template for the footer

    @package OnWeb Noelhuis
  */

?>

<?php wp_footer(); ?>

<footer class="footer">
  <div class="sections">
    <div class="links">
      <h2>Aanmelden Nieuwsbrief</h2>
      <p>Wilt u zich aanmelden voor deze nieuwbrief?<br> Stuur ons hieronder uw emailadres.</p>
      <input type="text" name="email" value="" placeholder="   E-MAIL"></br>
      <button type="button" name="button">AANMELDEN</button>
    </div>
  </div>

  <div class="sections">
    <div class="midden">
      <!-- <a href="#"><h2>Archief</h2></a><br>
      <a href="#"><h2>Dossiers</h2></a><br>
      <a href="#"><h2>Contact</h2></a> -->
      <?php
        $footer_primary = array(
          'container'       => false,
          'echo'            => false,
          'items_wrap'      => '%3$s',
          'depth'           => 0,
          'theme_location' => 'footer_primary'
        );
        echo strip_tags(wp_nav_menu( $footer_primary ), '<li><a>' );
      ?>
    </div>
  </div>

  <div class="sections">
    <div class="rechts">
      <h2>020-6998996</h2>
      <h2>noelhuis@antenna.nl</h2><br><br>
      <h2>POSTBUS 12622</h2>
      <h2>1100 AP AMSTERDAM</h2><br><br>
      <h2><a href="http://noelhuis.nl">www.noelhuis.nl</a></h2><br>
      <a href="https://www.facebook.com/noelhuis"><img src="<?php echo bloginfo('template_url');?>/img/facebook.png" alt="Facebook"></a>
      <a href="https://twitter.com/search?f=tweets&q=%23noelhuis&src=typd"><img src="<?php echo bloginfo('template_url');?>/img/twitter.png" alt="Twitter"></a>
    </div>
  </div>
</footer>

</body>
</html>
