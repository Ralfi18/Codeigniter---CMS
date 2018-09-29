<?php 

class Migrate extends Admin_Controller
{
  public function index()
  {
    $this->load->library('migration');

    if ($this->migration->current() === FALSE)
    {
      show_error($this->migration->error_string());
    } else {
    	echo 'Migrated!';
    }
  }
}