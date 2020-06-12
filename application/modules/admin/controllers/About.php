<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class About extends ADMIN_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->addData('btn_back','admin');
		$this->addData('page_title','Tentang Kami');
		$this->addData('page_sub_title','Informasi Perusahaan');
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
			'company_name' 	=> $this->input->post('company_name'),
			'address'		=> $this->input->post('address'),
			'phone_number'	=> $this->input->post('phone_number'),
			'location'		=> $this->input->post('location'),
			'email'			=> $this->input->post('email'),
		];
		$row = $this->db->get('about')->num_rows();
		if ($row) {
			$this->db->update('about',$data);
		}else{
			$this->db->insert('about',$data);
		}

			$array[] = [
				'text' => "Informasi Perusahaan berhasil di ubah" ,
				'type' => 'success' 
			];
			alert($array);

	}
	public function form()
	{
		$abouts = $this->db->get('about')->row_array();
		$data['company_name'] = [
			'name'		=> 'company_name',
			'class'		=> 'form-control',
			'required'	=> 'true',
			'value'		=> @$abouts['company_name'],
		];
		$data['address'] = [
			'name'		=> 'address',
			'class'		=> 'address-text',
			'value'		=> @$abouts['address'],
		];
		$data['phone_number'] = [
			'name'		=> 'phone_number',
			'class'		=> 'form-control',
			'required'	=> 'true',
			'value'		=> @$abouts['phone_number'],
		];
		$data['email'] = [
			'name'		=> 'email',
			'class'		=> 'form-control',
			'required'	=> 'true',
			'value'		=> @$abouts['email'],
		];
		$this->addMultipleData($data);
	}

}