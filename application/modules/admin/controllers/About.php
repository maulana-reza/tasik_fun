<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class About extends ADMIN_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->addData('btn_back','admin');
		$this->addData('page_title','Tentang Kami');
		$this->addData('page_sub_title','Informasi');
	}
	public function index()
	{
		$this->submit();
		$this->form();
		$this->render('about/about');
	}
	public function submit()
	{
		if ($this->input->post('submit') != "submit") {
			return false;
		}
		$data = [
			'description'	=> $this->input->post('description'),
		];
		$row = $this->db->get('about')->num_rows();
		if ($row) {
			$this->db->update('about',$data);
		}else{
			$this->db->insert('about',$data);
		}

			$array[] = [
				'text' => "Informasi Tentang kami berhasil di ubah" ,
				'type' => 'success' 
			];
			alert($array);

	}
	public function form()
	{
		$abouts 		= $this->db->get('about')->row_array();

		$data['description'] = [
			'name'		=> 'description',
			'class'		=> 'address',
			'value'		=> @$abouts['description'],
		];
		$this->addMultipleData($data);
	}

}
