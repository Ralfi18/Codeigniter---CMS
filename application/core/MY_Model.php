<?php 

/**
* 
*/
class MY_Model extends CI_Model
{

	protected $_table_name = '';
	protected $_primary_key = 'id';
	protected $_primary_filter = 'intval';
	protected $_order_by = '';
	public $rules = [];
	protected $_timestamp = false;

	function __construct()
	{
		parent::__construct();
	}

	public function array_from_post($fields)
	{
		$data = [];
		foreach ($fields as $field) {
			$data[$field] = $this->input->post($field);
		}
		return $data;
	}

	public function get($id = null, $single = false)
	{
		if ($id) {
			$filter = $this->_primary_filter;
			$id = $filter($id);
			$this->db->where($this->_primary_key, $id);
			$method = 'row';
		} else if ($single) {
			$method = 'row';
		} else {
			$method = 'result';
		}
		if (!count($this->db->order_by($this->_order_by))) {
			$this->db->order_by($this->_order_by);
		}
		
		return $this->db->get($this->_table_name)->$method();
	}

	public function get_by($where, $single = false)
	{
		$this->db->where($where);
		return $this->get(null, $single);
	}

	public function save($data, $id = null)
	{
		if ($this->_timestamp) {
			$now = date('Y-m-d H:i:s');
			$id || $data ['created'] = $now;
			$data['modified'] = $now;
		}

		if ($id === null) {
			// !isset($data[$this->_primary_key]) ? $data[$this->_primary_key] : null;
			$this->db->set($data);
			$this->db->insert($this->_table_name);
			$id = $this->db->insert_id();
		} else {
			$filter = $this->_primary_filter;
			$id = $filter($id);

			$this->db->set($data);
			$this->db->where($this->_primary_key, $id);
			$this->db->update($this->_table_name);
		}
		return $id;
	}

	public function delete($id)
	{
		$filter = $this->_primary_filter;
		$id = $filter($id);

		if (!$id) {
			return false;
		}	

		$this->db->where($this->_primary_key, $id);
		$this->db->limit(1);
		$this->db->delete($this->_table_name);
	}
}