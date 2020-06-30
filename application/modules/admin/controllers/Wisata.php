<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Wisata extends ADMIN_Controller {

	public function __construct()
	{
		parent::__construct();

	}
	public function index()
	{
		$this->addData('page_title','Tempat Wisata');
		$this->render('wisata/wisata');
		$this->prepare_data();
	}
	private function prepare_data()
	{
		$data = $this->db->get('tempat_wisata')->result_array();
		$add['wisata'] = $this->builder_list($data);
		$this->addMultipleData($add);
	}
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
	public function builder_list($wisata)
	{
		
		if (!is_array($wisata)) {
			return false;
		}
		foreach ($wisata as $key => $value) {

			$html[] = '
					<div class="card flex-row flex-wrap">
						<div class="card-header border-0">
							<img src="'.base_url('assets/uploads/'.$value['image']).'" alt="">
						</div>
						<div class="card-block px-2">
							<h4 class="card-title">Title</h4>
							<p class="card-text">Description</p>
							<a href="#" class="btn btn-primary"><i class="fa fa-trash"></i></a>
						</div>
						<div class="w-100"></div>
						<div class="card-footer w-100 text-muted">
							FOOTER
						</div>
					</div>';
		}
		return @$html ? implode("", $html) : false;
	}
	public function add()
	{

		$this->prepare_form();
		$this->render('wisata/add');
	}

	public function prepare_form()
	{
		$data['title'] = [
			'type'			=> 'text',
			'name'			=> 'title',
			'class'			=> 'form-control',
			'required'		=> true,
		];

		$data['address'] = [
			'type'			=> 'text',
			'name'			=> 'address',
			'class'			=> 'form-control',
			'required'		=> true,
		];

		$data['file'] = [
			'name'			=> 'file[]',
			'class'			=> 'form-control',
			'required'		=> true,
		];
		$this->addMultipleData($data);
	}

	/**
	 * upload file
	 *
	 * @param MULTIPLE FILE
	 * @param array  all index file
	 * @param string name file
	 * @param string|int
	 *  
	 * @return array
	 */
    public function upload_image($files,$index_,$name,$wisata_id = false){
 
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
                'kode_article'          => @$document_id,
                'name'                  => $filename,
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
      return @$data : $data ? false;
  }
  /**
   * Update function
   * @param string wisata_id
   * @return no return 
   */
  public function update($wisata_id = false)
  {
  	if (!$wisata_id) {

		$array[] = [
			'text' => 'Tempat Wisata tidak ditemukan',
			'type' => 'danger'
		];
		alert($array);
  		redirect('wisata/update','refresh');
  	}
  }

	public function submit()
	{
		if ($this->input->post('submit') != "submit") {
			return false;
		}
		$wisata = [
			'kode_tempat'	=> $this->input->post('kode_tempat'),
			'name' 			=> $this->input->post('name'),
			'image'			=> $this->input->post('address')
		];
	}

}

/* End of file Wisata.php */
/* Location: ./application/modules/admin/controllers/Wisata.php */ ?>