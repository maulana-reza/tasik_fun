<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dokumentasi extends ADMIN_Controller {
	public function __construct()
	{
		parent::__construct();	
		$this->addData("page_title",strtoupper("Dokumentasi"));
		$this->addData('page_sub_title','Tambah data dokumentasi lapangan');
		$this->load->model('documentation_model');
		$this->addData('btn_back','admin/dokumentasi');


	}
	public function index()
	{
		$this->addData('btn_back','admin');
		$this->prepare_data();
		$this->render('dokumentasi/dokumentasi');
	}
	/**
	 * Prepare Data
	 * 
	 * @param no param
	 * @return no return
	 */
	public function prepare_data()
	{
		$dokumentasi 	= $this->documentation_model->get();
		$data['list']	= $this->builder_list($dokumentasi);
		$this->addMultipleData($data);
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
		$documentation = [
			'title'			=> $this->input->post('title'),
			'description'	=> $this->input->post('description'),
			'users_id'		=> $this->get_id(),
			'date_edit'		=> date('Y-m-d H:i:s'),
		];
		$this->db->where('documentation.id_documentation', $documentation_id);
		$this->db->update('documentation', $documentation);

		$images 			= $this->upload_files($_FILES,$this->input->post('desc'),'image',$documentation_id);
		// insert
		if ($images) {
			$this->db->insert_batch('documentation_image', $images);
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

		$dokumentasi 	= $this->documentation_model->get_documentation_by_id_documentation($documentation_id);
		if (@!$dokumentasi[0]) {
			$array[] = [
				'text' => 'Dokumentasi tidak ditemukan',
				'type' => 'danger' 
			];
			alert($array);
			redirect('admin/dokumentasi','refresh');
		}
		$images  		= $this->documentation_model->get_documentation_image_by_documentation_id($documentation_id);
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
	public function builder_image($documentation_image)
	{
		foreach ($documentation_image as $key => $value) {
			$temp 	= '<div class="card delete-image p-3 waves-effect text-center shadow ml-0 mb-0 position-relative overflow-hidden" style="height: 15em;">
						<img src="%s" alt="gambar-dokumentasi" class="position-absolute h-100" style="left:0; right:0;top:0;bottom:0;">
						%s
						</div>';
			$image  = base_url('assets/uploads/'.$value['image_name']);
			$delete = anchor(site_url('admin/dokumentasi/delete_image/'.$value['image_id'].'/'.$value['id_documentation']), ' <i class="fa fa-trash fa-2x"></i>','class=" cover-card m-3 " style="position:absolute; top:0;right:0;bottom:0;"');
			$result[]= sprintf($temp,$image,$delete);
		}
		return @$result ? implode("", $result) : false ;
	}
	public function is_your_responsibility()
	{
		$data = $this->documentation_model->get_documentation_image();
		if ($data[0]) {
			return true;
		}
		return false;

	}
	public function delete_image($image_id='',$documentation_id)
	{

		$this->db->where('documentation_image.id_documentation_image', $image_id);
		$this->db->where('documentation.users_id', $this->get_id());
		if (!$this->is_your_responsibility()) {
			$array[] = [
				'text' => 'Gambar tidak ditemukan',
				'type' => 'danger' 
			];
			alert($array);
			redirect('admin/dokumentasi','refresh');
		}
		$this->db->delete('documentation_image',['id_documentation_image'=> $image_id]);
		$array[] = [
				'text' => 'Gambar berhasil dihapus',
				'type' => 'success' 
			];
		alert($array);
		redirect('admin/dokumentasi/edit/'.$documentation_id,'refresh');

	}

	public function delete($documentation_id)
	{

		$this->db->where('documentation.id_documentation', $documentation_id);
		$this->db->where('documentation.users_id', $this->get_id());
		if (!$this->is_your_responsibility()) {
			$array[] = [
				'text' => 'Dokumentasi tidak ditemukan',
				'type' => 'danger' 
			];
			alert($array);
			redirect('admin/dokumentasi','refresh');
		}
		$this->db->delete('documentation',['id_documentation'=> $documentation_id]);
		$this->db->delete('documentation_image',['documentation_id'=> $documentation_id]);
		$array[] = [
				'text' => 'Dokumentasi berhasil dihapus',
				'type' => 'success' 
			];
		alert($array);
		redirect('admin/dokumentasi/','refresh');

	}
	/**
	 * Builder list dokumentasi
	 * 
	 * @param no param
	 * @return no return
	 */
	private function builder_list($data){
		foreach ($data as $key => $value) {
			$text  		= $value['description'];
			$text 		= strlen($text) > 60 ? substr($text, 0, 60) . '...' : $text;
			$date 		= convert_date($value['date_create']);
			
			$temp 		= '
			<div class="card p-3 waves-effect text-center shadow ml-0 mb-3 position-relative overflow-hidden" style="height: 15em;">
			<img src="'.base_url() .'/assets/uploads/'.$value['image_name'].'" alt="gambar-dokumentasi" class="position-absolute h-100" style="left:0; right:0;top:0;bottom:0;">
			<div class="position-relative cover-card h-100 w-100 text-white bg-dark text-left p-2" style="left:0; right:0;top:0;bottom:0;">
					<div class="label">
					'.$value['title'].'
						<p class="position-absolute m-2" style="top:0;right: 0;"> %s </p>
					</div>
						<p class="text-sm mb-1"><i class="fa fa-clock"></i>  '.$date.'</p>
					<div class="description card-text">
						'.$text.'
					</div>
			</div>
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
	 * Page add data dokumentasi
	 * 
	 * @param no param
	 * @return no return
	 */
	public function add()
	{
		$this->submit();
		$this->form_add();
		$this->render('dokumentasi/add');
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

		$this->form_validation->set_rules('title', 'Judul', 'trim|required|is_unique[documentation.title]');
		$this->form_validation->set_rules('description', 'Deskripsi', 'trim|required');
		if ($this->form_validation->run() === FALSE) {

			$array[] = [
				'text' => validation_errors() ,
				'type' => 'warning' 
			];
			alert($array);
			return false;
		}
		$documentation = [
			'title'			=> $this->input->post('title'),
			'description'	=> $this->input->post('description'),
			'users_id'		=> $this->get_id(),
		];
		$this->db->insert('documentation', $documentation);
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
		$this->db->insert_batch('documentation_image', $images);

		$array[] = [
			'text' => 'Berhasil Menambahkan data dokumentasi',
			'type' => 'success' 
		];
		alert($array);

	}
	

}