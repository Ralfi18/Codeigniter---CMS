<?php 

/**
* 
*/
class User_M extends MY_Model
{

	protected $_table_name = 'users';
	protected $_order_by = 'name';
	public $rules = [
		'email' => ['field'=>'email','label'=>'Email', 'rules'=>'trim|required|valid_email|xss_clean'],
		'password' => ['field'=>'password','label'=>'Password', 'rules'=>'trim|required']
	];
	
	public $rules_admin = [
		'name' => [
			'field'=>'name',
			'label'=>'Name', 
			'rules'=>'trim|required|xss_clean'
		],
		'email' => [
			'field'=>'email',
			'label'=>'Email', 
			'rules'=>'trim|required|valid_email|callback__unique_email'
		],
		'password' => [
			'field'=>'password',
			'label'=>'Password',
			'rules'=>'trim|matches[password_confirm]'
		],
		'password_confirm' => [
			'field'=>'password',
			'label'=>'Password',
			'rules'=>'trim|matches[password]'
		]
	];

	function __construct()
	{
		parent::__construct();
	}

	public function login()
	{
		$user = $this->get_by([
			'email' => $this->input->post('email'),
			'password' => $this->hash( $this->input->post('password'))
		], true);

		if (count($user)) {
			$data = [
				'name'=>$user->name,
				'email'=>$user->email,
				'id'=>$user->id,
				'loggedin'=>true
			];
			$this->session->set_userdata($data);
		}
	}

	public function logout()
	{
		$this->session->sess_destroy();
	}

	public function loggedin()
	{
		return (bool) $this->session->userdata('loggedin');
	}

	public function get_new()
	{
		$user = new stdClass();
		$user->name = '';
		$user->email = '';
		$user->password = '';
		return $user;
	}

	public function hash($string)
	{
		return hash('sha512', $string . config_item('encryption_key'));
	}
}