<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends ADMIN_Controller {
	public function __construct()
	{
		parent::__construct();
	}
	public function index()
	{
		$this->addData('page_sub_title',"Overview");
		$this->render('dashboard/dashboard');
	}

}

/* End of file Dashboard.php */
/* Location: ./application/modules/admin/controllers/Dashboard.php */