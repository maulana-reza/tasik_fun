<?php
// desa
// $this->db->join('villages', 'villages.id = users.villages_id','left');
// // kecamatan
// $this->db->join('districts', 'districts.id = villages.district_id', 'left');
// // kab / kota
// $this->db->join('regencies', 'regencies.id = districts.regency_id', 'left');
// // provinsi
// $this->db->join('provinces', 'provinces.id = regencies.province_id', 'left');

// select_provinces($province_id);
// $province_id as selected_id
function select_provinces($province_id = FALSE)
{
	$ci =& get_instance();

	$select = '<select name="province" class="browser-default custom-select mb-4 form-control border-0 border-bottom " onchange="is_selected_province(event,this)">
	<option>...</option>';
	$provinces = $ci->db->get('provinces')->result_array();
	foreach ($provinces as $key => $province) {

		$selected = ($province_id == $province['id'] ? 'selected="true"' : '');
		$select.='<option value="'.$province['id'].'" '.$selected.'>'. ucfirst(strtolower( $province['name'])).'</option>';
		
	}
	$select .= '</select>';
	return $select;

}
/**
 * @param string regency_id
 * @return array
 */
function selected_regency($regency_id)
{
	$ci =& get_instance();
	$province_id = $ci->db
	->where('regencies.id',$regency_id)
	->get('regencies')->row()->province_id;
	
	$array =[
	'province_id' => $province_id,
	'selected_id' => $regency_id,
	];

	$data['province'] 	= select_provinces($province_id); 
	$data['regency']	= select_regency($array);

	return $data;
}

// select_regency($array);
// explain : $array [
// 	'province_id' => '1',
// 	'selected_id' => 'null || 1'
// 	];

function select_regency($array)
{
	$ci =& get_instance();

	$select = '<select name="regency" class="browser-default custom-select mb-4 form-control border-0 border-bottom " onchange="is_selected_regency(event,this)">
	<option>...</option>';
	$regencies = $ci->db
	->where('regencies.province_id',$array['province_id'])
	->get('regencies')->result_array();
	foreach ($regencies as $key => $regency) {

		$selected = (@$array['selected_id'] == $regency['id'] ? 'selected="true"' : '');
		$select.='<option value="'.$regency['id'].'" '.$selected.'>'.ucfirst(strtolower( $regency['name'])).'</option>';

	}
	$select .= '</select>';
	return $select;

}
// select_district($array);
// explain : $array [
// 	'regency_id' => '1',
// 	s'selected_id' => 'null || 1'
// 	];

function select_district($array)
{
	$ci =& get_instance();

	$select = '<select name="district" class="browser-default custom-select mb-4 form-control border-0 border-bottom " onchange="is_selected_district(event,this)">
	<option>...</option>';
	$districts = $ci->db
	->where('districts.regency_id',$array['regency_id'])
	->get('districts')->result_array();
	foreach ($districts as $key => $district) {

		$selected = (@$array['selected_id'] == $district['id'] ? 'selected="true"' : '');
		$select.='<option value="'.$district['id'].'" '.$selected.'>'.ucfirst(strtolower( $district['name'])).'</option>';

	}
	$select .= '</select>';
	return $select;

}

// select_village($array);
// explain : $array [
// 	'district_id' => '1',
// 	s'selected_id' => 'null || 1'
// 	];

function select_village($array)
{
	$ci =& get_instance();

	$select = '<select name="village" class="browser-default custom-select mb-4 form-control border-0 border-bottom " >
	<option>...</option>';
	$villages = $ci->db
	->where('villages.district_id',$array['district_id'])
	->get('villages')->result_array();
	foreach ($villages as $key => $village) {

		$selected = (@$array['selected_id'] == $village['id'] ? 'selected="true"' : '');
		$select.='<option value="'.$village['id'].'" '.$selected.'>'.ucfirst(strtolower( $village['name'])).'</option>';

	}
	$select .= '</select>';
	return $select;

}