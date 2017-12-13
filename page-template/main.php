<?php
/*
  Template Name: Main
*/
?>

<?php get_header(); ?>

<div class="body">
    <!-- START IMAGE -->
    <!-- <div class="image">
        <img src="<?php echo $featured_img; ?>" alt="">
    </div> -->
    <!-- END IMAGE -->

    <!-- START CONTENT -->
    <div class="content">
      <?php
      if(have_posts()):
        while(have_posts()): the_post(); ?>
          <?php the_content(); ?>
        <?php endwhile;
      endif;
      ?>
      <br>
    </div>
    <!-- END CONTENT -->
</div>

<?php get_footer(); ?>
