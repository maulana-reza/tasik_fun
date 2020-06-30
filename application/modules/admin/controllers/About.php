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
			'description'	=> $this->input->post('description'),
		];
		if (($url_sosmed = $this->input->post('url_sosmed'))) {
			$id_sosmed  = $this->input->post('id_sosmed');
			$sosmed 	= $this->upload_files_sosmed($_FILES,$id_sosmed,$url_sosmed,'medsos');
			$this->db->insert_batch('social', $sosmed);
		}
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

    /**
     * for upload image with car_id
     * 
     * @param string file
     * @param string id
     * @param string url
     * @param string name
     * @return array : car_id,name
     */
    public function upload_files_sosmed($files,$index_,$url,$name){
 
      $data = array();
      $path = 'assets/sosmed_icon/';

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
          $config['upload_path']        = 'assets/sosmed_icon'; 
          $config
                                  ['allowed_types']      = 'jpg|jpeg|png';
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
                'id'	        	    => $index_[( count($index_) == 1 ? 0 : $index+1 )],
                'url'   		        => $url[( count($index_) == 1 ? 0 : $index+1 )],
                'img'                   => $filename,
                'path'					=> base_url('assets/sosmed_icon'),
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
  /**
   * Builder list social media
   * 
   * @param array list sosial media
   * @return array
   */
  function builder_sosmed($sosmed){
  	foreach ($sosmed as $key => $value) {
  		$html 	= '
				<ul class="list-inline w-100 position-relative border-bottom item" style="height: 120px;">									
					
					<li class=" overflow-hidden list-inline-item float-left w-25 m-0" style="width: 100px;height: 100px; ">											
					<img src="%s" alt="" class="w-100" >
					</li>
					<li class="list-inline-item float-left w-75 pl-2 m-0">
						%s
						<p class="card-text text-cyan">%s</p>
					</li>
					<a href="%s" class="position-absolute m-2 delete" style="top:0;right:0;">
						<i class="fa fa-trash"></i>
					</a>
				</ul>
				';
		$img 	= $value['path']."/".$value['img'];
		$account= $value['id'];
		$text   = $value['url'];
		$delete = site_url('admin/about/delete_sosmed/').$value['id_social'];
		$url 	= anchor($text, strlen($text) > 60 ? substr($text, 0, 60) . '...' : $text, 'attributes');
		$list[]	= sprintf($html,$img,$account,$url,$delete); 
  	}
  	return @$list ? implode("", $list) : false;
  }
  /**
   * delete sosmed
   */
  public function delete_sosmed($sosmed_id)
  {
  	try {
  		$data = $this->db->get_where('social',['id_social' => $sosmed_id])->num_rows();
  		if ($data < 1)
  			throw new Exception("Social media tidak ditemukan", 1);

  		$this->db->delete('social',['id_social' => $sosmed_id]);

        $array[] = [
            'text' => "Berhasil menghapus social media",
            'type' => 'danger' 
        ];
        alert($array);
        redirect('admin/about',"REFRESH");		
        

  	} catch (Exception $e) {
  		
        $array[] = [
            'text' => $e->getMessage(),
            'type' => 'danger' 
        ];
        alert($array);
        redirect('admin/about',"REFRESH");		
  	}
  }
	public function form()
	{
		$abouts 		= $this->db->get('about')->row_array();
		$social 		= $this->db->get('social')->result_array();
		$data['sosmed'] = $this->builder_sosmed($social);
		$data['company_name'] = [
			'name'		=> 'company_name',
			'class'		=> 'form-control',
			'value'		=> @$abouts['company_name'],
		];
		$data['address'] = [
			'name'		=> 'address',
			'class'		=> 'address-text',
			'value'		=> @$abouts['address'],
		];

		$data['description'] = [
			'name'		=> 'description',
			'class'		=> 'address-text',
			'value'		=> @$abouts['description'],
		];
		$data['phone_number'] = [
			'name'		=> 'phone_number',
			'class'		=> 'form-control',
			'value'		=> @$abouts['phone_number'],
		];
		$data['email'] = [
			'name'		=> 'email',
			'class'		=> 'form-control',
			'value'		=> @$abouts['email'],
		];
		$data['medsos'] = [
			'name'		=> 'medsos',
			'class'		=> 'form-control upload',
			'type'		=> 'file'
		];
		$this->addMultipleData($data);
	}

}