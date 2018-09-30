<?php defined('BASEPATH') || exit('No direct access');

class Page extends Admin_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('page_m');
	}

	public function index()
	{
		$this->data['pages'] = $this->page_m->get_with_parent();
		// print_r($this->data['pages']);die();
		$this->data['subview'] = 'admin/page/index';
		$this->load->view('admin/_layout_main', $this->data);
	}

	public function order()
	{
		$this->data['soratble'] = true;
		$this->data['subview'] = 'admin/page/order';
		$this->load->view('admin/_layout_main', $this->data);
	}

	public function order_ajax()
	{
		// Fetch all pages
		$this->data['pages'] = $this->page_m->get_nested();
		// load a view
		$this->load->view('admin/page/order_ajax', $this->data);
	}

	public function edit($id = null)
	{
		// fetch a page or set a new one
		if ($id) {
			$this->data['page'] = $this->page_m->get($id);
			count($this->data['page']) || $this->data['errors'][''] = 'page not found';
		} else {
			$this->data['page'] = $this->page_m->get_new();
		}

		// pages for dropdown
		$this->data['pages_no_parents'] = $this->page_m->get_no_parents();

		$rules = $this->page_m->rules;
		$this->form_validation->set_rules($rules);

		if ($this->form_validation->run()) {
			$data = $this->page_m->array_from_post(['title', 'slug', 'body', 'parent_id']);
			$this->page_m->save($data, $id);
			redirect('admin/page');
		}

		$this->data['subview'] = 'admin/page/edit';
		$this->load->view('admin/_layout_main', $this->data);
	}

	public function delete($id)
	{
		$this->page_m->delete($id);
		redirect('admin/page');
	}

	public function _unique_slug($str)
	{
		$id = $this->uri->segment(4);
		$this->db->where('slug', $this->input->post('slug'));
		$id = $id ? $id : null;
		$this->db->where('id !=', $id);
		$page = $this->page_m->get();

		if(count($page)){
			$this->form_validation->set_message('_unique_slug','The %s sholud be unique!');
			return false;
		}
		return true;
	}
}