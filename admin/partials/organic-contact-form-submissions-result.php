<tr>

	<td><?php echo date('d/m/Y H:i:s', strtotime( $submission['submission']->created ) ); ?></td>

	<td><a href="<?php echo $submission['submission']->url; ?>"><?php echo $submission['submission']->url; ?></a></td>

	<td><?php echo $submission['submission_fields'][0]->value; ?></td>

	<td><?php echo $submission['submission_fields'][1]->value; ?></td>

</tr>