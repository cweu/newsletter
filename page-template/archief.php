<?php
/*
  Template Name: Archief
*/
?>

<?php get_header(); ?>

<div class="body">
  <div class="image">
      <img src="<?php echo $featured_img; ?>" alt="">
  </div>
  <div class="content">
    <h1>Archief</h1>
    <div class="row archief">
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
            $pdf = pods_image_url(
              $nieuwsbrief->field('pdf_input'),
              'thumbnail',
              0,
              true
            );
            $thumbnail = pods_image_url(
              $nieuwsbrief->field( 'image'),
              'thumbnail',
              0,
              true
            );
            echo '
            <div class="col">
              <h3>Jaargang '.$jaargang_nummer[0].' nr. '.$jaargang_nummer[1].'</h3>
              <div class="img_container">
                <img src="'.$thumbnail.'" alt="'.$naam.'">
                <div class="overlay">
                  <div class="center"><a href="'.$pdf.'" target="_blank">OPEN</a></div>
                </div>
              </div>
            </div>';
          }
        }
      ?>
      <span class="clear"></span>
      <?php
        echo $nieuwsbrief->pagination(array('type' => 'advanced'));
        echo '<br><br>';
      ?>
    </div>
  </div>
</div>

<?php get_footer(); ?>
