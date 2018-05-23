<?php
/**
 * The template part for displaying a basic mail template of single newsletter issues
 *
 * @package CWA
 * @subpackage Newsletter
 * @since CWA Newsletter 0.3
 */

$pods     = pods( 'newsletter', get_the_ID() );
$issue_nr = $pods->field( 'issue_nr' );
$pdf_link = $pods->field( 'pdf_file' )['guid'];

// Allow viewing of pending articles in pending newsletters.
$statuses = array();
switch( get_post_status() ) {
	case 'draft':   $statuses[] = 'draft';
	case 'pending': $statuses[] = 'pending';
	case 'future':  $statuses[] = 'future';
	default:        $statuses[] = 'publish';
}

// Based on: https://github.com/leemunroe/responsive-html-email-template
?>
<!DOCTYPE html>
<html>
	<head>
		<meta name="viewport" content="width=device-width">
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<title><?php the_title(); ?></title>
		<style>
		/* RESPONSIVE AND MOBILE FRIENDLY STYLES */
		@media only screen and (max-width: 620px) {
			table[class=body] h1 {
				font-size: 28px !important;
				margin-bottom: 10px !important;
			}
			table[class=body] p,
						table[class=body] ul,
						table[class=body] ol,
						table[class=body] td,
						table[class=body] span,
						table[class=body] a {
				font-size: 16px !important;
			}
			table[class=body] .wrapper,
						table[class=body] .article {
				padding: 10px !important;
			}
			table[class=body] .content {
				padding: 0 !important;
			}
			table[class=body] .container {
				padding: 0 !important;
				width: 100% !important;
			}
			table[class=body] .main {
				border-left-width: 0 !important;
				border-radius: 0 !important;
				border-right-width: 0 !important;
			}
			table[class=body] .btn table {
				width: 100% !important;
			}
			table[class=body] .btn a {
				width: 100% !important;
			}
			table[class=body] .img-responsive {
				height: auto !important;
				max-width: 100% !important;
				width: auto !important;
			}
		}

		/* PRESERVE THESE STYLES IN THE HEAD */
		@media all {
			.ExternalClass {
				width: 100%;
			}
			.ExternalClass,
						.ExternalClass p,
						.ExternalClass span,
						.ExternalClass font,
						.ExternalClass td,
						.ExternalClass div {
				line-height: 100%;
			}
			.apple-link a {
				color: inherit !important;
				font-family: inherit !important;
				font-size: inherit !important;
				font-weight: inherit !important;
				line-height: inherit !important;
				text-decoration: none !important;
			}
			.btn-primary table td:hover {
				background-color: #34495e !important;
			}
			.btn-primary a:hover {
				background-color: #34495e !important;
				border-color: #34495e !important;
			}
		}
	</style>
	</head>
	<body class="" style="background-color: #f6f6f6; font-family: serif; -webkit-font-smoothing: antialiased; font-size: 14px; line-height: 1.4; margin: 0; padding: 0; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;">
		<table border="0" cellpadding="0" cellspacing="0" class="body" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%; background-color: #f6f6f6;">
			<tr>
				<td style="font-family: serif; font-size: 14px; vertical-align: top;">&nbsp;</td>
				<td class="container" style="font-family: serif; font-size: 14px; vertical-align: top; display: block; margin: 0 auto; max-width: 580px; padding: 10px; width: 580px;">
					<div class="content" style="box-sizing: border-box; display: block; margin: 0 auto; max-width: 580px; padding: 10px;">
						<?php /*
						<span class="preheader" style="color: transparent; display: none; height: 0; max-height: 0; max-width: 0; opacity: 0; overflow: hidden; mso-hide: all; visibility: hidden; width: 0;">
							This is preheader text. Some clients will show this text as a preview.
						</span>
						*/ ?>
						<table class="main" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%; background: #ffffff; border-radius: 3px;">
							<tr>
								<td class="wrapper" style="font-family: serif; font-size: 14px; vertical-align: top; box-sizing: border-box; padding: 20px;">
									<table border="0" cellpadding="0" cellspacing="0" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%;">
										<tr>
											<td style="font-family: serif; font-size: 14px; vertical-align: top;">
												<hr>
												<center>
													<h1 style="font-family: serif; font-size: 26px; font-weight: bold; margin: 12px 0 0 0;"><?php echo esc_html( cwa_newsletter_format_issue_nr( $issue_nr ) ); ?></h1>
													<h2 style="font-family: serif; font-size: 20px; font-weight: normal; font-style: italic; margin: 0 0 12px 0;"><?php the_title(); ?></h2>
													<?php
													if ( has_post_thumbnail() ) :
														// Put image in data-uri to avoid having to load an external image in the mail.
														// https://davidwalsh.name/data-uri-php
														$imgmeta = wp_get_attachment_metadata( get_post_thumbnail_id() );
														$imgsize = $imgmeta['sizes']['medium'];
														$imgpath = wp_upload_dir()['basedir'] . '/' . dirname( $imgmeta['file'] ) . '/' . $imgsize['file'];
														$imgdata = base64_encode( file_get_contents( $imgpath ) );
														$imgsrc  = 'data:' . $imgsize['mime-type'] . ';base64,' . $imgdata;
														$imgw    = 200;
														$imgh    = $imgw * $imgsize['height'] / $imgsize['width'];
														echo '<img src="' . $imgsrc . '" width="' . $imgw . '" height="' . $imgh . '" alt="" style="border: 0; margin: 0;">';
													endif;
													?>
												</center>
												<?php
												// Start the article loop.
												$query = new WP_Query( array(
													'post_type'      => 'newsletter_article',
													'meta_query'     => array(
														'key'   => 'issue_nr',
														'value' => $pods->field( 'issue_nr' ),
													),
													'meta_key'       => 'page_nr',
													'orderby'        => 'meta_value_num',
													'order'          => 'ASC',
													'post_status'    => $statuses,
													'posts_per_page' => -1,
												));
												while ( $query->have_posts() ) : $query->the_post();
												?>
													<hr>
													<h3 style="font-family: serif; font-size: 18px; font-weight: bold; margin: 12px 0 8px 0;">
														<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
													</h3>
													<p style="font-family: serif; font-size: 14px; font-weight: normal; margin: 0 0 12px 0;"><i>
														<?php echo get_the_excerpt(); ?>
														<a href="<?php the_permalink(); ?>"><?php esc_html_e( 'Lees verder...', 'cwa_newsletter' ); ?></a>
													</i></p>
												<?php
												endwhile;
												wp_reset_postdata();

												cwa_newsletter_mailfooter_menu( array(
													'items_wrap'     => '<hr><center><p style="font-family: serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px;">%3$s</p></center>',
												) );
												?>
												<center>
													<p style="font-family: serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px;">
														<a href="<?php echo esc_attr( trailingslashit( get_site_url() ) ); ?>"><?php echo esc_html( trailingslashit( get_site_url() ) ); ?></a>
													</p>
												</center>
											</td>
										</tr>
									</table>
								</td>
							</tr>
						</table>

						<?php
						// TODO get address and unsubscribe URL from theme/site settings
						/*
						<div class="footer" style="clear: both; margin-top: 10px; text-align: center; width: 100%;">
							<table border="0" cellpadding="0" cellspacing="0" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%;">
								<tr>
									<td class="content-block" style="font-family: serif; vertical-align: top; padding-bottom: 10px; padding-top: 10px; font-size: 12px; color: #999999; text-align: center;">
										<span class="apple-link" style="color: #999999; font-size: 12px; text-align: center;">
											Company Inc, 3 Abbey Road, San Francisco CA 94102
										</span>
										<br> Don't like these emails? <a href="http://i.imgur.com/CScmqnj.gif" style="text-decoration: underline; color: #999999; font-size: 12px; text-align: center;">Unsubscribe</a>.
									</td>
								</tr>
							</table>
						</div>
						*/ ?>
					</div>
				</td>
				<td style="font-family: serif; font-size: 14px; vertical-align: top;">&nbsp;</td>
			</tr>
		</table>
	</body>
</html>
