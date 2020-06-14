<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class About extends MY_Controller {
	private $per_page = 10;
	public function __construct()
	{
		parent::__construct();
		//Do your magic here
	}
	public function index()
	{
		$this->addData('remove_banner',true);
		$this->addData('page_title','Tentang Kami');
		$this->render('about','eatery');
	}
	public function contact()
	{

		$this->addData('remove_banner',true);
		$this->addData('page_title','Hubungi Kami');
		$this->render('contact','eatery');
	}
}