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
	public function edit($documentation_id)
	{	
		$this->submit_edit($documentation_id);
		$this->form_edit($documentation_id);
		$this->render('dokumentasi/edit');
	}
	/**
	 * Page add data dokumentasi
	 * 
	 * @param no param
	 * @return no return
	 */
	public function submit_edit($documentation_id)
	{
		if ($this->input->post('submit') != "submit") {
			return false;
		}

		if (!$this->get_selected_category()) {

			$array[] = [
				'text' => 'Pilih Category terlebih dahulu',
				'type' => 'success' 
			];
			alert($array);
			redirect(uri_string(),'refresh');
				
		}
		$documentation = [
			'title'			=> $this->input->post('title'),
			'description'	=> $this->input->post('description'),
			'category_id'	=> $this->get_selected_category(),
			'users_id'		=> $this->get_id(),
			'date_edit'		=> date('Y-m-d H:i:s'),
		];
		$this->db->where('documentation.id_article', $documentation_id);
		$this->db->update('documentation', $documentation);
		$images 			= $this->upload_files($_FILES,$this->input->post('desc'),'image',$documentation_id);
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
	public function form_edit($documentation_id)
	{


		$category 				= $this->db->get('category')->result_array();
		$this->data['category'] = $this->builder_category($category);
		$dokumentasi 	= $this->article_model->get_documentation_by_id_article($documentation_id);
		if (@!$dokumentasi[0]) {
			$array[] = [
				'text' => 'Dokumentasi tidak ditemukan',
				'type' => 'danger' 
			];
			alert($array);
			redirect('admin/article','refresh');
		}
		$images  		= $this->article_model->get_article_image_by_documentation_id($documentation_id);
		$this->data['images'] = $this->builder_image($images);

		$this->data['title'] = [
			'name'  => 'title',
			'id'    => 'title',
			'class'	=> 'form-control',
			'type'  => 'text',
			'value' => $dokumentasi[0]['title'],
		];

		$this->data['description'] = [
			'name'  => 'description',
			'id'    => 'editor',
			'value' => $dokumentasi[0]['description'],

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
			$image  	= base_url('assets/uploads/'.$value['image_name']);
			$delete 	= anchor(site_url('admin/article/delete_image/'.$value['image_id'].'/'.$value['id_article']), ' <i class="fa fa-trash fa-2x"></i>','class=" cover-card m-3 " style="position:absolute; top:0;right:0;bottom:0;"');
			$result[] 	= sprintf($temp,$image,$delete);
		}
		return @$result ? implode("", $result) : false ;
	}
	public function is_your_responsibility()
	{
		$data = $this->article_model->get();
		if ($data[0]) {
			return true;
		}
		return false;

	}
	public function delete_image($image_id='',$documentation_id)
	{

		$this->db->where('article_image.id_article_image', $image_id);
		$this->db->where('documentation.users_id', $this->get_id());
		if (!$this->is_your_responsibility()) {
			$array[] = [
				'text' => 'Gambar tidak ditemukan',
				'type' => 'danger' 
			];
			alert($array);
			redirect('admin/article','refresh');
		}
		$this->db->delete('article_image',['id_article_image'=> $image_id]);
		$array[] = [
				'text' => 'Gambar berhasil dihapus',
				'type' => 'success' 
			];
		alert($array);
		redirect('admin/article/edit/'.$documentation_id,'refresh');

	}

	public function delete($documentation_id)
	{

		$this->db->where('documentation.id_article', $documentation_id);
		$this->db->where('documentation.users_id', $this->get_id());
		if (!$this->is_your_responsibility()) {
			$array[] = [
				'text' => 'Dokumentasi tidak ditemukan',
				'type' => 'danger' 
			];
			alert($array);
			redirect('admin/article','refresh');
		}
		$this->db->delete('documentation',['id_article'=> $documentation_id]);
		$this->db->delete('article_image',['documentation_id'=> $documentation_id]);
		$array[] = [
				'text' => 'Dokumentasi berhasil dihapus',
				'type' => 'success' 
			];
		alert($array);
		redirect('admin/article/','refresh');

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
			
			$temp 		= '
			<div class="card p-3 waves-effect text-center shadow ml-0 mb-3 w-100 position-relative overflow-hidden" style="height: 15em;">
			<img src="'.base_url() .'/assets/uploads/'.$value['image_name'].'" alt="gambar-dokumentasi" class="position-absolute h-100" style="left:0; right:0;top:0;bottom:0;">
			<div class="position-relative cover-card h-100 w-100 text-white bg-dark text-left p-2" style="left:0; right:0;top:0;bottom:0;">
					<div class="label">
					'.$value['title'].'
						<p class="position-absolute m-2" style="top:0;right: 0;"> %s </p>
					</div>
						<p class="text-sm mb-0"><i class="fa fa-clock"></i> '.$date.'</p>
					<div class="description card-text">
						'.$text.'
					</div>
			</div>
			</div>
			';
			// action btn
			$delete 	= anchor(site_url('admin/article/delete/').$value['kode_article'], '<i class="fa fa-trash"></i>', 'class="delete"');
			$temp 		= anchor(site_url('admin/article/edit/').$value['kode_article'],$temp);

			$result[] 	= sprintf($temp,$delete);
		}
		
		return @$result ? implode("", $result) : false ;

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

		$this->form_validation->set_rules('title', 'Judul', 'trim|required|is_unique[article.title]');
		$this->form_validation->set_rules('title', 'Judul', 'trim|required|is_unique[article.title]');
		$this->form_validation->set_rules('description', 'Deskripsi', '');
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

		$kode_article  = strtoupper(substr($this->input->post('title'), 0, 2)).(@$kode['kode_article'] ? (int)$kode['kode_article']+1 : "1"); 
		$documentation = [
			'kode_article'	=> $kode_article,
			'title'			=> $this->input->post('title'),
			'description'	=> $this->input->post('description'),
		];
		$this->db->insert('article', $documentation);
		$documentation_id 	= $this->db->insert_id();

		$images 			= $this->upload_files($_FILES,$this->input->post('desc'),'image',$documentation_id);
		// insert
		if (!$images) {

			$array[] = [
				'text' => "Pilih Gambar terlebih dahulu" ,
				'type' => 'warning' 
			];
			alert($array);
			return false;
		}
		$this->db->insert_batch('article_image', $images);

		$array[] = [
			'text' => 'Berhasil Menambahkan data dokumentasi',
			'type' => 'success' 
		];
		alert($array);
		// redirect('admin/article','refresh');

	}
	/**
	 * Builder category
	 * 
	 * @param array category
	 * @return array
	 */
	public function builder_category($categorys)
	{
		foreach ($categorys as $key => $value) {

			$selected = $this->get_selected_category() == $value['id_category'] ? 'bg-cyan text-white font-weight-bold' : 'bg-white' ;
			$html 	  = '<div class="item waves-effect rounded shadow card-text border p-2 pl-3 pr-0 mr-2 pb-0 %s "  style="border-radius:100px !important;">
								<div class="flex-nowrap">
								<div class="d-inline pr-2">#%s</div> <div class="p-1 d-inline-block bg-dark text-white rounded-circle text-center" style="opacity:1;width:25px;height:25px;" data-id="%s" > <object>
								<a href="'.site_url('admin/article/category/').$value['id_category'].'?back='.uri_string().'" title=""><i class="fa fa-edit"></i></a></object></div>
								</div>
						</div>';
			$category 		= $value['name'];
			$id_category 	= $value['id_category'];
			$temp 			= sprintf($html,$selected,$category,$id_category);
			$result[]		= anchor('admin/article/set_selected_category/'.$id_category, $temp);
		}

		return @$result ? implode("", $result) : false ;

	}
	public function set_selected_category($category_id = false)
	{
		parent::set_selected_category($category_id);
		redirect($_SERVER['HTTP_REFERER'],'refresh');

	}
	/**
	 * @param string
	 * 
	 */
	public function become_banner($documentation_id = false)
	{
		try {

		$documentation = $this->db->get_where('documentation', ['id_article' => $documentation_id])->num_rows();
		if (!$documentation_id || $documentation < 1) {
			throw new Exception("Dokumentasi tidak ditemukan", 1);
			
		}
		$already = $this->db->get_where('banner', ['documentation_id'=> $documentation_id])->num_rows();
 		if ($already > 0) {
 			throw new Exception("Sudah di pasang sebagai banner", 1);
 		}

 		$insert = [
 			'documentation_id' => $documentation_id
 		];
 		$this->db->insert('banner', $insert);
		$array[] = [
			'text' => 'Berhasil dipasang sebagai banner',
			'type' => 'success' 
		];
		alert($array);
		redirect($_SERVER['HTTP_REFERER'],'refresh');
			
		} catch (Exception $e) {
		$array[] = [
			'text' => $e->getMessage(),
			'type' => 'danger' 
		];
		alert($array);
		redirect($_SERVER['HTTP_REFERER'],'refresh');

		}
	}
	public function remove_banner($documentation_id=false)
	{
		$documentation = $this->db->get_where('banner',['documentation_id'=>$documentation_id])->num_rows();
		if (!$documentation_id || $documentation < 1) {
		$array[] = [
			'text' => 'Banner tidak ditemukan',
			'type' => 'danger' 
		];
		alert($array);
		redirect($_SERVER['HTTP_REFERER'],'refresh');

		}
		$this->db->delete('banner',['documentation_id'=>$documentation_id]);
		$array[] = [
			'text' => 'Berhasil menghapus dari banner',
			'type' => 'success' 
		];
		alert($array);
		redirect($_SERVER['HTTP_REFERER'],'refresh');

	}
	public function category($category_id = false)
	{
		$this->addData('page_title','kategori');
		$this->addData('page_sub_title','Manajemen kategori');
		$back = $this->input->get('back');
		$this->submit_category($category_id);
		$this->render('dokumentasi/category');
	}
	public function submit_category($category_id)
	{
		if ($this->input->post('submit') != 'submit') {
			return false;
		}
		$desc 	= $this->input->post('desc');
		$insert = $this->upload_category($_FILES,$desc,'image');
		if ($category_id) {

			$pesan 	= 'Berhasil mengubah kategori';
			$insert_ = [
				'icon' => $insert[0]['icon'],
				'name' => $insert[0]['nopen ame'],
			];

			$this->db->where('id_category', $category_id);
			$this->db->update('category', $insert_);
		}else{
			$pesan 	= 'Berhasil menambah kategori';
			$this->db->insert_batch('category', $insert);
		}

		$array[] = [
			'text' => $pesan,
			'type' => 'success' 
		];
		alert($array);
		// redirect($this->input->get('back'),'refresh');

	}
	 public function upload_category($files,$index_,$name){
 
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
        if(empty(@$files[$name]['name'][$index]) === false){
 
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
                'name'		            => $index_[(count($index_) == 1 ? 0 : $index+1)],
                'icon'                  => $filename,
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
	

}