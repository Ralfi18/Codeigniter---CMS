<div class="modal-headr">
	<h3><?php echo empty($user->id) ? 'Add a user' : 'Edit user ' . $user->name; ?></h3>
</div>
<div class="modal-body">
	<?php echo validation_errors(); ?>
	<?php echo form_open(); ?>
		<table>
			<tr>
				<td>Name: </td>
				<td><?php echo form_input('name'); ?></td>
			</tr>
			<tr>
				<td>Email</td>
				<td><?php echo form_input('email'); ?></td>
			</tr>
			<tr>
				<td>Passowrd</td>
				<td><?php echo form_input('password'); ?></td>
			</tr>
			<tr>
				<td>Confirm Passowrd</td>
				<td><?php echo form_input('password_confirm'); ?></td>
			</tr>
			<tr>
				<td></td>
				<td><?php echo form_submit('submit', 'Log In', 'class="btn btn-primary"'); ?></td>
			</tr>
		</table>
	<?php echo form_close(); ?>
</div>