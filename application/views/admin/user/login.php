<div class="modal-headr">
	<h3>Log In</h3>
	<p>Please log in</p>
</div>
<div class="modal-body">
	<?php echo validation_errors(); ?>
	<?php echo form_open(); ?>
		<table>
			<tr>
				<td>Email</td>
				<td><?php echo form_input('email'); ?></td>
			</tr>
			<tr>
				<td>Password</td>
				<td><?php echo form_password('password'); ?></td>
			</tr>
			<tr>
				<td></td>
				<td><?php echo form_submit('submit', 'Log In', 'class="btn btn-primary"'); ?></td>
			</tr>
		</table>
	<?php echo form_close(); ?>
</div>