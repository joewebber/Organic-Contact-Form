<?php

/**
 * The submission view
 *
 * This file is used to markup the HTML for viewing an individual submission
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

		<h1><?php echo esc_html( get_admin_page_title() ); ?> - View (<?php echo $submission['submission']->submission_id; ?>)</h1>

	</header>

	<div id="poststuff">

		<div class="metabox-holder">

			<div class="edit-form-section">

				<div class="stuffbox">

					<div class="inside">

						<fieldset>

							<table class="form-table">

								<tbody>

									<tr>

										<td class="first">

											<strong>Created:</strong>

										</td>

										<td>

											<?php echo date('d/m/Y H:i:s', strtotime( $submission['submission']->created ) ); ?>

										</td>

									</tr>

									<tr>

										<td class="first">

											<strong>Page:</strong>

										</td>

										<td>

											<a href="<?php echo site_url() . '?page_id=' . $submission['submission']->page_id; ?>"><?php echo get_the_title( $submission['submission']->page_id ); ?></a>

										</td>

									</tr>

								</tbody>

							</table>

						</fieldset>

						</div>

					</div>

				</div>

				<div class="stuffbox">

					<div class="inside">

						<fieldset>

							<table class="form-table">

							<tbody>

								<?php

									// Loop through all submission fields
									foreach ( $submission['submission_fields'] as $submission_field ) {

								?>

								<tr>

									<td class="first">

										<strong><?php echo $submission_field->label; ?>:</strong>

									</td>

									<td>

										<?php echo $submission_field->value; ?>

									</td>

								</tr>

								<?php
										
									}

								?>

							</tbody>

							</table>
						
						</fieldset>

					</div>

				</div>

			</div>

		</div>

	</div>

</div>