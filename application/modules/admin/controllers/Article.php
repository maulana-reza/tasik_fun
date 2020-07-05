<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Article extends ADMIN_Controller {
	/**
	 * Pagination per page
	 */
	private $per_page = 10;
	public function __construct()
	{
		parent::__construct();	
		$this->addData("page_title",strtoupper("Artikel"));
		$this->addData('page_sub_title','Tambah data Artikel lapangan');
		$this->load->model('article_model');
		$this->addData('btn_back','admin/article');

	}
	/**
	 * Page Default
	 */
	public function index($row = 0)
	{
		$this->addData('btn_back','admin');
		$this->prepare_data($row);
		$this->render('article/article');

	}
	/**
	 * Prepare Data
	 * 
	 * @param no param
	 * @return no return
	 */
	public function prepare_data($row)
	{
		// dokumentasi
		$this->db->limit($this->per_page,$row);
		$dokumentasi 		= $this->article_model->get();
		
		$dokumentasi_row	= count($this->article_model->get());
		$this->pagination($dokumentasi_row);
		$data['list']		= $this->builder_list($dokumentasi);
		$this->addMultipleData($data);
	}
	/**
	 * pagination page
	 * 
	 */
	public function pagination($row)
	{
		$this->load->library('pagination');

		$config['base_url'] 		= site_url('admin/article/index');
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
		$config['cur_tag_open']     = '<li class="page-item "><span class="page-link bg-cyan text-white">';
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
	/**
	 * Document id
	 */
	public function edit($kode)
	{	
		$this->submit_edit($kode);
		$this->form_edit($kode);
		$this->render('article/edit');
	}
	/**
	 * Page add data dokumentasi
	 * 
	 * @param no param
	 * @return no return
	 */
	public function submit_edit($kode)
	{
		if ($this->input->post('submit') != "submit") {
			return false;
		}
		$article = [
			'title'			=> $this->input->post('title'),
			'description'	=> $this->input->post('description'),
		];
		if(@$_FILES['photo']['name']){
			$article['image'] = $this->upload_files('photo',false);
		}
		$this->db->where('article.kode_article', $kode);
		$this->db->update('article', $article);
		$images 	= $this->upload_multiple_files($_FILES,$this->input->post('desc'),'image',$kode);
		// insert
		if ($images) {
			$this->db->insert_batch('article_image', $images);
		}

		$array[] = [
			'text' => 'Berhasil Mengubah data dokumentasi',
			'type' => 'success' 
		];
		alert($array);

	}
	/**
	 * Prepare form edit
	 * 
	 * @param document_id
	 * 
	 */
	public function form_edit($kode)
	{

		$article 	= $this->article_model->get_article_by_id_article($kode);
		if (@!$article[0]) {
			$array[] = [
				'text' => 'article tidak ditemukan',
				'type' => 'danger' 
			];
			alert($array);
			redirect('admin/article','refresh');
		}
		$this->db->where('kode_article',$kode);
		$images  		= $this->db->get('article_image')->result_array();
		$this->data['images'] = $this->builder_image($images);
		$this->addData('photo',$article[0]['image']);
		$this->data['title'] = [
			'name'  => 'title',
			'id'    => 'title',
			'class'	=> 'form-control',
			'type'  => 'text',
			'value' => $article[0]['title'],
		];

		$this->data['description'] = [
			'name'  => 'description',
			'id'    => 'editor',
			'value' => $article[0]['description'],

		];
		$this->addMultipleData($this->data);
	}
	public function builder_image($article_image)
	{
		foreach ($article_image as $key => $value) {
			$temp 		= '<div class="card delete-image p-3 waves-effect text-center shadow ml-0 mb-0 position-relative overflow-hidden" style="height: 15em;">
						<img src="%s" alt="gambar-dokumentasi" class="position-absolute h-100" style="left:0; right:0;top:0;bottom:0;">
						%s
						</div>';
			$image  	= $this->config->item('img_path').'/'.$value['img'];
			$delete 	= anchor(site_url('admin/article/delete_image/'.$value['id'].'/'.$value['kode_article']), ' <i class="fa fa-trash fa-2x"></i>','class=" cover-card m-3 " style="position:absolute; top:0;right:0;bottom:0;"');
			$result[] 	= sprintf($temp,$image,$delete);
		}
		return @$result ? implode("", $result) : false ;
	}
	public function is_your_responsibility()
	{
		$data = $this->article_model->get();
		if (@$data[0]) {
			return true;
		}
		return false;

	}
	public function delete_image($image_id='',$kode)
	{

		$this->db->where('article_image.id', $image_id);
		$this->db->join('article_image','article.kode_article = article_image.kode_article');
		if (!$this->is_your_responsibility()) {
			$array[] = [
				'text' => 'Gambar tidak ditemukan',
				'type' => 'danger' 
			];
			alert($array);
			redirect('admin/article','refresh');
		}
		$this->db->delete('article_image',['id'=> $image_id]);
		$array[] = [
				'text' => 'Gambar berhasil dihapus',
				'type' => 'success' 
			];
		alert($array);
		redirect('admin/article/edit/'.$kode,'refresh');

	}

	public function delete($kode = 0)
	{
		$this->db->where('article.kode_article', $kode);
		if (!$this->is_your_responsibility()) {
			$array[] = [
				'text' => 'Artikel tidak ditemukan',
				'type' => 'danger' 
			];
			alert($array);
			redirect('admin/article','refresh');
		}
		$this->db->delete('article',['kode_article'=> $kode]);
		$this->db->delete('article_image',['kode_article'=> $kode]);
		$array[] = [
				'text' => 'Artikel berhasil dihapus',
				'type' => 'success' 
			];
		alert($array);
		redirect('admin/article/','refresh');

	}
	public function builder_list($data)
	{

		if (!is_array($data)) {
			return false;
		}
		foreach ($data as $key => $value) {

			$html[] = '
					<div class="card flex-row flex-wrap mb-2 overflow-hidden">
						<div class="card-header border-0 p-0">
							<img src="'.$this->config->item('img_path').'/'.$value['image'].'" alt="">
						</div>
						<div class="card-block px-2">
							<h4 class="card-title">'.$value['title'].'</h4>
							<p class="card-text">'.$value['description'].'</p>
							<a href="'.site_url('admin/article/delete/'.$value['kode_article']).'" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
							<a href="'.site_url('admin/article/edit/'.$value['kode_article']).'" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></a>
						</div>
						<div class="w-100"></div>
					</div>';
		}
		return @$html ? implode("", $html) : false;
	}
	/**
	 * Page add data dokumentasi
	 * 
	 * @param no param
	 * @return no return
	 */
	public function add()
	{
		$this->submit();
		$this->form_add();
		$this->render('article/add');

	}
	public function form_add()
	{

		$this->data['title'] = [
			'name'  => 'title',
			'id'    => 'title',
			'class'	=> 'form-control',
			'type'  => 'text',
			'value' => $this->form_validation->set_value('title'),
		];

		$this->data['description'] = [
			'name'  => 'description',
			'id'    => 'editor',
			'value' => $this->form_validation->set_value('description'),
		];
		$this->addMultipleData($this->data);
	}
	/**
	 * Page add data dokumentasi
	 * 
	 * @param no param
	 * @return no return
	 */
	public function submit()
	{
		if ($this->input->post('submit') != "submit") {
			return false;
		}

		$this->form_validation->set_rules('title', 'Judul', 'trim|required');
		$this->form_validation->set_rules('description', 'Deskripsi', 'required');
		if ($this->form_validation->run() === FALSE) {

			$array[] = [
				'text' => validation_errors() ,
				'type' => 'warning' 
			];
			alert($array);
			return false;
		}

		$this->db->order_by('article.kode_article', 'desc');
		$kode 		   = $this->db->get('article')->row_array();

		$kode_article  = strtoupper(substr($this->input->post('title'), 0, 2)).(@$kode['kode_article'] ? str_pad(filter_var($kode['kode_article'],FILTER_SANITIZE_NUMBER_INT)+1 ,3, "0", STR_PAD_LEFT) : "001");
		$article = [
			'kode_article'	=> $kode_article,
			'title'			=> $this->input->post('title'),
			'description'	=> $this->input->post('description'),
		];
		$article['image'] = $this->upload_files('photo');
		$this->db->insert('article', $article);
		$images 			= $this->upload_multiple_files($_FILES,$this->input->post('desc'),'image',$kode_article);
		// insert
		$this->db->insert_batch('article_image', $images);

		$array[] = [
			'text' => 'Berhasil Menambahkan data dokumentasi',
			'type' => 'success' 
		];
		alert($array);
		redirect('admin/article','refresh');

	}
	/**
	 * for upload image with car_id
	 *
	 * @param string file
	 * @param string index
	 * @param string name
	 * @return array : car_id,name
	 */
	public function upload_multiple_files($files,$index_,$name,$document_id = false){

		$data = array();
		// Looping all files
		if (@!$index_) {
			return false;
		}
		foreach ($index_ as $i => $value) {
			$index = $i - 1;
			if (count($index_) == 1) {
				$index = 0;
			}
			if(!empty(@$files[$name]['name'][$index])){

				// Define new $_FILES array - $_FILES['file']
				$_FILES['file']['name']       = $files[$name]['name'][$index];
				$_FILES['file']['type']       = $files[$name]['type'][$index];
				$_FILES['file']['tmp_name']   = $files[$name]['tmp_name'][$index];
				$_FILES['file']['error']      = $files[$name]['error'][$index];
				$_FILES['file']['size']       = $files[$name]['size'][$index];

				// Set preference
				$config['upload_path']        = getenv('IMG_PATH');
				$config['allowed_types']      = 'jpg|jpeg|png';
				$config['max_size']           = '2000';
				$config['encrypt_name']       = TRUE; // max_size in kb
				//Load upload library
				$this->load->library('upload',$config);

				// File upload
				if($this->upload->do_upload('file')){
					// Get data about the file
					$uploadData = $this->upload->data();
					$filename = $uploadData['file_name'];

					// Initialize array
					$data[] = [
						'kode_article'      => @$document_id,
						'img'                  => $filename,
					];

				}else{

					$array[] = [
						'text' => $this->upload->display_errors(),
						'type' => 'danger'
					];
					alert($array);
					redirect(uri_string(),"REFRESH");
				}
			}
		}
		return $data;
	}

	public function upload_files($name,$is_redirect = TRUE){

		// Set preference
		$config['upload_path']        = getenv('IMG_PATH');
		$config['allowed_types']      = 'jpg|jpeg|png';
		$config['max_size']           = '2000';
		$config['encrypt_name']       = TRUE; // max_size in kb
		//Load upload library
		$this->load->library('upload',$config);

		// File upload
		if($this->upload->do_upload($name)){
			// Get data about the file
			$uploadData = $this->upload->data();
			$filename = $uploadData['file_name'];
			return $filename;

		}else{
			if($is_redirect){
				$array[] = [
					'text' => $this->upload->display_errors(),
					'type' => 'danger'
				];
				alert($array);

				redirect(uri_string(),"REFRESH");
			}
		}
	}
}
