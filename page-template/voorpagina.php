<?php
/*
  Template Name: Voorpagina
*/
?>

<?php get_header(); ?>

<div class="container">
    <?php
      $params = array(
        'limit' => 10,
        'orderby' => 'datum DESC'
      );
      $artikel = pods('artikel', $params);
      $i = 1;

      if($artikel->total() > 0){
        while($artikel->fetch()){
          $title = $artikel->display('name');
          $intro = $artikel->display('intro.name');
          $content = $artikel->display('content');
          $auteur = $artikel->display('auteur.name');
          $featured_img = pods_image_url(
          $artikel->field('featured_img.name'),
            'thumbnail',
            0,
            true
          );
          if($intro != ''){
            $content = $intro;
          }else{
            $content = $content;
          }
          if($featured_img != ''){
            $img = '<img src="'.$featured_img.'">';
          } else {
            $img = '';
          }
          $permalink = site_url('artikel/' . $artikel->field('permalink'));
          $id = $artikel->field('id');

          if($i == 1){
            echo '
            <a href="'.$permalink.'">
              <div class="topartikel">
                <img src="'.$img.'">
              </div>

              <div class="topartikel">
                <h1>'.$title.'</h1>
                <h3>'.$auteur.'</h3>
                <span>'.$content.'</span>
                <br>
              </div>
            </a>
          <hr>
            <h1 class="artikelen">Artikelen</h1>
            <div class="grid">
              <div class="grid-sizer"></div>';
          } else {
            echo '
              <div class="grid-item">
                <a href="'.$permalink.'">
                  <h2>'.$title.'</h2>
                  <p>'.$content.'</p>
                  '.$img.'
                </a>
              </div>
            ';
            if($i == $artikel->total()){

            }
          }
          $i = $i + 1;
        }
      }
    ?>
  </div>
</div>

<hr>

<h1 class="artikelen">Oudere nieuwsbrieven</h1>

<div class="jaargangs">
  <?php
    $params = array(
      'limit' => 10,
      'orderby' => 'datum DESC'
    );
    $nieuwsbrief = pods('nieuwsbrief', $params);

    if($nieuwsbrief->total() > 0){
      while($nieuwsbrief->fetch()){
        $jaargang_nummer = $nieuwsbrief->display('jaargang_nummer.name');
        $jaargang_nummer = explode(".", $jaargang_nummer);
        $naam = $nieuwsbrief->display('naam.name');
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
        <div class="jaargang">
          <a href="'.$pdf.'" target="_blank">
            <h3>Jaargang '.$jaargang_nummer[0].' nr.'.$jaargang_nummer[1].'</h3>
            <p>'.$naam.'</p>
            <img src="'.$thumbnail.'" alt="'.$naam.'"><br>
            OPEN
          </a>
        </div>';
      }
    }
  ?>
</div>

<?php get_footer(); ?>

<script   src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/masonry/4.2.0/masonry.pkgd.min.js"></script>
<script src="https://unpkg.com/imagesloaded@4/imagesloaded.pkgd.min.js"></script>
<script type="text/javascript">
  $( document ).ready(function() {
    $('.grid').masonry({
      itemSelector: '.grid-item',
      columnWidth: '.grid-sizer'
    });
  });
</script>
