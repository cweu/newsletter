<?php
/**
 * Template Name: Pod Nieuwsbrief PDF
 *
 * The newsletter template redirecting to the PDF.
 *
 * @package CWA
 * @subpackage Newsletter
 * @since CWA Newsletter 0.1
 */

$slug = pods_v( 'last', 'url' );
$pods = pods( 'newsletter', $slug );
$pdf  = $pods->field( 'pdf_file' );

if ( $pdf && $pdf['guid'] ) {
	header( 'Location: ' . $pdf['guid'] );
} else {
	status_header( 404 );
	include get_query_template( '404' );
}
