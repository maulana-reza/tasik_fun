<?php
 defined('BASEPATH') OR exit('No direct script access allowed');
 
 class Documentation_model extends CI_Model {
 	/**
 	 * Default select
 	 */
 	private $select = [
 		'documentation.*',
 		'documentation_image.name as image_name',
 		'documentation_image.description as image_description',
 		'documentation_image.id_documentation_image as image_id'
 	];
 	/**
 	 * Default get all documentation
 	 * @return array
 	 */
 	public function get()
 	{
 		$this->db->select($this->select);
 		$this->db->join('documentation_image', 'documentation_image.documentation_id = documentation.id_documentation','left');
 		$this->db->group_by('documentation.id_documentation');
 		$data = $this->db->get('documentation')->result_array();
 		return $data;
 	}
 	/**
 	 * get documentation by documentation id
 	 * 
 	 * @param string documentation_id
 	 * @return array
 	 */
 	public function get_documentation_by_id_documentation($documentation_id)
 	{
 		$this->db->where('documentation.id_documentation',$documentation_id );
 		$data = $this->get();
 		return $data;
 	}
 	/**
 	 * get documentation image
 	 * 
 	 * @return array
 	 */
 	public function get_documentation_image()
 	{
 		$this->db->join('documentation', 'documentation.id_documentation = documentation_image.documentation_id');
 		$data = $this->db->get('documentation_image')->result_array();
 		return $data;
 	}
 	/**
 	 * get documentation image
 	 * 
 	 * @param string documentation_id
 	 * @return array
 	 */
 	public function get_documentation_image_by_documentation_id($documentation_id)
 	{	
 		$this->db->select($this->select);
 		$this->db->where('documentation_image.documentation_id', $documentation_id);
 		$data = $this->get_documentation_image();
 		return $data;
 	}
 
 }
 
 /* End of file Documentation_model.php */
 /* Location: ./application/modules/admin/models/Documentation_model.php */