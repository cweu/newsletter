<?php
/*
  Template Name: Archief
*/
?>

<?php get_header(); ?>

<div class="archief container">
  <!-- <div class="image">
      <img src="<?php echo $featured_img; ?>" alt="">
  </div> -->
  <div class="content">
    <h1>Archief</h1>
    <ul class="archief_list">
      <?php
        $params = array(
          'limit' => 15,
          'orderby' => 'datum ASC'
        );
        $nieuwsbrief = pods('nieuwsbrief', $params);

        if($nieuwsbrief->total() > 0){
          while($nieuwsbrief->fetch()){
            $jaargang_nummer = $nieuwsbrief->display('jaargang_nummer.name');
            $jaargang_nummer = explode(".", $jaargang_nummer);
            $naam = $nieuwsbrief->display('naam.name');
            $datum = $nieuwsbrief->field('datum.name');
            $permalink = site_url('artikel/' . $nieuwsbrief->field('permalink'));
            $thumbnail = pods_image_url(
              $nieuwsbrief->field( 'image'),
              'thumbnail',
              0,
              true
            );
            echo '
            <li class="archief_list_item">
              <h3>Jaargang '.$jaargang_nummer[0].' nr. '.$jaargang_nummer[1].'</h3>
              <p><!-- TEXT --></p>
              <div class="block">
                <img src="'.$thumbnail.'" alt="'.$naam.'">
                <div class="overlay">
                  <a type="button" name="button" href="'.$permalink.'">OPEN</a>
                </div>
              </div>
            </li>';
          }
        }
      ?>
      <span class="clear"></span>
      <?php
        echo $nieuwsbrief->pagination(array('type' => 'advanced'));
        echo '<br><br>';
      ?>
    </ul>
  </div>
</div>

<?php get_footer(); ?>
