<?php defined('BASEPATH') || exit('No direct access');


/**
* 
*/
class User extends Admin_Controller
{
	
	function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$this->data['users'] = $this->user_m->get();
		// print_r($this->data['users']);die();
		$this->data['subview'] = 'admin/user/index';
		$this->load->view('admin/_layout_main', $this->data);
	}

	public function edit($id = null)
	{
		if ($id) {
			$this->data['user'] = $this->user_m->get($id);
			count($this->data['user']) || $this->data['errors'][''] = 'User not found';
		} else {
			$this->data['user'] = $this->user_m->get_new();
		}

		$rules = $this->user_m->rules_admin;
		$id || $rules['password']['rules'] .= '|required';
		$this->form_validation->set_rules($rules);

		if ($this->form_validation->run()) {
			$data = $this->user_m->array_from_post(['name', 'email', 'password']);
			$data['password'] = $this->user_m->hash($data['password']);
			$this->user_m->save($data, $id);
			redirect('admin/user');
		}

		$this->data['subview'] = 'admin/user/edit';
		$this->load->view('admin/_layout_main', $this->data);
	}

	public function delete($id)
	{

	}

	public function login()
	{
		$this->user_m->loggedin() == false || redirect('admin/dashboard');

		$rules = $this->user_m->rules;
		$this->form_validation->set_rules($rules);

		if ($this->form_validation->run()) {
			// We can login 
			if ($this->user_m->login()) {
				redirect('admin/dashboard');
			} else {
				$this->session->set_flashdata('error', 'The email/password is incorrect!');
				redirect('admin/user/login', 'refresh');
			}
		}
		
		$this->data['subview'] = 'admin/user/login';
		$this->load->view('admin/_layout_modal', $this->data);
	}

	public function logout()
	{
		$this->user_m->logout();
		redirect('admin/user/login');
	}

	public function _unique_email($str)
	{
		$id = $this->uri->segment(4);
		$this->db->where('email', $this->input->post('email'));
		
		$id = $id ? $id : null;
		$this->db->where('id !=', $id);

		$user = $this->user_m->get();

		if(count($user)){
			$this->form_validation->set_message('_unique_email','The %s sholud be unique!');
			return false;
		}
		return true;
	}
}