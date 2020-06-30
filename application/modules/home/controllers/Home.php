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
		$this->render('home','eatery');
	}
	private function prepare_data()
	{
		$this->load->model('admin/documentation_model');

		$this->db->join('banner', 'banner.documentation_id = documentation.id_documentation');
		$data 						= $this->documentation_model->get();
		$add['banner'] 				= $this->builder_banner($data);
		$this->db->limit(4);
		$category 					= $this->db->get('category')->result_array();
		$list_cat['category'] 		= $this->builder_category($category);
		$add['category'] 			= $this->load->view('category', $list_cat, TRUE);
		$this->db->limit(4);

		$this->db->where('category.name', 'Umum');
		$documentation  			= $this->documentation_model->get();
		$list_doc['documentation']	= $this->builder_documentation($documentation);
		$add['documentation']		= $this->load->view('documentation', $list_doc, TRUE);
		$this->addMultipleData($add);
	}
	private function builder_banner($banner)
	{
		foreach ($banner as $key => $value) {
			$img 	= base_url(getenv('IMG_PATH')).'/'.$value['image_name']; 
			$title 	= $value['title'];
			$url 	= site_url('dokumentasi/view/').$value['id_documentation'];
			$text 	= strlen($value['description']) > 100 ? substr($value['description'], 0,100).'...' : $value['description'];

			$result[] = '
			      <div class="slider-item" style="background-image:url('.$img.')">
			        <div class="container">
			          <div class="row slider-text align-items-center justify-content-center">
			            <div class="col-md-8 text-center col-sm-12 element-animate">
			              <h1>'.ucfirst($title).'</h1>
			              <p class="mb-5">'.$text.'</p>
			              <p><a href="'.$url.'" class="btn btn-white btn-outline-white position-relative" style="z-index:10000;">LIHAT SELENGKAPNYA</a></p>
			            </div>
			          </div>
			        </div>
			      </div>';

		}
		return @$result ? implode("", $result) : false;
	}
	public function builder_category($category)
	{
		foreach ($category as $key => $value) {
			$icon 	  = base_url(getenv('IMG_PATH')).'/'.$value['icon'];
			$title 	  = $value['name'];
			$anchor   = site_url('dokumentasi?category='.$value['id_category']); 
			$result[] = '<a href="'.$anchor.'" title="" class="col-md-6 mb-4 mb-lg-0 col-lg-3 text-center overflow-hidden"><div class="">
			<img src="'.$icon.'" alt="" class="w-25 m-3">
            <h4 class="mb-4 text-primary">'.$title.'</h4>
          </div></a>';
		}
		return @$result ? implode("", $result) : false;


	}
	public function builder_documentation($documentation)
	{
		$increment = 0;
		foreach ($documentation as $key => $value) {
			$increment +=1;
			$img 	= base_url(getenv('IMG_PATH')).'/'.$value['image_name']; 
			$title 	= $value['title'];
			$url 	= site_url('dokumentasi/view/').$value['id_documentation'];
			$text 	= strlen($value['description']) > 100 ? substr($value['description'], 0,100).'...' : $value['description'];

			if ($increment == 1) {

				$temp[]     =
				'<a href="'.$url.'" title="">
				<div class="sched d-block d-lg-flex">
	              <div class="bg-image order-2" style="background-image: url('.$img.');"></div>
	              <div class="text order-1">
	                <h3>'.$title.'</h3>
	                <p style="font-size:small" class="text-dark m-0 p-0">'.convert_date($value['date_create'],'d / F / Y - H : i').'</p>

	                <p>'.$text.' </p>
	                <object>
	                <a href="'.$url.'" title="">
	                <p class="text-primary h3">LIHAT</p>
	                
	                </a>
	                </object>
	              </div>
	            </div>
	            </a>';
			}else{
				$temp[]     = '
				<a href="'.$url.'" title="">
				<div class="sched d-block d-lg-flex">
              <div class="bg-image" style="background-image: url('.$img.');"></div>
              <div class="text ">
                <h3>'.$title.'</h3>
                <p style="font-size:small" class="text-dark m-0 p-0">'.convert_date($value['date_create'],'d / F / Y - H : i').'</p>
                <p>'.$text.'</p>
                <object>
                <a href="'.$url.'" title=""><p class="text-primary h3 nav-link cta-btn">LIHAT</p></a>

                </object>
                
              </div>
            </div>
            </a>';
			}
			if ($increment > 1) {
				$wrapper 	= '
				<div class="col-md-6">
				%s
				</div>
				';
				$result[]   = sprintf($wrapper,implode("", $temp));
				$increment  = 0;
				unset($temp);
			}else{
				$else 	= '
				<div class="col-md-6">
				%s
				</div>
				';
				$else_[]   = sprintf($else,implode("", $temp));
				// $increment  = 0;
				// unset($temp);
			}
		}
		$last = @count(@$else_) > 1 ? $else_[count($else_) - 1] : "";
		return @$result ? implode("", $result).$last : (@$else_ ? implode('', $else_) : false);

	}

}

/* End of file Home.php */
/* Location: ./application/modules/home/controllers/Home.php */
 ?>