<?php
/**
 * CWA Newsletter backend admin tweaks: use newsletter issue publication data for articles.
 *
 * @package CWA
 * @subpackage Newsletter
 * @since CWA Newsletter 0.8
 */

/**
 * Sets newsletter article published date from issue on article save.
 *
 * @since CWA Newsletter 0.8
 */
function cwa_newsletter_admin_pubdate_save_article( $post_ID, $post ) {
	$pods            = pods( 'newsletter_article', $post_ID );
	$issue_nr        = $pods->field( 'issue_nr' );
	$newsletter_pods = cwa_newsletter_pod_by_nr( 'newsletter', $issue_nr );

	if ( $newsletter_pods->total() > 0 ) {
		$post_date     = $newsletter_pods->raw( 'post_date' );
		$post_date_gmt = $newsletter_pods->raw( 'post_date_gmt' );

		// Update post_date if it is different from the issue's post_date.
		if ( $post->post_date !== $post_date || $post->post_date_gmt !== $post_date_gmt ) {
			// Temporarily disable this action to avoid infinite loop.
			remove_action( 'save_post_newsletter_article', 'cwa_newsletter_admin_pubdate_save_article', 10 );
			wp_update_post( array(
				'ID'            => $post_ID,
				'edit_date'     => true,
				'post_date'     => $post_date,
				'post_date_gmt' => $post_date_gmt
			) ); // @todo check result
			add_action( 'save_post_newsletter_article', 'cwa_newsletter_admin_pubdate_save_article', 10, 2 );
		}
	}
}
add_action( 'save_post_newsletter_article', 'cwa_newsletter_admin_pubdate_save_article', 10, 2 );

/**
 * Sets newsletter article published date from issue on article creation.
 *
 * When an article is created, the previous action is called _before_ the pod is
 * saved, hence `issue_nr` isn't known yet. This runs it another time when the pod
 * has been saved.
 *
 * @since CWA Newsletter 0.8
 */
function cwa_newsletter_admin_pubdate_pod_save_article( $pieces, $is_new, $post_ID ) {
	cwa_newsletter_admin_pubdate_save_article( $post_ID, get_post( $post_ID ) );
}
add_action( 'pods_api_post_save_pod_item_newsletter_article', 'cwa_newsletter_admin_pubdate_pod_save_article', 10, 3 );

/**
 * Disables newsletter article published date edit when it is taken from the issue.
 *
 * @since CWA Newsletter 0.8
 */
function cwa_newsletter_admin_pubdate_edit_form_top( $post ) {
	if ( 'newsletter_article' !== get_post_type( $post ) ) return;

	$pods            = pods( 'newsletter_article', $post->ID );
	$issue_nr        = $pods->field( 'issue_nr' );
	$newsletter_pods = cwa_newsletter_pod_by_nr( 'newsletter', $issue_nr );

	if ( $newsletter_pods->total() > 0 ) {
		?>
		<style type="text/css">
		  /* Hide published on edit button, because it is taken from the issue. */
			.submitbox .edit-timestamp { display: none; }
			.submitbox #timestamp:after {
				content: " (<?php echo esc_attr__( 'same as issue', 'cwa_newsletter' ); ?>)";
				font-style: italic;
				color: #82878c; /* same as icon */
			}
		</style>
		<?php
	}
}
add_action( 'edit_form_top', 'cwa_newsletter_admin_pubdate_edit_form_top', 10, 1 );

 /**
  * Sets newsletter article published date from issue on issue save.
	*
	* @since CWA Newsletter 0.8
	*/
function cwa_newsletter_admin_pubdate_save_issue( $post_ID, $post ) {
	global $wpdb;

	$pods          = pods( 'newsletter', $post_ID );
	$issue_nr      = $pods->field( 'issue_nr' );
	$post_date     = $post->post_date;
	$post_date_gmt = $post->post_date_gmt;

	// Need to use SQL to combine UPDATE with a JOIN.
	$n = $wpdb->query(
		$wpdb->prepare(
			"UPDATE `$wpdb->posts` AS `t` " .
				"LEFT JOIN `$wpdb->postmeta` AS `issue_nr` " .
				" ON `issue_nr`.`meta_key` = 'issue_nr' " .
				"  AND `issue_nr`.`post_id` = `t`.`ID` " .
				"SET `t`.`post_date` = %s, `t`.`post_date_gmt` = %s " .
				"WHERE `t`.`post_type` = %s AND `issue_nr`.`meta_value` = %s",
			$post_date, $post_date_gmt, 'newsletter_article', $issue_nr
		)
	);
}
add_action( 'save_post_newsletter', 'cwa_newsletter_admin_pubdate_save_issue', 10, 2 );
