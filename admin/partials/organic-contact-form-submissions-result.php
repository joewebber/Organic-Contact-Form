<?php

/**
 * The submission result view
 *
 * This file is used to markup the HTML for a single submission row in a table
 *
 * @link       http://joewebber.co.uk
 * @since      1.0.0
 *
 * @package    Organic_Contact_Form
 * @subpackage Organic_Contact_Form/admin/partials
 */
?>
<tr>

	<td><?php echo date('d/m/Y H:i:s', strtotime( $submission['submission']->created ) ); ?></td>

	<td><a href="<?php echo $submission['submission']->url; ?>"><?php echo $submission['submission']->url; ?></a></td>

	<td><?php echo $submission['submission_fields'][0]->value; ?></td>

	<td><?php echo $submission['submission_fields'][1]->value; ?></td>

	<td><a href="admin.php?page=organic-contact-form-submissions&submission_id=<?php echo $submission['submission']->submission_id; ?>">View</a></td>

</tr>