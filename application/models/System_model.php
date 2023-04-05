<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class System_model extends CI_Model {

	public function ip_info($ip = false) {
	    $output = array('country_code' => '');

	    if(!$ip){
	        $ip = $_SERVER['REMOTE_ADDR'];
	    }

	    if (filter_var($ip, FILTER_VALIDATE_IP)) {

	        $curl = curl_init("http://www.geoplugin.net/json.gp?ip=" . $ip);
	        $request = '';
	        curl_setopt($curl, CURLOPT_POSTFIELDS, $request);
	        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	        curl_setopt($curl, CURLOPT_HEADER, false);
	        curl_setopt($curl, CURLOPT_TIMEOUT, 30);
	        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

	        $ipdat = json_decode(curl_exec($curl));
	        if (@strlen(trim($ipdat->geoplugin_countryCode)) == 2) {
	            $output = array(
	                "ip"             => $ip,
	                "city"           => @$ipdat->geoplugin_city,
	                "state"          => @$ipdat->geoplugin_regionName,
	                "country"        => @$ipdat->geoplugin_countryName,
	                "country_code"   => @$ipdat->geoplugin_countryCode,
	                "continent_code" => @$ipdat->geoplugin_continentCode,
	                "regionCode"     => @$ipdat->geoplugin_regionCode,
	                "regionName"     => @$ipdat->geoplugin_regionName,
	                "countryCode"    => @$ipdat->geoplugin_countryCode,
	                "countryName"    => @$ipdat->geoplugin_countryName,
	                "continentName"  => @$ipdat->geoplugin_continentName,
	                "timezone"       => @$ipdat->geoplugin_timezone,
	                "currencyCode"   => @$ipdat->geoplugin_currencyCode,
	                "currencySymbol" => @$ipdat->geoplugin_currencySymbol,
	            );
	        }
	    }

	    return $output;
	}

	public function get_controller_files($slug){
		if($slug=='qpos'):
			$to = APPPATH.'controllers/admin/Pos.php';
			unlink($to);
			$filePath = FCPATH.'addons/controllers/Pos_controller.php';
			if(file_exists($filePath)){
				try{
					$this->move_file($filePath,$to);
					return true;
				}catch (Exception $e) {
					return $e->getMessage(); 		
				}
			}else{
				return "Sorry Addons folder & files are not found!!";
			}

			
		endif;
	}

	public function get_model_files($slug){
		if($slug=='qpos'):
			$to = APPPATH.'models/Pos_m.php';
			unlink($to);

			$filePath = FCPATH.'addons/models/Pos_model.php';
			if(file_exists($filePath)){
				try{
					$this->move_file($filePath,$to);
					return true;
				}catch (Exception $e) {
					return $e->getMessage(); 		
				}
			}else{
				return "Sorry Addons folder & files are not found!!";
			}
		endif;
	}

	protected function move_file($filePath, $to){
		if (!file_exists($to)) {
			copy($filePath, $to);
			unlink($filePath);
		}
	}


}


/* End of file System_model.php */
/* Location: ./application/models/System_model.php */