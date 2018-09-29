<?php defined('BASEPATH') || exit('No direct access!');
/**
* 
*/
class Admin_Controller extends MY_Controller
{
	public $data = [];

	function __construct()
	{
		parent::__construct();
		$this->data['meta_title'] = 'My CMS';
		$this->load->library('form_validation');
		$this->load->model('user_m');

		$exception_uris = [
			'admin/user/login',
			'admin/user/logout'
		];
		if (!in_array(uri_string(), $exception_uris)) {
			if (!$this->user_m->loggedin()) {
				redirect('admin/user/login');
			}
		}
	}
}