<?php
/*
  Template Name: Voorpagina
*/
?>

<?php get_header(); ?>

<div class="container">
  <h1 class="artikelen">Artikelen</h1>
  <div class="grid">
    <div class="grid-sizer"></div>
    <?php
      $params = array(
        'limit' => 1,
        'orderby' => 'datum DESC'
      );
      $artikel = pods('artikel', $params);

      if($artikel->total() > 0){
        while($artikel->fetch()){
          $title = $artikel->display('name');
          $intro = $artikel->display('intro.name');
          $content = $artikel->display('content');
          $gridImage = pods_image_url(
            $artikel->field('grid_img'),
            'thumbnail',
            0,
            true
          );
          if($intro != ''){
            $content = $intro;
          }else{
            $content = $content;
          }
          if($gridImage != ''){
            $img = '<img src="'.$gridImage.'" alt="'.$title.'">';
          } else {
            $img = '';
          }
          $permalink = site_url('artikel/' . $artikel->field('permalink'));
          $id = $artikel->field('id');
          echo '
            <div class="grid-item">
              <a href="'.$permalink.'">
                <h2>'.$title.'</h2>
                <p>'.$content.'</p>
                '.$img.'
              </a>
            </div>
          ';
        }
      }
    ?>
  </div>
  <?php
    echo $artikel->pagination(array('type' => 'advanced'));
  ?>
  <br><br>
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
