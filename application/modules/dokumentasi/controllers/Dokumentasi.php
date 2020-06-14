<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dokumentasi extends MY_Controller {
	private $per_page = 10;
	public function __construct()
	{
		parent::__construct();
		//Do your magic here
		$this->load->model('admin/documentation_model');

	}
	public function index($row = 0)
	{
		
		$this->addData('remove_banner',true);
		$this->addData('page_title','Kegiatan Kami');
		$this->prepare_data($row);
		$this->render('/dokumentasi/dokumentasi','eatery');	
	}
	public function prepare_data($row)
	{

		// $this->db->join('banner', 'banner.documentation_id = documentation.id_documentation');
		// $data 						= $this->documentation_model->get();
		// $data['banner'] 				= $this->builder_banner($data);
		
		// dokumentasi
		// if ($this->get_selected_category()) {
		// 	$this->db->where('documentation.category_id', $this->get_selected_category());
		// }
		$this->db->limit($this->per_page,$row);
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

	private function builder_banner($banner)
	{
		foreach ($banner as $key => $value) {
			$img 	= base_url(getenv('IMG_PATH')).'/'.$value['image_name']; 
			$title 	= $value['title'];
			$url 	= site_url('dokumentasi/view/').$value['id_documentation'];
			$text 	= strlen($value['description']) > 100 ? substr($value['description'], 0,100).'...' : $value['description'];

			$result[] = '
			      <div class="slider-item" style="'.$img.'">
			        <div class="container">
			          <div class="row slider-text align-items-center justify-content-center">
			            <div class="col-md-8 text-center col-sm-12 element-animate">
			              <h1>'.ucfirst($title).'</h1>
			              <p class="mb-5">'.$text.'</p>
			              <p><a href="'.$url.'" class="btn btn-white btn-outline-white">LIHAT SEKARANG</a></p>
			            </div>
			          </div>
			        </div>
			      </div>';


		}
		return @$result ? implode("", $result) : false;
	}
	private function builder_list($documentation)
	{
		foreach ($documentation as $key => $value) {
			$img 	= base_url(getenv('IMG_PATH')).'/'.$value['image_name']; 
			$title 	= $value['title'];
			$url 	= site_url('dokumentasi/view/').$value['id_documentation'];
			$text 	= strlen($value['description']) > 100 ? substr($value['description'], 0,100).'...' : $value['description'];

			$result[] = '
			      <div class="col-md-6 mb-4">
            <div class="blog d-block d-lg-flex">
              <div class="bg-image" style="background-image: url('.$img.');"></div>
              <div class="text">
                <h3>'.$title.'</h3>
                <p class="sched-time">
                  <span><span class="fa fa-calendar"></span> '. convert_date($value['date_create'],"d / F / Y , H : i").'</span> <br>
                </p>
                <p>'.$text.'</p>
                
                <p><a href="'.$url.'" class="btn btn-primary btn-sm">Read More</a></p>
              </div>
            </div>
          </div>';


		}
		return @$result ? implode("", $result) : false;
	}
	public function view($documentation_id = 0)
	{
		$this->db->where('documentation.id_documentation', $documentation_id);
		$documentation = $this->documentation_model->get()[0];
		if (@!$documentation) {
			redirect('not_found','refresh');

		}
		$this->prepare_view($documentation_id);
		$this->addData('page_title',$documentation['title']);
		$this->addData('page_sub_title',convert_date($documentation['date_create'],'d / F / Y -  H : i'));
		$this->addMultipleData($documentation);
		$this->render('view','eatery');

	}
	public function prepare_view($documentation_id = 0)
	{
		$documentation = $this->documentation_model->get_documentation_image_by_documentation_id($documentation_id);
		$data['documentation'] = $this->builder_image($documentation);
		$this->addMultipleData($data);
	}
	public function builder_image($image)
	{
		foreach ($image as $key => $value) {
			$title 		= $key < 1 ? $value['title'] : "";
			$sub_title 	= $key < 1 ? convert_date($value['date_create'],'d / F / Y - H : i') : "";
			$img 		= base_url(getenv('IMG_PATH')).'/'.$value['image_name'];
			$result[] 	= '
					      <div class="slider-item" style="background-image: url('.$img.');">
					        <div class="container">
					          <div class="row slider-text align-items-center justify-content-center">
					            <div class="col-md-8 text-center col-sm-12 element-animate">
					              <h1>'.$title.'</h1>
					              <p>'.$sub_title.'</p>
					            </div>
					          </div>
					        </div>
					      </div>';
		}
		$data = '
					    <section class="home-slider-loop-false  inner-page owl-carousel">
					    %s </section>
		';
		return $result ? sprintf($data,implode("", $result))  : false;
	}

}

/* End of file Dokumentasi.php */
/* Location: ./application/modules/dokumentasi/controllers/Dokumentasi.php */