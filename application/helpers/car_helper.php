<?php
/**
* @param string $brand_id
* @return string 
	
	example :
	select_brand($brand_id);
	
	explain : 
	$brand_id = selected brand 	
*/
function select_brand($brand_id = FALSE)
{
	$ci =& get_instance();

	$select = '<select name="brand_id" class="browser-default custom-select mb-4 form-control border-0 border-bottom ">
	<option >...</option>';
	$brand = $ci->db->get('brand')->result_array();
	foreach ($brand as $key => $value) {

		$selected = ($brand_id == $value['id_brand'] ? 'selected="true"' : '');
		$select.='<option value="'.$value['id_brand'].'" '.$selected.'>'. ucfirst(strtolower( $value['name'])).'</option>';
		
	}
	$select .= '</select>';
	return $select;

}
/**
* @param string $brand_id
* @return string 
	
	example :
	select_brand($brand_id);
	
	explain : 
	$brand_id = selected brand 	
*/
function select_category($category_id = FALSE)
{
	$ci =& get_instance();

	$select = '<select name="category_id" class="browser-default custom-select mb-4 form-control border-0 border-bottom ">
	<option >...</option>';
	$brand = $ci->db->get('category')->result_array();
	foreach ($brand as $key => $value) {

		$selected = ($brand_id == $value['id_category'] ? 'selected="true"' : '');
		$select.='<option value="'.$value['id_category'].'" '.$selected.'>'. ucfirst(strtolower( $value['name'])).'</option>';
		
	}
	$select .= '</select>';
	return $select;

}

/**
* @param string $model_id
* @return string 
	
	example :
	select_model($model_id);
	
	explain : 
	$model_id = selected model 	
*/
function select_model($model_id = FALSE)
{
	$ci =& get_instance();

	$select = '<select name="model_id" class="browser-default custom-select mb-4 form-control border-0 border-bottom ">
	<option >...</option>';
	$model = $ci->db->get('car_model')->result_array();
	foreach ($model as $key => $value) {

		$selected = ($model_id == $value['id_car_model'] ? 'selected="true"' : '');
		$select.='<option value="'.$value['id_car_model'].'" '.$selected.'>'. ucfirst(strtolower( $value['name'])).'</option>';
		
	}
	$select .= '</select>';
	return $select;

}

/**
* @param string $condition
* @return string 
	
	example :
	select_condition($condition);
	
	explain : 
	$condition = 1 / 0
	0 = new
	1 = ex

*/
function select_condition($condition)
{
	$array = ['new','ex'];
	$select = '<select  name="condition" class="browser-default custom-select mb-4 form-control border-0 border-bottom ">';

	foreach ($array as $key => $value) {
		$selected = ($condition == $key ? 'selected="true"' : '');
		$select .= '<option value="'.$key.'">'.$value.'</option>';
	}

	$select .= "</select>";
	return $select;

}
function view_condition($id)
{
	if ($id == 1) {
		$data = "ex";
	}else{
		$data = "new";
	}
	return $data;
}

/**
* @param string $destiny_number
* @return string 
	
	example :
	whatsapp($number);
	
	explain : 
	$number = 0866666666666

*/
function whatsapp($destiny_number)
{
	$ci =& get_instance();
	return $ci->config->item('whatsapp_number').$destiny_number.$ci->config->item('whatsapp_mess');
}

/**
* @param int $n , int $precision
* @return string 
	
	example :
	short_rupiah($number);
	
	explain : 
	$number = 10000000000

*/
function short_rupiah($n, $precision = 1) {
	$n = (int)$n;
    if ($n < 1000000) {
        // Anything less than a million
        $n_format = number_format($n);
    } else if ($n < 1000000000) {
        // Anything less than a billion
        $n_format = number_format($n / 1000000, $precision) . 'JT';
    } else {
        // At least a billion
        $n_format = number_format($n / 1000000000, $precision) . 'M';
    }

    return $n_format;
}
function report_list()
{
	$list = [
		"image doesn't match",
		"price too cheap",
		 ];
	$html = "";
	foreach ($list as $key => $value) {
		$html .='<div class="form-check mb-4">
                <input type="checkbox" class="form-check-input" id="report-'.$key.'" name="report[]" value="'.$value.'">
                <label class="form-check-label" for="report-'.$key.'">'.$value.'</label>
            </div>';
	}
	return $html;
}
/**
 * @param string,string
 * @return string
 * 
 */
function lang_line($line,$file)
{
	$ci =& get_instance();
	$lang = $ci->session->userdata('language');
	$ci->lang->load($file,$lang);
	$data = $ci->lang->line($line);
	return $data;
}
function select_unit($selected='')
{
	$unit = [
		'day',
		'week',
		'month',
		'year'
	];
	$select = "<select name='unit' class='browser-default custom-select mb-4 form-control border-0 border-bottom'>";
	foreach ($unit as $key => $value) {

		$select .= "<option value='".$value."'>".$value."</option>";

	}
	$select .="</select>";
	return $select;
}

function get_language($value='')
{
	$arr = [
		'indonesia',
		'english',
	];
	return $arr;
}

/**
 * GET remaining time
 * 
 * @param string date (Y-m-d);
 * @return mixed 
 */
function remaining_time($date)
{
	$now = date_create(date('Y-m-d'));
	$last = date_create($date);
	if ($now > $last) {
		return false;
	}
	$interval = date_diff($now, $last);
	return $interval->format('%R%a days');
}
/**
 * SELECT LANG
 * @param string
 * @return string
 * 
 */
 function select_lang($lang)
 {
 	$arr = get_language();
 	$option = "";
 	foreach ($arr as $key => $value) {
 		$option .= '
			<label class=" card">
					<input type="radio" name="language" class="card-input-element d-none" id="demo1" value="'.$value.'">
					<div class=" card-body d-flex flex-row justify-content-between align-items-center" >
						'.$value.'
					</div>
				</label>';
 	}
 	return $option;

 }
 /**
  * prepare option payment chart
  * 
  * @param string
  * @return string
  * 
  */
 function get_payment_chart()
 {
 	$arr = ['model','brand'];
 	return $arr;

 }
 /**
  * SELECT CHART 
  * @param string
  * @return string
  */
 function select_payment_chart($chart = false)
 {
 	$arr = get_payment_chart();

 	$select = '<select  name="chart_payment" class="browser-default card shadow  custom-select mb-4 form-control border-0 border-0 " onchange="select_chart_payment(event,this)">';
	foreach ($arr as $key => $value) {
		$selected = (selected_payment_chart() == $value ? 'selected="true"' : '');
		$select .= '<option value="'.$value.'" '.$selected.'>'.lang_line('l_chart_'.$value,'label_input').'</option>';
	}

	$select .= "</select>";
	return $select;
 }
 /**
  * set selected payment
  * 
  * @param string
  * @return string
  */
 function selected_payment_chart($select = false)
 {
 	if ($select == false && @$_SESSION['chart_sold_out']) {
		return $_SESSION['chart_sold_out'];
 	}
 	$arr = get_payment_chart();
 	if ($select && in_array($select, $arr)) {
 		$_SESSION['chart_sold_out'] = $select;
 	}else{
	 	$_SESSION['chart_sold_out'] = "brand"; 		
 	}
	return $_SESSION['chart_sold_out'];

 }
 /**
  * Convert string to file using base64
  * 
  * @param string
  * @return array
  */
function atr_file($name = false)
{
	var_dump($_POST['files']);
	if (!$name) {
		return false;
	}
	$data = $_POST[$name];
	foreach ($data as $key => $value) {
		$img = str_replace('data:image/png;base64,', '', $value);
		$img = str_replace(' ', '+', $img);
		$data = base64_decode($img);
		$file = '../assets/temp/image.png';
		$success[] = file_put_contents($file, $data);
	}
	var_dump($success);
	return $success;
}
/**
 * Default form for add content
 * 
 * @param no param
 * @return array
 */
 function default_form(){

	$default 		= [
		'image',
		'title',
		'price',
		'condition',
		'description'
	];
	return $default;
 }

/**
 * Check if number phone not wiht country code
 * 
 * @param string
 * @return string
 */
 function number_phone($phone)
 {
 	$country_code = getenv('COUNTRY_CODE');
 	
 	if (!strpos($phone, $country_code)) {
 		$phone = preg_replace('/^0/',$code,$user['phone']);
 	}
 	return $phone;


 }