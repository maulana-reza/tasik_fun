<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends API_Controller {
	/**
	 * 
	 * @param array['authorization','device_token']
	 * @return array['device_token']
	 * 
	 */
	public function device_token_post()
	{
		try {
			if (($user = $this->verification())) {
			
				$token = [
					'device_token' => $this->post('device_token')
				];
				$if = $this->db->get_where('auth',['user_id'=> $user->id])->num_rows();
				if ($if) {
					$this->db
					->where('user_id',$user->id)
					->update('auth', $token);

					$this->response([
					"status" => true,
					"message"=>'device token succesfully update',
					"device_token" => $token['device_token']],REST_Controller::HTTP_OK);
				}
				
			
			}
				$this->response([
					"status" => false,
					"message"=>'Not have access'],REST_Controller::HTTP_UNAUTHORIZED);


		} catch (Exception $e) {
			$this->response($e->getMessage(),REST_Controller::HTTP_BAD_REQUEST);
		}
	}
	/**
	 * 
	 * @param no param
	 * @return array['status','message']
	 * 
	 */
	public function logout_post()
	{
		try {

			$this->lang->load('alert');
			$this->ion_auth->logout();
			$this->response([
				'message'=> $this->lang->line('logout_success'),
			],REST_Controller::HTTP_OK);

		} catch (Exception $e) {
			$this->response($e->getMessage(),REST_Controller::HTTP_BAD_REQUEST);
		}
	}

}
/* End of file Api.php */
/* Location: ./application/controllers/Api.php */