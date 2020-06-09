<?php
 defined('BASEPATH') OR exit('No direct script access allowed');

 class Terms extends MY_Controller {
 	public function __construct()
 	{
 		parent::__construct();
	    $this->set_tool(['btn_bottom_menu'=> uri_string()]);

 	}
 	public function service()
 	{

		// page title
		$this->addData("page_title",strtoupper( lang_line('l_service','label_input')));

 		$this->render('service');
 	}
 	public function privacy()
 	{

		// page title
		$this->addData("page_title",strtoupper( lang_line('l_privacy','label_input')));
 		$this->render('privacy');
 	}

 }