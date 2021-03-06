<?php
/**
 * Created by PhpStorm.
 * User: tik_squad
 * Date: 3/19/19
 * Time: 7:08 AM
 */
class MY_Controller extends CI_Controller
{
    protected $datas = array();
    protected $redirect_login='admin';
    protected $redirect_not_login='auth';
    protected $redirect_admin='admin';
    protected $groups=array();
    protected static $template_default;
    // default
    protected $except_btn_back = [
        'profile',
        'bid',
        'content',
        'content/search',
    ];
    protected $except_btn_bottom_menu = [
        'profile/complete',
        'sell',
        'sell/add',
        'content/view',
        'content/search',
    ];

    /**
     * @return mixed
     */
    public static function getTemplateDefault()
    {
        return self::$template_default;
    }

    /**
     * @param mixed $template_default
     */
    public static function setTemplateDefault($template_default)
    {

        self::$template_default = $template_default;
    }

    public function __construct()
    {
        parent::__construct();
        
        $this->setDatas(array());
        $this->load->config('ion_auth');
        $this->menu_active();
        // $this->setting();
        // $this->redirect_login=$this->config->item('redirect_login', 'ion_auth');
        // $this->redirect_not_login=$this->config->item('redirect_not_login', 'ion_auth');

        if (!self::getTemplateDefault()) self::setTemplateDefault(getenv('DEFAULT_TEMPLATE'));
    }
    /**
    * @param array $array
        example : 
        $this->set_tool(['btn_bottom_menu'=> uri_string()]);
        $array = [
            'btn_back' => [URI],
            'btn_bottm_menu' => [URI]
        ];
        explain : to except site from button back and bottom menu
    */
    public function set_tool($array = array())
    {
        $uri = uri_string();
        $btn_back = $this->except_btn_back;
        $btn_bottom_menu = $this->except_btn_bottom_menu;
        if (@$array['btn_back']) {
            $btn_back = [@$array['btn_back']];
        }

        if (@$array['btn_bottom_menu']) {
            $btn_bottom_menu = [@$array['btn_bottom_menu']];
        }

        if (in_array($uri, $btn_back)) {
            $this->addData('btn_back',true);
        }
        if (in_array($uri, $btn_bottom_menu)) {
            $this->addData('btn_bottom_menu',true);
        }
    }
    /**
     * View it 
     * 
     * @param no param
     * @return mixed 
     */
    public function render($view_name=FALSE, $template=FALSE, $return=FALSE) {
        $this->set_tool();
        $this->get_about();
        if (is_null($template)) return $this->load->view($view_name, $this->getDatas(), $return);
        if (!$template) $template = self::$template_default;
        if (strpos($template, '/') !== false) {
            $template_location = $template;
        } else {
            $template_location = "templates/$template/$template";
        }
        if ($view_name) {
            $this->addData('content', $this->load->view($view_name, $this->getDatas(), true));
        }
        return $this->load->view($template_location, $this->getDatas(), $return);
    }

    /**
     * Check if login 
     * 
     * @param no param
     * @return mixed 
     */
    public function is_login() {
        return $this->ion_auth->logged_in();
    }

    /**
     * Check if not login 
     * 
     * @param no param
     * @return mixed 
     */
    public function is_not_login() {
        return !$this->is_login();
    }

    public function redirect_if_login() {
        $login = $this->is_login();
        if ($login) {
            return redirect($this->redirect_login);
        }
    }

    /**
     * redirect admin 
     * 
     * @param no param
     * @return mixed 
     */
    public function redirect_admin()
    {
        $admin = $this->ion_auth->is_admin();
        if ($admin) {
            return redirect($this->redirect_admin);
        }
    }

    /**
     * redirect if has login admin 
     * 
     * @param no param
     * @return mixed 
     */
    public function redirect_if_admin() {
        $login = $this->is_login();
        if ($login) {
            return redirect($this->redirect_login);
        }
    }
    /**
     * redirect if user not login 
     * 
     * @param no param
     * @return mixed 
     */
    public function redirect_if_not_login() {
        $not_login = $this->is_not_login();
        if ($not_login) {
            if (uri_string() != $this->redirect_not_login) {
                return redirect($this->redirect_not_login);
            }
        }
    }
    /**
     * Convert to json and view it
     * 
     * @param mixed
     * @return no return 
     */
    public function _json($datas) {
        header("Content-Type:application/json");
        echo json_encode($datas);
        die();
    }

    /**
     * @return array
     */
    public function getDatas()
    {
        return $this->datas;
    }
    /**
     * @param $key
     * @return array
     */
    public function getData($key)
    {
        return @$this->datas[$key];
    }

    /**
     * @param array $datas
     */
    public function setDatas($datas)
    {
        $this->datas = $datas;
    }
    /**
     * @param mixed $key
     * @param mixed $data
     */
    public function addData($key, $data)
    {
        $this->datas[$key] = $data;
    }
    /**
     * @param array $datas
     */
    public function addMultipleData($datas)
    {
        foreach ($datas as $key => $data) {
            $this->datas[$key] = $data;
        }
    }
    /**
     * @param mixed $key
     * @return boolean
     */
    public function hasData($key)
    {
        return array_key_exists($key, $this->datas);
    }
    /**
     * @param mixed $key
     */
    public function removeData($key)
    {
        unset($this->datas[$key]);
    }

    public function addGroup($data) {
        if (is_array($data)) {
            $this->groups = array_merge($this->groups, $data);
        } else {
            $this->groups[] = $data;
        }
    }
    /**
     * Get and set menu from string and set value
     * 
     * @param no param
     * @return no return 
     */
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
    /**
     * Get all device token admin
     * 
     * @param no param 
     * @return array
     */
    public function get_device_token_admin()
    {
        $this->db->select('auth.device_token');
        $this->db->where('groups.name', $this->config->item('admin_group','ion_auth'));
        $this->db->join('users_groups', 'users_groups.user_id = users.id');
        $this->db->join('auth', 'auth.user_id = users.id');
        $this->db->join('groups', 'groups.id = users_groups.group_id');
        $data = $this->db->get('users')->result_array();
        $data = array_column($data, 'device_token');
        return $data;

    }
    public function get_about()
    {
        $data = $this->db->get('about')->row_array();
        $this->session->set_userdata( $data );
    }

}
