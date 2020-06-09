<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MEMBER_Controller extends AUTH_Controller {

    // to except redirect if not login
    private $except_menu = [
        'profile'
    ];
    // user page must verified
    private $verify_page = [
        'sell'
    ];
    // home site if redirect
    public $home = 'profile';
	public function __construct()
    {
        parent::__construct();
        $this->menu_active();
        $this->redirect_if_not_login_member();

    }
    public function redirect_if_not_login_member()
    {
        if ($this->is_not_login()) {

            $link = uri_string();
            if (!in_array($link, $this->except_menu))
                return parent::redirect_if_not_login();

        }
        

    }
    public function is_login()
    {
        // return parent::is_login() && $this->ion_auth->is_member();
        return parent::is_login();
    }
    public function is_not_login()
    {
        // return parent::is_not_login() || !$this->ion_auth->is_member();
        return parent::is_not_login();
    }
    public function menu_active()
    {
        $uri_string = uri_string();
        if (strpos($uri_string, '/' )) {
            $menu=explode('/',$uri_string);
            $menu=$menu[0];
        }else{
            $menu=strtolower($uri_string);
        }
        $menu_active['menu']=[
                $menu => 'active',
        ];
        $this->addMultipleData($menu_active);
    }
    public function redirect_home()
    {
        return redirect($this->home);
    }
    public function is_upgrade()
    {
        $id = $this->get_id();
        $this->load->model('profile/profile_model');
        $verify = $this->profile_model->is_verified($id);
        if (@$verify[0]['prove_id']) {
            return true;
        }else if (@$verify[0]['upgrade_id']) {
            $this->addData('process_upgrade','true');
        }
        return false;
    }

}
/* End of file MEMBER_Controller.php */