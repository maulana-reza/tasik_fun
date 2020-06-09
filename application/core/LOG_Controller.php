<?php
/**
 * Date: 3/19/19
 * Time: 7:08 AM
 */

class LOG_Controller
{
	/**
	 * Make log to log.txt
	 * 
	 * @param string to log
	 * @return no return 
	 * 
	 */
	public static function _to_log($string)
	{
		date_default_timezone_set("Asia/Jakarta");

		$string = date('[ Y-m-d H:i:s ] ')."IP ADDRESS : ".self::get_client_ip().", Parameter : ".$string." \n";
		$file 	= fopen(APPPATH."logs/log.txt", "a") or die("unable open file");
		$write 	= fputs($file, $string);
		fclose($file);
		return $string;

	}
	/**
	 * GET clien ip
	 * 
	 * @param no param
	 * @return string
	 */
	static function get_client_ip() {
	
	    $ipaddress = '';
	    if (isset($_SERVER['HTTP_CLIENT_IP']))
	        $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
	    else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
	        $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
	    else if(isset($_SERVER['HTTP_X_FORWARDED']))
	        $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
	    else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
	        $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
	    else if(isset($_SERVER['HTTP_FORWARDED']))
	        $ipaddress = $_SERVER['HTTP_FORWARDED'];
	    else if(isset($_SERVER['REMOTE_ADDR']))
	        $ipaddress = $_SERVER['REMOTE_ADDR'];
	    else
	        $ipaddress = 'UNKNOWN';
	    return $ipaddress;
	
	}

	/**
	* Get all respon
	* 
	* @param string $filename
	* @return no return 
	* 
	*/
	static function _get_all_respon()
	{	

		$output = self::_map_array($_REQUEST);
		$output .= self::_map_array($_FILES);
		$data = self::_to_log($output);
	}
	/**
	 * 
	 */
	static function _map_array($array)
	{
		return implode(', ', array_map(function ($v,$k){
			if (is_array($v)) {
				return self::_map_array($v);
			}else{
				return sprintf("%s = '%s'", $k, $v); 
			}
		},$array,array_keys($array)));
	}
}