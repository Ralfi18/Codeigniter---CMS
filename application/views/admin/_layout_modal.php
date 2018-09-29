<?php $this->load->view('admin/components/page_head'); ?>
<body style="background: #555;">
	<div class="modal show" role="dialog">
		<div class="modal-header">
			<h3>Page title</h3>
		</div>
		<div class="modal-body">
			<?php $this->load->view($subview); ?>
		</div>
		<div class="modal-footer">
			&copy; <?php echo $meta_title; ?>
		</div>
	</div>
<?php $this->load->view('admin/components/page_tail'); ?>