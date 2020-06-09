<?php
// example :
// $array[] = [
// 	'text' => 'example-text',
// 	'type' => 'success'
// ];
// alert($array);
// type : success,danger,info,warning

function alert($array)
{
	if (@$array[0]['text']) {

	$alert = '';
	$CI =& get_instance();

		foreach ($array as $key => $value) {
			$alert .= '
			<div class="mb-1 border-0 border-bottom rounded-0 pl-3 pt-4 pr-3 p-2 card-text alert alert-'.@$array[$key]['type'].' alert-dismissible fade show shadow" role="alert" data-dismiss="alert" aria-label="Close">
			'.@$array[$key]['text'].'
			</div>';

		}
	
	$CI->session->set_flashdata('alert',$alert);
	return $alert;
	}
}
// example :
// $array[] = [
// 	'text' => 'example-text',
// 	'type' => 'success' 
// ];
// alert_login($array);
// type : success,danger,info,warning

function alert_login($array)
{
	if (@$array[0]['text']) {

	$alert = '';
	$CI =& get_instance();

		foreach ($array as $key => $value) {
			$alert .= '
			<div class="mb-0 border-0 border-bottom w-100 rounded-0 pl-3 pr-3 p-2 card-text alert alert-'.@$array[$key]['type'].' alert-dismissible fade show shadow" role="alert" data-dismiss="alert" aria-label="Close" style="margin-top:7em;padding-top:2em !important;z-index:100;bottom:0;z-index:10000;position:fixed;">
			'.@$array[$key]['text'].'
			</div>';

		}
	
	$CI->session->set_flashdata('alert',$alert);
	return $alert;
	}
}

// example :
// $array[] = [
// 	'text' => 'example-text',
// 	'type' => 'success' 
// ];
// alert_bottom($array);
// type : success,danger,info,warning

function alert_bottom($array)
{
	if (@$array[0]['text']) {

	$alert = '';
	$CI =& get_instance();

		foreach ($array as $key => $value) {
			$alert .= '
			<div class="mb-0 border-0 border-bottom w-100 rounded-0 pl-3 pr-3 p-2 card-text alert alert-'.@$array[$key]['type'].' alert-dismissible fade show shadow" role="alert" data-dismiss="alert" aria-label="Close" style="margin-top:7em;padding-top:2em !important;z-index:100;bottom:0;z-index:10000;position:fixed;">
			'.@$array[$key]['text'].'
			</div>';

		}
	
	$CI->session->set_flashdata('alert',$alert);
	return $alert;
	}
}
// example :
// $array[] = [
// 	'text' => 'example-text',
// 	'type' => 'success' 
// ];
// cst_alert($array);
// type : success,danger,info,warning
// to show : echo $cst_alert;
function cst_alert($array)
{
	if (@$array[0]['text']) {

	$alert = '';
	$CI =& get_instance();
	

		foreach ($array as $key => $value) {

			$alert .= (@$array[$key]['link'] ? '<a href="'.@$array[$key]['link'].'">' : '' ).'
			<div class="alert '.(@$array[$key]['link'] ? 'link-move' : '' ).'  waves-effect card-text border-0 w-100 border-bottom alert-'.@$array[$key]['type'].' fade show p-2 shadow" style="left:0;" role="alert" >
			'.@$array[$key]['text'].'
			</button>
			</div>'.(@$array[$key]['link'] ? '</a>' : '' );

		}
	$CI->addData('cst_alert',$alert);
	return $alert;
	}
}
function show_alert()
{
	$CI =& get_instance();
	$alert = '';
	$array = $CI->session->flashdata('alert');
	if (is_array($array)) {
		foreach ($array as $key => $value) {
			$alert .=$value;
		}
	}else{
		$alert = $array;
	}

	return $alert;
}