<?php
/**
 * Template for displaying the topical archive (dossiers)
 *
 * @package CWA
 * @subpackage Newsletter
 */

get_header(); ?>

<?php
if ( isset($_GET['f']) && !empty($_GET['f']) ){
	$filter = $_GET['f'];
} else{
	$filter = '';
}
?>

<div class="container">
	<h1 class="artikelen">Dossiers</h1>
	<div class="select_wrapper">
		<?php $args = array(
			'show_option_all'    => '',
			'show_option_none'   => '',
			'option_none_value'  => '-1',
			'orderby'            => 'ID',
			'order'              => 'ASC',
			'show_count'         => 0,
			'hide_empty'         => 1,
			'child_of'           => 0,
			'exclude'            => '',
			'include'            => '',
			'echo'               => 1,
			'selected'           => 0,
			'hierarchical'       => 0,
			'name'               => 'select',
			'id'                 => 'selecter',
			'class'              => 'postform',
			'depth'              => 0,
			'tab_index'          => 0,
			'taxonomy'           => 'category',
			'hide_if_empty'      => false,
			'value_field'	       => 'name',
			'hide_empty'         => 0
		); ?>
		<?php wp_dropdown_categories($args); ?>
	</div>
	<br>
	<div class="grid">
		<div class="grid-sizer"></div>
		<?php
			if( '' != $filter ){
				$params = array(
					'limit' => 1,
					'orderby' => 'datum DESC',
					'where' => "category.name = '$filter'"
				);
			} else {
				$params = array(
					'limit' => 15,
					'orderby' => 'datum DESC'
				);
			}
			$artikel = pods('artikel', $params);

			if($artikel->total() > 0){
				while($artikel->fetch()){
					$title = $artikel->display('name');
					$intro = $artikel->display('intro.name');
					$content = $artikel->display('content');
					$featured_img = pods_image_url(
						$artikel->field('featured_img.name'),
						'thumbnail',
						0,
						true
					);
					if('' != $intro){
						$content = $intro;
					}else{
						$content = $content;
					}
					if('' != $featured_img){
						$img = '<img src="'.$featured_img.'">';
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
	var f = '<?php echo $_GET['f']; ?>';

	if(f == ''){
		$("#selecter").val("Geen categorie");
	} else {
		$("#selecter").val(f);
	}

	$( document ).ready(function() {
		$('.grid').masonry({
			itemSelector: '.grid-item',
			columnWidth: '.grid-sizer'
		});

		$('#selecter').change(function(){
			console.log($(this).val());
			if($(this).val() == 'Geen categorie'){
				window.location.replace('/dossiers');
			} else {
				window.location.replace('/dossiers' + '?f=' + $(this).val());
			}
		});
	});
</script>
