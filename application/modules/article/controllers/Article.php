<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Article extends MY_Controller {
	private $per_page = 10;
	public function __construct()
	{
		parent::__construct();
		//Do your magic here
		$this->load->model('admin/article_model');

	}
	public function index($row = 0)
	{
		
		$this->addData('remove_banner',true);
//		$this->addData('page_title','Kegiatan Kami');
		$this->prepare_data($row);
		$this->render('article/search','default-article');
	}
	public function prepare_data($row)
	{
		if(($search = $this->input->get('search'))){
			$search = explode(" ",$search);
			foreach ($search as $item) {
				$this->db->or_like('title',$item);
			}
		}
		$this->db->limit($this->per_page,$row);
		$this->db->order_by('article.date_create','desc');
		$article 			= $this->article_model->get();
		$data['article'] 	= $this->builder_list($article);

		$dokumentasi_row		= count($this->article_model->get());
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

	private function builder_list($documentation)
	{
		foreach ($documentation as $key => $value) {
			$img 	= $this->config->item('img_path').'/'.$value['image'];
			$title 	= $value['title'];
			$text 	= strlen($value['description']) > 100 ? substr($value['description'], 0,100).'...' : $value['description'];

			$result[] = '
  <div class="card">
    <img class="card-img-top" src="'.$img.'" alt="Card image cap">
    <div class="card-body">
      <h5 class="card-title">'.$title.'</h5>
      <p class="card-text">'.$text.'</p>
      <p class="card-text"><small class="text-muted">'. convert_date($value['date_create'],"d / F / Y , H : i").'</small></p>
      <div class="text-right">
     <a href="'.site_url('article/view/'.$value['kode_article']).'" class="btn btn-primary">Read More</a>
</div>
    </div>
  </div>
  ';


		}
		return @$result ? ' <div class="card-deck">'.implode("", $result).'</div>' : false;
	}
	public function view($kode = 0)
	{
		$this->db->where('article.kode_article', $kode);
		$article = $this->article_model->get()[0];
		if (@!$article) {
			redirect('not_found','refresh');

		}
		$this->prepare_view($kode);
		$this->addData('page_title',$article['title']);
		$this->addData('page_sub_title',convert_date($article['date_create'],'d / F / Y -  H : i'));
		$this->addMultipleData($article);
		$this->render('view','default-article');

	}
	public function prepare_view($kode = 0)
	{
		$this->db->where('kode_article',$kode);
		$data = $this->db->get('article')->row_array();

		$this->db->where('kode_article',$kode);
		$image = $this->db->get('article_image')->result_array();
		$data['gallery'] =  $this->builder_image($image);
		$this->addMultipleData($data);
	}
	public function builder_image($image)
	{
		foreach ($image as $key => $value) {
			$img 		= base_url(getenv('IMG_PATH')).'/'.$value['img'];
			$result[] 	= '
			<div class="mb-3 pics animation all 2">
    <img class="img-fluid" src="'.$img.'" alt="Card image cap">
  </div>';
		}
		$data = '
<div class="gallery" id="gallery">
					    %s </div>
		';
		return @$result ? sprintf($data,implode("", $result)) : false;
	}

}

/* End of file Dokumentasi.php */
/* Location: ./application/modules/dokumentasi/controllers/Dokumentasi.php */
