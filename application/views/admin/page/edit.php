
<h3><?php echo empty($page->id) ? 'Add a page' : 'Edit page ' . $page->title; ?></h3>
<div class="">
	<?php echo validation_errors(); ?>
	<?php echo form_open(); ?>
		<table width="100%">
			<tr>
				<td>Parent: </td>
				<td><?php echo form_dropdown(
					'parent_id', $pages_no_parents,
					$this->input->post('parent_id') ? 
					$this->input->post('parent_id') : $page->parent_id); ?></td>
			</tr>
			<tr>
				<td>Name: </td>
				<td><?php echo form_input('title', set_value('title', $page->title)); ?></td>
			</tr>
			<tr>
				<td>Slug</td>
				<td><?php echo form_input('slug', set_value('slug',$page->slug)); ?></td>
			</tr>
<!-- 			<tr>
				<td>Order</td>
				<td><?php // echo form_input('order', set_value('order',$page->order)); ?></td>
			</tr> -->
			<tr>
				<td></td>
				<?php $attr = ['name'=>'body','id'=>'edit-form-body'] ?>
				<td><?php echo form_textarea($attr, set_value('body',$page->body)); ?></td>
			</tr>
			<tr>
				<td></td>
				<td><?php echo form_submit('submit', 'Edit', 'class="btn btn-primary"'); ?></td>
			</tr>
		</table>
	<?php echo form_close(); ?>
</div>