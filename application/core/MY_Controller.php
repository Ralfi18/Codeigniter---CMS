<?php defined('BASEPATH') || exit('No direct access!');

class MY_Controller extends CI_Controller {
	public $data = [];
	public function __construct()
	{
		parent::__construct();
		$this->data['errors'] = [];
		$this->data['site_name'] = config_item('site_name');
	}
}