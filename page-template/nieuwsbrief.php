<?php
/*
  Template Name: Nieuwsbrief
*/
?>

<?php
  $slug = pods_v( 'last', 'url' );
  $pods = pods('nieuwsbrief', $slug);
  $pdf = pods_image_url(
    $pods->field('pdf_input'),
    'thumbnail',
    0,
    true
  );
?>
<style>
  body{
    padding: 0;
  }
  .pdfobject-container { height: 100%;}
  .pdfobject { border: 1px solid #666; }
</style>

<div id="example1"></div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfobject/2.0.201604172/pdfobject.min.js"></script>
<script>PDFObject.embed("<?php echo $pdf; ?>", "#example1");</script>
