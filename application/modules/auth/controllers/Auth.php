<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends MEMBER_Controller {

	 

	public function __construct()
	{
		parent::__construct();
		// uri back
		$this->addData('prev_uri',site_url('profile'));
		// load lang
		$this->lang->load('alert');
		// load model
		
		// if not complete information
		// $this->get_complete_information();

		$this->load->helper('address');

	}
	public function index()
	{
		if ($this->is_login()){
			redirect('admin','refresh');
		}else{

			$this->login();
			$this->render('login','puskeswan-login');
		}
	}
	public function complete()
	{
		// page title
		$this->addData("page_title",strtoupper( lang_line('l_menu_profile','label_input')));
		// load lang label
		$this->lang->load('label_input');
		$this->submit();

		$profile = $this->get_complete_information();

		$array[] = [
			'text' => lang_line('max_size_upload','alert'),
			'type' => 'info' 
		];
		cst_alert($array);
		$this->addMultipleData($profile);

		$this->data['img'] = [
			'name' => 'image[]',
			'id' => 'image-add',
			'type' => 'file',
			'value' => @$profile['img'],
			'class' =>'w-100 h-100 bg-transparent border-0 hide gallery',
		];
		$this->data['username'] = [
			'name' => 'username',
			'id' => 'username',
			'type' => 'text',
			'class' =>'form-control mt-0 pt-0 ',
			'placeholder' => lang_line('l_user','label_input') ,
			'value' => @$profile['username'],
		];
		$this->data['email'] = [
			'name' => 'email',
			'id' => 'email',
			'type' => 'text',
			'placeholder' => lang_line('l_email','label_input'),
			'class' =>'form-control mt-0 pt-0 ',
			'value' => @$profile['email'],
		];

		$this->data['phone'] = [
			'name' => 'phone',
			'id' => 'phone',
			'placeholder' => lang_line('l_phone','label_input'),
			'type' => 'number',
			'class' =>'form-control mt-0 pt-0 ',
			'value' => $profile['phone'],
		];
		$this->data['full_name'] = [
			'name' => 'full_name',
			'id' => 'full_name',
			'placeholder' => lang_line('l_full_name','label_input'),
			'type' => 'text',
			'class' =>'form-control mt-0 pt-0 ',
			'value' => $profile['full_name'],
		];
		$this->addMultipleData($this->data);
		$this->render('information');
		$this->load->view('v_script');
	}
	// to insert profile users
	private function submit()
	{
		try {
			
		if ($this->input->post('submit') && $this->is_login()) {
			$profile = [
				'email'		=> $this->input->post('email'),
				'phone'		=> $this->input->post('phone'),
				'full_name'	=> $this->input->post('full_name'),
			];
			$data = $this->upload_files("image");
			if ($data) {
				$profile['img'] = $data[0]['name'];
			}
			if ($this->input->post('village') == "..." || $this->input->post('regency') == "..." ){
				throw new Exception(lang_line("address_not_valid","alert"), 1);
			}
					
			if ($this->input->post('village')) {

			$profile['villages_id'] = $this->input->post('village');

			}
			$this->db->where('users.id', $this->get_id());
			$this->db->update('users',$profile);
			$db = $this->db->affected_rows();

			$array[] = [
				'text' => lang_line('profile_success','alert'),
				'type' => 'success' 
			];
			alert($array);
			$this->redirect_home();
		}

		} catch (Exception $e) {
			
			$array[] = [
				'text' => $e->getMessage(),
				'type' => 'info' 
			];
			alert($array);
		}
	}
	
	public function province()
	{
		$array = [
			'province_id' => $this->input->post('id')
		];
		echo select_regency($array);
	}
	public function regency()
	{
		$array = [
			'regency_id' => $this->input->post('id')
		];
		echo select_district($array);
	}

	public function district()
	{
		$array = [
			'district_id' => $this->input->post('id')
		];

		echo select_village($array);
	}
	public function out()
	{
		$this->db->delete('auth',['token' => $_COOKIE['token']]);
		$this->logout();
	}
	public function upgrade()
	{
		$image = $this->upload_files('image');

		// if image exist
		if (@$image[0]["name"]) {
			
			$insert = [
				'document' => $image[0]["name"],
				'user_id' => $this->get_id(),
			];
			
			$upgrade = $this->db->get_where('upgrade', ['user_id' => $this->get_id()])->num_rows();

			if (!$upgrade) {
				$this->load->model('profile/profile_model');
				$this->load->library('notification');

				$device_token = $this->get_device_token_admin();
				$user = $this->profile_model->get_user_by_id($this->get_id());
				$title = $this->config->item('upgrade_title');
				$message = sprintf($this->config->item('upgrade'),$user[0]['full_name']);

				$data = $this->notification->pushNotification($device_token,$title,$message,site_url("admin/verify"));
				$this->db->insert('upgrade', $insert);
			
			}
			 $array[] = [
				'text' => lang_line('user_upgrade','alert'),
				'type' => 'success' 
			];
			alert($array);
		}
		redirect('sell');
	}
	public function bid()
	{
		// page title
		$this->addData("search_page",TRUE);
		$this->addData("page_title",strtoupper( lang_line('l_bid','label_input')));
	    $this->set_tool(['btn_bottom_menu'=> uri_string()]);
		$this->load->helper('car');
		$this->db->limit($this->config->item('pagination_perpage'),0);
        $this->get_bid_by_user();
        
       	$this->render("bid");
	}
	public function get_bid_by_user()
	{
		$this->load->model('profile/profile_model');
		$user_id = $this->get_id();
		$this->db->select('bid.content_id,content.is_sold');
        $bids = $this->profile_model->get_bid_by_user_id($user_id);
        $data = [
        	'bids' => $bids,
        	'bid_count' => count($bids),
        ];
        $this->addMultipleData($data);
	}
	public function change_password()
	{
	    $this->set_tool(['btn_bottom_menu'=> uri_string()]);
		$this->addData('page_title',lang_line('change_password_heading','auth'));
		parent::change_password();
	}
	public function load_bid($page=false)
	{
		try {
			if (!$page) {
				throw new Exception("Error Processing Request", 1);
			}
			// content by user id
			$this->db->limit($this->config->item("pagination_perpage"),$page);
	        $this->get_bid_by_user();
			$user_contents = $this->getData('bids');
			if  (!@$user_contents[0]){
				throw new Exception("Error Processing Request", 1);
				
			}
			$this->load->view('bid_content', ['bids'=>$this->getData('bids')]);

		} catch (Exception $e) {
		
			echo '<div class="text-center card-text"> '.lang_line("not_found","alert").' </div>';

		}
	}
	
}