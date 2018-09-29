<?php $this->load->view('admin/components/page_head'); ?>
<body>
	<div class="navbar navbar-static navbar-inverse">
	  <div class="navbar-inner">
	    <a class="brand" href="<?php echo site_url('admin/dashboard'); ?>">
	    	<?php echo $meta_title; ?>
	    </a>
	    <ul class="nav">
	      <li class="active">
	      	<a href="<?php echo site_url('admin/dashboard'); ?>">Home</a>
	      </li>
	      <li><?php echo anchor('admin/pages', 'pages'); ?></li>
	      <li><?php echo anchor('admin/user', 'user'); ?></li>
	    </ul>
	  </div>
	</div>
  <!--  -->
	<div class="container">
		<div class="row">
			<!-- main column -->
			<div class="span9">
				<section>
<!-- 					<h2>Page name</h2> -->
					<?php $this->load->view($subview); ?>
				</section>
			</div>
			<!-- sidebar -->
			<div class="span3">
				<section>
					<?php echo mailto('r.dimitrov@steral.eu', '<i class="icon-user"></i> r.dimitrov@steral.eu'); ?>
					<br>
					<?php echo anchor('admin/user/logout', '<i class="icon-off"></i> logout'); ?>
				</section>
			</div>
		</div>
	</div>
<?php $this->load->view('admin/components/page_tail'); ?>