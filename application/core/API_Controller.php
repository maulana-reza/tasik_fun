<?php defined('BASEPATH') OR exit('No direct script access allowed');

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
/** @noinspection PhpIncludeInspection */
require_once APPPATH . '/libraries/REST_Controller.php';
require_once APPPATH . '/libraries/JWT.php';
require_once APPPATH . '/libraries/BeforeValidException.php';
require_once APPPATH . '/libraries/ExpiredException.php';
require_once APPPATH . '/libraries/SignatureInvalidException.php';
use \Firebase\JWT\JWT;


class API_Controller extends REST_Controller
{
	private $user_credential;
    public function verification()
    {
        try {
        //JWT Auth middleware
        
        $token = preg_replace('/\s+/', '',$this->post('authorization'));
        $kunci = $this->config->item('secret_key'); //secret key for encode and decode
        // search
        $data = $this->db->get_where('auth',['token' => $token]);
        
        if (!$data->num_rows()) {
            $this->response([
                "status"=>false,
                "messge"=>"token not valid"],401);
        }

           $decoded = JWT::decode($token, $kunci, array('HS256'));
           $this->user_data = $decoded;
           return $decoded;
        } catch (Exception $e) {
            $invalid = ['status' => $e->getMessage()]; //Respon if credential invalid
            $this->response($invalid, 401);//401
        }
    }
    // method untuk melihat token pada user
    public function generate($var=NULL){
        $date = new DateTime();
        $cek = $this->ion_auth->login($this->post('identity',TRUE),$this->post('password',TRUE),false);
             
        if ($cek) {

                $payload['id'] = $_SESSION['user_id'];
                $payload["username"] = $this->post('identity');
                $payload['iat'] = $date->getTimestamp(); //waktu di buat
                $payload['exp'] = $date->getTimestamp() + (3600*24*360); //satu jam
                $output['token'] = JWT::encode($payload,$this->config->item('secret_key'));

                $insert=[
                    'user_id'=>$payload['id'],
                    'token' => $output['token'],
                ];  

                $cek=$this->db->get_where('auth',['user_id'=> $payload['id']])->num_rows();
                
                if ($cek) {
                    $this->db
                    ->where('user_id',$payload['id'])
                    ->update('auth', $insert);
                }else{
                    $this->db->insert('auth', $insert);
                }
                return $output;
        
        }

            $this->viewtokenfail($username);

    }
}