<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MY_Controller {
	public function __construct()
	{
		parent::__construct();
	}
	public function index()
	{
		$this->addData('page_title','HOME');
		$this->prepare_data();
		$this->render('home','default-article');

	}
	private function prepare_data()
	{
		$this->load->model('admin/article_model');
//		$add['documentation']		= $this->load->view('documentation', FALSE);
//		$this->addMultipleData($add);
	}

}

/* End of file Home.php */
/* Location: ./application/modules/home/controllers/Home.php */
 ?>
