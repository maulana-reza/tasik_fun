<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ADMIN_Controller extends AUTH_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->redirect_if_not_login();
        $this->menu_active();
    }

    public function is_login()
    {
        return parent::is_login() && $this->ion_auth->is_admin();
    }

    public function is_not_login()
    {
        return parent::is_not_login() || !$this->ion_auth->is_admin();
    }
    public function menu_active()
    {
        $uri_string = $this->uri->uri_string();
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

}

/* End of file SuperAdminController.php */
/* Location: ./application/core/SuperAdminController.php */