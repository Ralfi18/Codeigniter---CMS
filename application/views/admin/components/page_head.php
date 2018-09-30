<!DOCTYPE html>
<html>
  <head>
    <title><?php echo $meta_title; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href="<?php echo site_url('css/bootstrap.min.css'); ?>" rel="stylesheet" media="screen">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.0/jquery-ui.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
    <?php if (isset($soratble) && $soratble ) : ?>
			<script src="https://code.jquery.com/ui/1.8.16/jquery-ui.min.js"></script>
			  <script src="https://cdn.rawgit.com/mjsarfatti/nestedSortable/master/jquery.mjs.nestedSortable.js"></script>  
    <?php endif; ?>
    <script src='https://cloud.tinymce.com/stable/tinymce.min.js'></script>
	  <script>
		  tinymce.init({
		    selector: '#edit-form-body'
		  });
			// tinymce.init({
			//   selector: 'textarea',
			//   height: 250,
			//   theme: 'modern',
			//   plugins: 'print preview fullpage powerpaste searchreplace autolink directionality advcode visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists textcolor wordcount tinymcespellchecker a11ychecker imagetools mediaembed  linkchecker contextmenu colorpicker textpattern help',
			//   toolbar1: 'formatselect | bold italic strikethrough forecolor backcolor | link | alignleft aligncenter alignright alignjustify  | numlist bullist outdent indent  | removeformat',
			//   image_advtab: true,
			//   // templates: [
			//   //   { title: 'Test template 1', content: 'Test 1' },
			//   //   { title: 'Test template 2', content: 'Test 2' }
			//   // ],
			//   content_css: [
			//     '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
			//     '//www.tinymce.com/css/codepen.min.css'
			//   ]
			//  });
	  </script>
  </head>
    
