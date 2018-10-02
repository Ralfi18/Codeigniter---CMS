<?php 

/**
* 
*/
class Page_m extends MY_Model
{

	protected $_table_name = 'pages';
	protected $_order_by = 'order';
	public $rules = [
		'parent_id' => [
			'field'=>'parent_id',
			'label'=>'Parent',
			'rules'=>'trim|intval'
		],
		'title' => [
			'field'=>'title',
			'label'=>'Title',
			'rules'=>'trim|required|max_length[100]|xss_clean'
		],
		'slug' => [
			'field'=>'slug',
			'label'=>'slug',
			'rules'=>'trim|required|max_length[100]|url_title|callback__unique_slug|xss_clean'
		],
		// 'order' => [
		// 	'field'=>'order',
		// 	'label'=>'Order',
		// 	'rules'=>'trim|is_natural|xss_clean'
		// ],
		'body' => [
			'field'=>'body',
			'label'=>'Body',
			'rules'=>'trim|required'
		]
	];

	public function __construct() {}

	public function get_new()
	{
		$page = new stdClass();
		$page->title = '';
		$page->slug = '';
		// $page->order = '';
		$page->body = '';
		$page->parent_id = 0;
		return $page;
	}

	public function delete($id)
	{
		// delete page
		parent::delete($id);
		// reset parent ID for children
		$this->db
	    ->set(['parent_id'=>0])
	    ->where('parent_id', $id)
	    ->update($this->_table_name);
	}

	public function save_order($pages)
	{

		if(count($pages)) {

			foreach($pages as $order => $page) {
				// dump($page);die();
				if ($page['item_id'] !== '') {
					$data = [
						'parent_id' => (int) $page['parent_id'],
						'order' => $order
					];
					$this->db
					  ->set($data)
					  ->where($this->_primary_key, $page['item_id'])
					  ->update($this->_table_name);
				}
			}
		}
	}

	public function get_nested()
	{
		$pages = $this->db->get('pages')->result_array();

		$array = [];
		if (count($pages)) {
			foreach($pages AS $page) {
				if (!$page['parent_id']) {
					$array[$page['id']] = $page;
				} else {
					$array[$page['parent_id']]['children'][] = $page;
				}
			}
		}
		return $array;
	}

	public function get_with_parent($id = null, $single = false)
	{
		$this->db->select('pages.*, p.slug as parent_slug, .p.title as parent_title');
		$this->db->join('pages as p', 'pages.parent_id=p.id', 'left');
		return parent::get($id, $single);
	}

	public function get_no_parents()
	{
		$this->db->select('id, title');
		$this->db->where('parent_id', 0);
		$pages = parent::get();

		$array = [0 => 'No Parent'];

		if(count($pages)) {
			foreach ($pages as $page) {
				$array[$page->id] = $page->title;
			}
		}
		return $array;
	}
}