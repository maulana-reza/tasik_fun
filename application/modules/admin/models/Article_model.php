<?php
 defined('BASEPATH') OR exit('No direct script access allowed');
 
 class Article_model extends CI_Model {
 	/**
 	 * Default select
 	 */
 	private $select = [
 		'article.*',
 		'article_image.name as image_name',
 		'article_image.id_article_image as image_id',
 	];
 	/**
 	 * Default get all article
 	 * @return array
 	 */
 	public function get()
 	{
 		
 		$this->db->select($this->select);
 		$this->db->join('article_image', 'article_image.kode_article = article.kode_article','left');
 		$this->db->group_by('article.kode_article');
 		$this->db->order_by('article.kode_article', 'asc');
 		$data = $this->db->get('article')->result_array();
 		return $data;
 	}
 	/**
 	 * get article by article id
 	 * 
 	 * @param string article_id
 	 * @return array
 	 */
 	public function get_article_by_id_article($article_id)
 	{
 		$this->db->where('article.kode_article',$article_id );
 		$data = $this->get();
 		return $data;
 	}
 	/**
 	 * get article image
 	 * 
 	 * @return array
 	 */
 	public function get_article_image()
 	{
 		$this->db->join('article', 'article.kode_article = article_image.article_id');
 		$data = $this->db->get('article_image')->result_array();
 		return $data;
 	}
 	/**
 	 * get article image
 	 * 
 	 * @param string article_id
 	 * @return array
 	 */
 	public function get_article_image_by_article_id($article_id)
 	{	
 		$this->db->select($this->select);
 		$this->db->where('article_image.article_id', $article_id);
 		$data = $this->get_article_image();
 		return $data;
 	}
 
 }
 
 /* End of file article_model.php */
 /* Location: ./application/modules/admin/models/article_model.php */