<?php 

function btn_edit($uri) {
	return anchor($uri, '<i class="icon-edit"></i> ');
}

function btn_delete($uri) {
	return anchor($uri, '<i class="icon-remove"></i> ', ['onclick'=>"return confirm('You are about to delte this record. Are you sure?');"]);
}