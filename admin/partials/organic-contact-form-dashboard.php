<?php

/**
 * The dashboard view
 *
 * This file is used to markup the HTML for the dashboard
 *
 * @link       http://joewebber.co.uk
 * @since      1.0.0
 *
 * @package    Organic_Contact_Form
 * @subpackage Organic_Contact_Form/admin/partials
 */
?>
<div class="wrap organic-contact-form">

	<header>

		<h1><?php echo esc_html( get_admin_page_title() ); ?></h1>

		<p>The dashboard shows the latest five submissions, along with some statistics</p>

		<p>To include the contact form on a page, use the shortcode: [organic-contact-form]</p>

	</header>

	<div class="metabox-holder">

		<div class="postbox-container full-width">

			<div class="postbox">

				<h2 class="hndle"><span>Recent Submissions</span></h2>

				<div class="inside">

					<div class="main">

						<?php

							// If we have recent submissions
							if ( !empty( $recent_submissions ) ) {

								// Include the table view
								include_once( plugin_dir_path( __FILE__ ) . '/organic-contact-form-submissions-table.php' );						

							}

						?>

					</div>

				</div>

			</div>

		</div>

	</div>

	<div class="metabox-holder">

		<div class="postbox-container half-width">

			<div class="postbox">

				<h2 class="hndle"><span>Top Pages</span></h2>

				<div class="inside">

					<div class="main">

						<?php

							// If we have pages
							if ( !empty( $top_pages ) ) {

								// Include the view
								include_once( plugin_dir_path( __FILE__ ) . '/organic-contact-form-top-pages.php' );						

							}

						?>

					</div>

				</div>

			</div>

		</div>

		<div class="postbox-container half-width">

			<div class="postbox">

				<h2 class="hndle"><span>Top Days</span></h2>

				<div class="inside">

					<div class="main">

						<?php

							// If we have days
							if ( !empty( $top_days ) ) {

								// Include the view
								include_once( plugin_dir_path( __FILE__ ) . '/organic-contact-form-top-days.php' );						

							}

						?>

					</div>

				</div>

			</div>

		</div>

	</div>

</div>