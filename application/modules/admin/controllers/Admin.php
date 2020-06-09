<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends ADMIN_Controller {
	public function __construct()
	{
		parent::__construct();	
		$this->addData("page_title",strtoupper("DASHBOARD"));
		$this->set_tool(['btn_bottom_menu'=> uri_string()]);
	}
	public function index()
	{
		// $this->db->having('payment.is_publish >',0);
		// $this->db->select('payment.is_publish');
		// $count['cars'] = count($this->content_model->get_cars());
		// $this->addData('count',$count);
		// $this->addData('prev_uri',site_url('profile'));
		// $this->get_chart();
		$this->render('dashboard');
	}
	public function profile($user_id)
	{

		// page title
		$this->addData("page_title",strtoupper( lang_line('l_menu_profile','label_input')));

		$this->get_complete_information($user_id);
		$this->render('profile/profile');
	}
	public function get_chart()
	{
		selected_payment_chart();
		$this->load->model('content_model');

		$this->db->having('payment.is_publish >',0);
		$this->db->select('payment.is_publish');
		$brand = $this->content_model->chart_category();
		foreach ($brand as $key => $value) {
			$chart[] =[
				'name' 	=> $value['name'],
				'y'		=> (int)$value['y']
			]; 
		}
		$data['brand_chart'] = @$chart ? $chart : "" ;
		unset($chart);

		$this->db->having('payment.is_publish >',0);
		$this->db->select('payment.is_publish');
		$model = $this->content_model->chart_model();
		foreach ($model as $key => $value) {
			$chart[] =[
				'name' 	=> $value['name'],
				'y'		=> (int)$value['y']
			]; 
		}
		
		$data['model_chart'] = @$chart ? $chart : "" ;
		if ($_SESSION['chart_sold_out'] == "" || $_SESSION['chart_sold_out'] == "brand") {
			$sold_out = $this->content_model->chart_sold_out_by_brand();
		}else{
			$sold_out = $this->content_model->chart_sold_out_by_model();

		}
		
		$year_later 	= new Datetime();
		$year_later->modify('-12 month');
		$month 			= $this->month($year_later->format('Y-m-d'));
		$arr 			= array_column($sold_out, 'brand_name');
		$uniques 		= array_unique($arr);
		$duplicates 	= array_diff_assoc($arr, array_unique($arr));
		$inc 			= 0;
		$new_month 		= $month['data'];

		foreach ($uniques as $unique_key => $unique_value) {
			// set value sum 	chart
			$sum 			= 0;
			$month['data'] 	= $new_month;
			// if exist array
			$var[$inc]=[
				'name'	=> $sold_out[$unique_key]['brand_name'],
				'data'	=> $month['data'],
			];
			// get date
			$date = date('Y-m',strtotime($sold_out[$unique_key]['date_sold']));
			$month_data = array_keys(preg_grep('~'.$date.'~', $month['month']));
			// set data
			if (@$month_data[0]){
				$var[$inc]['data'][$month_data[0]]=(int)$sold_out[$unique_key]['sum'];
				$sum += $var[$inc]['data'][$month_data[0]];
			}
			// if duplicate exist
			if (is_array($duplicate = array_keys($duplicates,$unique_value))) {
				foreach ($duplicate as $duplicate_key => $duplicate_value) {
					// get date
					$date 		= date('Y-m',strtotime($sold_out[$duplicate_key]['date_sold']));
					$month_data = array_keys(preg_grep('~'.$date.'~', $month['month']));

					// set data
					$var[$inc]['data'][$month_data[0]]=(int)$sold_out[$duplicate_key]['sum'];
					$sum 		+= $var[$inc]['data'][$month_data[0]];

				}

			}
			// add sum on name
			$var[$inc]['name'] .= " : ".(string)$sum;
			$inc++;
		}
		if (@$var[0]) {
			# code...
		$data['payment']=[
			'month' => $month["month"],
			'data'	=> $var,
		];
		}
		$this->addData('chart',$data);
		
	}
	function array_merge_recursive_ex(array $array1, array $array2)
{
    $merged = $array1;

    foreach ($array2 as $key => & $value) {
        if (is_array($value) && isset($merged[$key]) && is_array($merged[$key])) {
            $merged[$key] = $this->array_merge_recursive_ex($merged[$key], $value);
        } else {
            $merged[$key] = ($value != 0 ? $value : $merged[$key] );
        }
    }
    return $merged;
}
	
	public function get_complete_information($user_id)
	{
		$this->load->model('profile/profile_model');
		$data = $this->profile_model->get_user_by_id($user_id);
		if (is_array(@$data[0]))
		{

			$data[0]['address']=$data[0]['province'].', '.$data[0]['regency'].', '.$data[0]['district'].', '.$data[0]['village'];
			$this->addMultipleData($data[0]);
			return $data[0];

		}
	}
	
	/**
	 *  @param string (date)
	 * 	@return array
	 *
	 */
	public function month($str = "2018-10-11")
	{
		$timestamp 	= strtotime($str);
		$month 		= date("m",$timestamp); 
		$year 		= date("Y",$timestamp); 
		$end_month  = date("m");
		$end_year  	= date("Y");

		while(true)
		 {


		 	$month += 1;
		 	if ($month > 12){
		 		$year +=1;
		 		$month =1;
		 	}

		 	$all["month"][] = $year."-".($month > 9 ? $month :"0".$month);
		 	$all["data"][]=0;
		 	if ($month == $end_month && $year == $end_year) {
		 		 break;
		 	}
		 }
		 return $all;
	}
	/**
	 * @param no param
	 */
	public function chart_sold_out()
	{
		$chart['chart_sold_out'] = $this->input->post('chart');
	}
}

/* End of file Admin.php */
/* Location: ./application/modules/admin/controllers/Admin.php */