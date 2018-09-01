<?php

/**
 * The admin options view
 *
 * This file is used to markup the HTML for the options
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

	</header>

    <form action="options.php" method="post">
        <?php

        	// Get the settings fields
            settings_fields( $this->plugin_name );

            // Show the sections
            do_settings_sections( $this->plugin_name );

            // Show the submit button
            submit_button();

        ?>

    </form>

</div>