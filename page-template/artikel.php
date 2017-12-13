<?php
/*
  Template Name: Artikel
*/
?>

<?php get_header(); ?>

<?php
  $slug = pods_v( 'last', 'url' );
  $pods = pods('artikel', $slug);

  //variable
  $title = $pods->field('name'); // Title
  $content = $pods->field('content'); // Content
  $intro = $pods->field('intro.name'); // Intro
  $auteur = $pods->field('auteur.name'); // Auteur
  $datum = $pods->field('datum.name');
  $auteur_bio = $pods->field('auteur_bio.name'); // Auteur
  $illustratie = $pods->field('illustratie.name'); // Illustratue auteur
  $featured_img = pods_image_url(
    $pods->field('featured_img'),
    'thumbnail',
    0,
    true
  );
  $jaargang_nummer = $pods->field('jaargang_nummer.name');
  $permalink = site_url('artikel/' . $pods->field('permalink'));
  $url_encode = urlencode($permalink);

  if($featured_img != ''){
    $img = '<div class="image"><img src="'.$featured_img.'" alt="'.$title.'"></div>';
  } else {
    $img = '';
  }
?>


<div class="body">
    <!-- START IMAGE -->
    <?php echo $img; ?>
    <!-- END IMAGE -->

    <!-- START CONTENT -->
    <div class="content artikel">
        <h1><?php echo $title; ?></h1> <!-- FIRST HEADER -->
        <small><?php echo $auteur; ?>, <?php echo date("d-m-Y", strtotime($datum)); ?><?php if($jaargang_nummer != '0.00' && $jaargang_nummer != ''){ echo ', ISSUE NR. ' . $jaargang_nummer;} ?></small>
        <p class="intro"> <!-- TEXT -->
            <?php echo $intro; ?>
        </p>

        <?php echo wpautop($content);?>

        <!-- BIO TEXT -->

        <p class="bio">
          <?php echo $auteur_bio; ?>
        </p>
        <br>
        <!-- CONTENT FOOTER -->

        <div class="foot">
            <h2>Deel dit bericht</h2>
            <div class="icons">
                <a href="https://twitter.com/home?status=<?php echo $url_encode; ?>" target="_blank"><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADIAAAAyCAYAAAAeP4ixAAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAAJcEhZcwAADsMAAA7DAcdvqGQAAAL0SURBVGhD7dlpqA1hHMfxY1f2pSyRspREpGxlLSElpCReuLZSEuGFF5YkCaW8kRckhUS8kCzlBRLlBZItkmRP2bLv31/nnoxz/+fOnGeemXPU/OrTnTvN85+595x55nmeyWXJkiVLmmmBNvnN/ystsRRn8QG/a33ERaxAR9SXBuie36ybVmiU30ws8/EShYsv5Q30BzVEMLq+2biJsdphZRN25je9RxewC9ZF1+cI9OlMhdo/gfZfgBmd6AV00Brt8JztCF5gHPoK9oGZIQgevBn6HvrINARrx/EF46Honz8ov/k3C1DcaC+aIE4a4w6Ka7t4hFmYjh14hgn4J6tgNb6CXnCNTmTVdfG56PfVqJMlCB4U9A4LUdyDRIk6D6tmXNtgZjKsBkGXMRzl5DysWq5+YR1KpgN+wGocpEInMA5Rcg9WHVfqhkNzElbjUq5D39PeKJVrsNq6UucRmhGI8qlYbmEPFkFdeRfonjoO63hXke9TPT+sAi6+4WvRvjj0IAxN+9qfTXEKVqFKe47QrMcNLIMGY0dhFaskjYxDo++21bia7ENo+sFqXE2WI1JuwypQLYYiUubBKlANNEyK9AxR1Eefg1Wo0g6irHTDA1jFKmkGyk4PXIVVsBJeQc83pzSDni1aBLCKp2kjnKIpbl+0Q09sRXDZJk2foHGbcy7BKpw2/RNjxeeCgavXKIwBY+UYrBOkpQZeovVYTZ6skyRNkzyvaYvTsE6WlMfoBO9RL6aP+T6sE/ukidgwJBoNYUZhLQ7A5+xPvsPpCe4aLVP6XlTQWsFMpJLO2ALNxa2LcfUeU5BodH8MhlZItIBsXUgcDzEAsaMuVsMQDUe6YiAmYTEOIcpLGVe70Rpeoht4DrTSbZ0sCXrbNBGJRKPdlXgK6+Q+3MVcRF5kixO9PNGC9mH4uCd0I+/HGPh6cVR2dP/oftmAM3gL62ILfkKzSw0vNIcYjcjz7LSj0Wh/aJ1Yr8BGQh2EOozmyJIlS9Ull/sDJKNw3QwWZlkAAAAASUVORK5CYII="></a>
                <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $url_encode; ?>" target="_blank"><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADIAAAAyCAYAAAAeP4ixAAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAAJcEhZcwAADsMAAA7DAcdvqGQAAAHNSURBVGhD7do9SgRBEAXgQdTUTPQKYuQVvIGgiZEIgoGJ+HcAE28gayYYmqupqaH4kygeQBM10UBfDSsUyxtqprtapqEffMnb7ekp3B0FuxpmEg7gAb7hp+fkHuVe92EC6sgQV8AW5OASZIb6J8HekJNdqB5Vkas7yOI7YfkC+kKOaJkjWuaIlqm9wCnswDosNzgBtp6hZSrPsARj0CabwK7D0DKFW5iGLundIPJ4nIeu6d0g5xCS3g2yCiHp3SBz0CYzsAIbQ2fArsfQ0tsUWFmDT2Dr26ClN+txuwCxf/PR0puVI2DruqClNytdvgtNaOnNShlEoaU3K70aRJ46bw2sDICt+/MBbE+NliGuIVW2gO2p0TJEykGOge2p0TJEykHk2mxPjZYhUg7yCmxPjZYhUg0yC2y/UbQMkWqQRWD7jaJliHe4aWDlENg68QRsv1G09Gal/GZXaOnNShlEoaU3K2UQhZberJRBFFp6s1IGUWjpzUoZRKGlNytlEIWW3qy4DPIfBwasxA5SHxiQUzbsRU9WYgepj3DsqSIVK7GDyL+56yNCclSIvcGLlZhBLmAc6sjhLZnqHuTzxhbEsNJ1ELlH+ThtA4aoql+OEdc7LvThiAAAAABJRU5ErkJggg=="></a>
            </div>
            <!-- <br>
            <h2>Bekijk ook:</h2>
             <ul>
                <li>
                    <h2>Palestina</h2>
                    <p class="bio">Het was 2010, vlak voordat ik
                    mijn eindexamen aan de
                    middelbare school deed. Met
                    een vriend van mij schreef ik
                    een profielwerkstuk over het
                    conflict in Israël-Palestina</p>
                </li>
                <li>
                    <h2>Voorbij Fort Europa</h2>
                    <p class="bio">De auteurs kijken eerst terug:
                    1 mei 1517, London, rellen
                    gericht tegen protestantse
                    vluchtelingen uit Frankrijk en
                    Vlaanderen. Ook in onze
                    contreien</p>
                </li>
                <li>
                    <h2>Liefde als basis</h2>
                    <p class="bio">De geweldloosheid van Martin
                    Luther King is gebaseerd op
                    liefde, zo begint Harcourt. Het
                    is niet gebaseerd op het gebod
                    “gij zult niet doden”
                    , maar
                    veeleer op Jezus' woorden</p>
                </li>
            </ul> -->
        </div>
    </div>
    <!-- END CONTENT -->
</div>

<?php get_footer(); ?>
