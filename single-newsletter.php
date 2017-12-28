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
$pdf  = pods_image_url( $pods->field( 'pdf_input' ), 'thumbnail' );

header( 'Location: ' . $pdf );
