<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends ADMIN_Controller {
	private $limit 		= 5;
	
	private $per_page 	= 5;

	public function __construct()
	{
		parent::__construct();	
		$this->addData("page_title",strtoupper("DASHBOARD"));
		$this->set_tool(['btn_bottom_menu'=> uri_string()]);
	}
	public function index()
	{
		$this->prepare_data();
		$this->addData('page_sub_title','Beberapa dokumentasi yang dijadikan banner');
		$this->addData('remove_banner',true);
		$this->render('dashboard');
	}

	public function prepare_data()
	{

		// $this->db->join('banner', 'banner.documentation_id = documentation.id_documentation');
		// $data 						= $this->documentation_model->get();
		// $data['banner'] 				= $this->builder_banner($data);
		
		// dokumentasi
		// if ($this->get_selected_category()) {
		// 	$this->db->where('documentation.category_id', $this->get_selected_category());
		// }
		$this->load->model('documentation_model');
		$this->db->limit($this->limit);
		$this->db->join('banner', 'banner.documentation_id = documentation.id_documentation');
		$dokumentasi 			= $this->documentation_model->get();
		$data['documentation'] 	= $this->builder_list($dokumentasi);
		// if ($this->get_selected_category()) {
		// 	$this->db->where('documentation.category_id', $this->get_selected_category());
		// }
		$dokumentasi_row		= count($this->documentation_model->get());
		$this->pagination($dokumentasi_row);
		$this->addMultipleData($data);
		
	}
	
	/**
	 * Builder list dokumentasi
	 * 
	 * @param no param
	 * @return no return
	 */
	private function builder_list($data){
		$banner = $this->db->get('banner')->result_array();
		if ($banner) {
			$banner = array_column($banner, 'documentation_id');
		}
		foreach ($data as $key => $value) {
			$text  		= $value['description'];
			$text 		= strlen($text) > 60 ? substr($text, 0, 60) . '...' : $text;
			$date 		= convert_date($value['date_create']);
			$category 	= $value['category_name'];
			if (array_search($value['id_documentation'], $banner) > -1) {
				$banner_link = '
			<a href="'.site_url('admin/dokumentasi/remove_banner/'.$value['id_documentation']).'" class="remove-banner">
				<div class="position-absolute bg-cyan pl-5 pt-5 pr-5 pb-3" style="transform:rotate(-45deg);top:0; left:0;margin-top:-2.3em;margin-left:-3em;">
			<i class="fa fa-check" style="transform:rotate(45deg);"></i>
			</div>
			</a>';
			}else{

			$banner_link= '
			<a href="'.site_url('admin/dokumentasi/become_banner/'.$value['id_documentation']).'" class="banner">
			<div class="position-absolute bg-cyan pl-5 pt-5 pr-5 pb-3" style="transform:rotate(-45deg);top:0; left:0;margin-top:-2.3em;margin-left:-3em;">
			<i class="fa fa-plus" style="transform:rotate(45deg);"></i>
			</div>
			</a>';	
			}
			$temp 		= '
			<div class="card p-3 waves-effect text-center shadow ml-0 mb-3 position-relative overflow-hidden" style="height: 15em;">
			<img src="'.base_url() .'/assets/uploads/'.$value['image_name'].'" alt="gambar-dokumentasi" class="position-absolute h-100" style="left:0; right:0;top:0;bottom:0;">
			<div class="position-relative cover-card h-100 w-100 text-white bg-dark text-left p-2" style="left:0; right:0;top:0;bottom:0;">
					<div class="label">
					'.$value['title'].'
						<p class="position-absolute m-2" style="top:0;right: 0;"> %s </p>
					</div>
						<p class="text-sm mb-0"><i class="fa fa-clock"></i> '.$date.'</p>
						<p class="text-sm mb-1 p-0 "> Kategori - '.$category.'</p>
					<div class="description card-text">
						'.$text.'
					</div>
			</div>
			'.$banner_link.'
			</div>
			';
			// action btn
			$delete 	= anchor(site_url('admin/dokumentasi/delete/').$value['id_documentation'], '<i class="fa fa-trash"></i>', 'class="delete"');
			$temp 		= anchor(site_url('admin/dokumentasi/edit/').$value['id_documentation'],$temp);

			$result[] 	= sprintf($temp,$delete);
		}
		
		return @$result ? implode("", $result) : false ;

	}

	/**
	 * pagination page
	 * 
	 */
	public function pagination($row)
	{
		$this->load->library('pagination');

		$config['base_url'] 		= site_url('dokumentasi/index');
		$config['total_rows'] 		= $row;
		$config['per_page'] 		= $this->per_page;
		$config['first_link']       = 'Pertama';
		$config['last_link']        = 'Terakhir';
		$config['next_link']        = 'Selanjutnya';
		$config['prev_link']        = 'Sebelumnya';
		$config['full_tag_open']    = '<div class="pagging text-center float-right"><nav><ul class="pagination justify-content-center">';
		$config['full_tag_close']   = '</ul></nav></div>';
		$config['num_tag_open']     = '<li class="page-item"><span class="page-link text-cyan ">';
		$config['num_tag_close']    = '</span></li>';
		$config['cur_tag_open']     = '<li class="page-item "><span class="page-link bg-cyan text-dark">';
		$config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
		$config['next_tag_open']    = '<li class="page-item"><span class="page-link text-cyan">';
		$config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
		$config['prev_tag_open']    = '<li class="page-item"><span class="page-link text-cyan">';
		$config['prev_tagl_close']  = '</span>Next</li>';
		$config['first_tag_open']   = '<li class="page-item"><span class="page-link text-cyan">';
		$config['first_tagl_close'] = '</span></li>';
		$config['last_tag_open']    = '<li class="page-item"><span class="page-link text-cyan">';
		$config['last_tagl_close']  = '</span></li>';

		$this->pagination->initialize($config);
	}

}

/* End of file Admin.php */
/* Location: ./application/modules/admin/controllers/Admin.php */