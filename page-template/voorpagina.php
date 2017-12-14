<?php
/**
 * Template for displaying the frontpage with the current issue
 *
 * @package CWA
 * @subpackage Newsletter
 */

get_header(); ?>

<div class="container">
		<?php
			$params = array(
				'limit' => 1,
				'orderby' => 'datum DESC'
			);
			$nieuwsbrief_artikel = pods('nieuwsbrief', $params);
			if($nieuwsbrief_artikel->total() > 0){
				while($nieuwsbrief_artikel->fetch()){
					$nieuwsbrief_artikel_jaargang_nummer = $nieuwsbrief_artikel->display('jaargang_nummer.name');
					$params = array(
						'limit' => 10,
						'orderby' => 'datum DESC',
					);
					$artikel = pods('artikel', $params);
					$i = 1;

					if($artikel->total() > 0){
						while($artikel->fetch()){
							$jaargang_nummer = $artikel->field('jaargang_nummer.name');
							if($jaargang_nummer == $nieuwsbrief_artikel_jaargang_nummer){
								$title = $artikel->display('name');
								$intro = $artikel->display('intro.name');
								$content = $artikel->display('content');
								$auteur = $artikel->display('auteur.name');
								$grid_image = pods_image_url( $artikel->field('grid_img'), 'thumbnail', 0, true );
								if('' != $intro){
									$content = $intro;
								}else{
									$content = $content;
								}
								if('' != $grid_image){
									$img = '<img src="'.$grid_image.'" name="$title">';
								} else {
									$img = '';
								}
								$permalink = site_url('artikel/' . $artikel->field('permalink'));
								$id = $artikel->field('id');
								if(1 == $i){
									echo '
										<a href="'.$permalink.'">
											<div class="topartikel">
												'.$img.'
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
									}
									$i = $i + 1;
							}
						}
					}
				}
			}
		?>
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
				$naam = $nieuwsbrief->display('name');
				$pdf = pods_image_url( $nieuwsbrief->field('pdf_input'), 'thumbnail', 0, true );
				$thumbnail = pods_image_url( $nieuwsbrief->field( 'image'), 'thumbnail', 0, true );
				echo '
				<div class="jaargang">
					<a href="'.$pdf.'" target="_blank">
						<h3>Jaargang '.$jaargang_nummer[0].' nr. '.$jaargang_nummer[1].'</h3>
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
