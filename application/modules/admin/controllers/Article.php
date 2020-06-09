<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Article extends ADMIN_Controller {
	public function __construct()
	{
		parent::__construct();	
		$this->addData("page_title",strtoupper("Dokumentasi"));
		$this->set_tool(['btn_bottom_menu'=> uri_string()]);
	}
	public function index()
	{
		$this->render('article/article');
	}
}