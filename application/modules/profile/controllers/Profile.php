<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends MY_Controller {
	public function __construct()
	{
		parent::__construct();
		//Do your magic here
	}
	public function index()
	{
		$this->addData('remove_banner',true);
		$this->addData('page_title','Profile Admin Tasik FUN');
		$this->render('profile','default-article');
	}
}
