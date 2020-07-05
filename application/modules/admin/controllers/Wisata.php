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
		$this->prepare_data();

		$this->render('wisata/wisata');
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
					<div class="card flex-row flex-wrap mb-2 overflow-hidden">
						<div class="card-header border-0 p-0">
							<img src="'.$this->config->item('img_path').'/'.$value['img_tempat'].'" alt="">
						</div>
						<div class="card-block px-2">
							<h4 class="card-title">'.$value['nama_tempat'].'</h4>
							<p class="card-text">'.$value['alamat_tempat'].'</p>
							<a href="'.site_url('admin/wisata/delete/'.$value['kode_tempat_wisata']).'" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
							<a href="'.site_url('admin/wisata/edit/'.$value['kode_tempat_wisata']).'" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></a>
						</div>
						<div class="w-100"></div>
					</div>';
		}
		return @$html ? implode("", $html) : false;
	}
	public function edit($kode_wisata = 0){
		$this->submit_edit();
		$this->addData('page_title',"Tambah Tempat Wisata");
		$this->addData('btn_back','admin/wisata/');

		$this->db->where('kode_tempat_wisata',$kode_wisata);
		$data = $this->db->get('tempat_wisata')->result_array();
		if(@!$data[0]){

			$array[] = [
				'text' => 'kode wisata tidak ditemukan',
				'type' => 'danger'
			];
			alert($array);
			redirect('admin/wisata/',"REFRESH");
		}
		$this->prepare_form_edit($data[0]);
		$this->render('wisata/edit');

	}

	public function prepare_form_edit($wisata)
	{
		$data['kode'] = [
			'type'			=> 'text',
			'name'			=> 'kode',
			'class'			=> 'form-control',
            'required'		=> true,
			'readonly'		=> true,
			'value'			=> $wisata['kode_tempat_wisata'],
		];
		$data['title'] = [
			'type'			=> 'text',
			'name'			=> 'title',
			'class'			=> 'form-control',
			'required'		=> true,
			'value'			=> $wisata['nama_tempat'],
		];

		$data['address'] = [
			'type'			=> 'text',
			'name'			=> 'address',
			'class'			=> 'form-control',
			'required'		=> true,
			'value'			=> $wisata['alamat_tempat'],
		];

		$data['file'] = [
			'type'			=> 'file',
			'name'			=> 'file',
			'class'			=> 'form-control',
		];

		$this->addMultipleData($data);
	}

	public function add()
	{
		$this->addData('btn_back','admin/wisata');
		$this->submit();
		$this->prepare_form();
		$this->render('wisata/add');
	}

	public function prepare_form()
	{
		$this->db->order_by('kode_tempat_wisata','desc');
		$id 	 = $this->db->get('tempat_wisata', 1)->row_array();
		$id 	 = @$id['kode_tempat_wisata'] ?  (int) filter_var($id['kode_tempat_wisata'], FILTER_SANITIZE_NUMBER_INT) + 1 : 1;

		$data['kode'] = [
			'type'			=> 'text',
			'name'			=> 'kode',
			'class'			=> 'form-control',
			'required'		=> true,
			'readonly'		=> true,
			'value'			=> 'CBCSY'.str_pad($id ,3, "0", STR_PAD_LEFT),
		];
		$data['title'] = [
			'type'			=> 'text',
			'name'			=> 'title',
			'class'			=> 'form-control',
			'required'		=> true,
			'value'			=> $this->form_validation->set_value('title'),
		];

		$data['address'] = [
			'type'			=> 'text',
			'name'			=> 'address',
			'class'			=> 'form-control',
			'required'		=> true,
			'value'			=> $this->form_validation->set_value('address'),
		];

		$data['file'] = [
			'type'			=> 'file',
			'name'			=> 'file',
			'class'			=> 'form-control',
			'required'		=> true,
		];
		$this->addMultipleData($data);
	}
	public function submit_edit(){
		if($this->input->post('submit') != "submit"){
			return false;
		}
		if(@empty($_FILES['file']['name'])){
			$data = [
				'nama_tempat' 	=> $this->input->post('title'),
            	'alamat_tempat' => $this->input->post('address'),
			];
		}else{
			$data = $this->upload_image_wisata($this->input->post(),'file');
		}
		var_dump($data);
		$this->db->where('kode_tempat_wisata',$this->input->post('kode'));
		$this->db->update('tempat_wisata',$data);
		$array[] = [
			'text' => 'Tempat Wisata berhasil diubah',
			'type' => 'success'
		];
		alert($array);
		redirect('admin/wisata',"REFRESH");

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
    public function upload_image_wisata($array,$name){
 
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

            // Initialize array
            $data= [
                'kode_tempat_wisata'    => $array['kode'],
                'nama_tempat'           => $array['title'],
                'alamat_tempat'         => $array['address'],
                'img_tempat'			=> $filename,
            ];
            
          }else{

            $array[] = [
                'text' => $this->upload->display_errors(),
                'type' => 'danger'
            ];
            alert($array);
            redirect(uri_string(),"REFRESH");
          }
	      return @$data ? $data : false;
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
		$this->form_validation->set_rules('title', 'Judul', 'trim|required');
		if ( $this->form_validation->run() == TRUE ) {
			$type 	 = "success";
			$message = "Tempat Wisata Berhasil ditambahkan";
			$insert  = $this->upload_image_wisata($this->input->post(),'file');
			$this->db->insert('tempat_wisata', $insert);
		}else{
			$type    =  'danger';
			$message =  validation_errors();
		}
		$array[] = [
			'text' => $message,
			'type' => $type,
		];
		alert($array);
   		redirect('admin/wisata','refresh');

	}
	function delete($kode = 0){
		$this->db->where('kode_tempat_wisata',$kode);
		$data = $this->db->get('tempat_wisata')->num_rows();
		if($data < 1){
			$array[] = [
				'text' => 'Kode Tempat Wisata Tidak ditemukan',
				'type' => 'danger',
			];
			
			alert($array);
			redirect('admin/wisata','refresh');
		}
		$this->db->delete('tempat_wisata',['kode_tempat_wisata'=> $kode]);

		$array[] = [
			'text' => 'Tempat Wisata berhasil dihapus',
			'type' => 'success',
		];

		alert($array);
		redirect('admin/wisata','refresh');
	}

}

/* End of file Wisata.php */
/* Location: ./application/modules/admin/controllers/Wisata.php */ ?>
