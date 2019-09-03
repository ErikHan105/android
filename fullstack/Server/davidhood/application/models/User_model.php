<?php

class User_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    function get_statistics(&$array)
    {
    	$array = array();
		// video statistics
		$array['video'][0] = count($this->get_statisticsByDay('tbl_video', "daily"));
		$array['video'][1] = count($this->get_statisticsByDay('tbl_video', "weekly"));
		$array['video'][2] = count($this->get_statisticsByDay('tbl_video', "monthly"));
		$array['video'][3] = count($this->get_statisticsByDay('tbl_video'));
		// purchase statistics
		$arr_today = $this->get_statisticsByDay('tbl_purchase', "daily"); $total = 0;
		foreach ($arr_today as $key => $value) {
			$total += floatval($value['price']);
		}
		$array['purchase'][0] = $total;

		$arr_week = $this->get_statisticsByDay('tbl_purchase', "weekly"); $total = 0;
		foreach ($arr_week as $key => $value) {
			$total += floatval($value['price']);
		}
		$array['purchase'][1] = $total;

		$arr_month = $this->get_statisticsByDay('tbl_purchase', "monthly"); $total = 0;
		foreach ($arr_month as $key => $value) {
			$total += floatval($value['price']);
		}
		$array['purchase'][2] = $total;

		$arr_all = $this->get_statisticsByDay('tbl_purchase', "all"); $total = 0;
		foreach ($arr_all as $key => $value) {
			$total += floatval($value['price']);
		}
		$array['purchase'][3] = $total;
		// $array['purchase'][1] = count($this->get_statisticsByDay('tbl_purchase', "weekly"));
		// $array['purchase'][2] = count($this->get_statisticsByDay('tbl_purchase', "monthly"));
		// $array['purchase'][3] = count($this->get_statisticsByDay('tbl_purchase'));

		return 200;
    }
    function get_statisticsByDay($table, $day = "all")
    {
    	$array = array();
    	if ($day == "daily") {
	    	$timestamp =strtotime("today");
    	} else if ($day == "weekly") {
    		$timestamp =strtotime("Last Monday");
    	} else if ($day == "monthly") {
    		$timestamp =strtotime(date('Y-m-01 00:00:00'));
    	} else {
    		$timestamp = 0;
    	}
    	// user statistics
    	$this->db->where('created>=', $timestamp);
    	$this->db->where('deleted', 0);
		$this->db->order_by("id", "desc");
		$array = $this->db->get($table)->result_array();
		if ($table == 'tbl_video') {
			for ($i=0; $i < count($array); $i++) { 
				// $array[$i]['photo'] = base_url().'uploadImages/song/'.$array[$i]['photo'];
				// $array[$i]['url'] = base_url().'uploadAudio/song/'.$array[$i]['url'];
				// $array[$i]['duration'] = gmdate("H:i:s", intval($array[$i]['duration']));
			}
		}
		if ($table == 'tbl_purchase') {
			for ($i=0; $i < count($array); $i++) { 
				// $user = $this->db->get_where('tbl_user', array('id' => $array[$i]['user_id']))->result_array();
				// $array[$i]['user'] = $user[0];
				$video = $this->db->get_where('tbl_video', array('id' => $array[$i]['video_id']))->result_array();
				$array[$i]['video'] = $video[0];
				$array[$i]['date'] = gmdate("Y-m-d", $array[$i]['created']);
			}
		}
		return $array;
    }
    function get_chartData($table, &$array)
    {
    	$array = array('01' => array(), '02' => array(), '03' => array(), '04' => array(), '05' => array(), '06' => array(), 
    		'07' => array(), '08' => array(), '09' => array(), '10' => array(), '11' => array(), '12' => array(), 'result' => array(0,0,0,0,0,0,0,0,0,0,0,0));
   		$m1 =strtotime(date('Y-01-01 00:00:00'));
   		$m2 =strtotime(date('Y-02-01 00:00:00'));
   		$m3 =strtotime(date('Y-03-01 00:00:00'));
   		$m4 =strtotime(date('Y-04-01 00:00:00'));
   		$m5 =strtotime(date('Y-05-01 00:00:00'));
   		$m6 =strtotime(date('Y-06-01 00:00:00'));
   		$m7 =strtotime(date('Y-07-01 00:00:00'));
   		$m8 =strtotime(date('Y-08-01 00:00:00'));
   		$m9 =strtotime(date('Y-09-01 00:00:00'));
   		$m10 =strtotime(date('Y-10-01 00:00:00'));
   		$m11 =strtotime(date('Y-11-01 00:00:00'));
   		$m12 =strtotime(date('Y-12-01 00:00:00'));

    	$this->db->where('created>=', $m1);
    	$this->db->where('deleted', 0);
		$this->db->order_by("id", "desc");
		$result = $this->db->get($table)->result_array();
		foreach ($result as $key => $value) {
			if ($value['created'] >= $m1 && $value['created'] < $m2) {
				array_push($array['01'], $value);
				if ($table != 'tbl_purchase' ) {
					$array['result'][0] += 1;
				} else {
					$array['result'][0] += floatval($value['price']);
				}
			} else if ($value['created'] >= $m2 && $value['created'] < $m3) {
				array_push($array['02'], $value);
				if ($table != 'tbl_purchase' ) {
					$array['result'][1] += 1;
				} else {
					$array['result'][1] += floatval($value['price']);
				}
			} else if ($value['created'] >= $m3 && $value['created'] < $m4) {
				array_push($array['03'], $value);
				if ($table != 'tbl_purchase' ) {
					$array['result'][2] += 1;
				} else {
					$array['result'][2] += floatval($value['price']);
				}
			} else if ($value['created'] >= $m4 && $value['created'] < $m5) {
				array_push($array['04'], $value);
				if ($table != 'tbl_purchase' ) {
					$array['result'][3] += 1;
				} else {
					$array['result'][3] += floatval($value['price']);
				}
			} else if ($value['created'] >= $m5 && $value['created'] < $m6) {
				array_push($array['05'], $value);
				if ($table != 'tbl_purchase' ) {
					$array['result'][4] += 1;
				} else {
					$array['result'][4] += floatval($value['price']);
				}
			} else if ($value['created'] >= $m6 && $value['created'] < $m7) {
				array_push($array['06'], $value);
				if ($table != 'tbl_purchase' ) {
					$array['result'][5] += 1;
				} else {
					$array['result'][5] += floatval($value['price']);
				}
			} else if ($value['created'] >= $m7 && $value['created'] < $m8) {
				array_push($array['07'], $value);
				if ($table != 'tbl_purchase' ) {
					$array['result'][6] += 1;
				} else {
					$array['result'][6] += floatval($value['price']);
				}
			} else if ($value['created'] >= $m8 && $value['created'] < $m9) {
				array_push($array['08'], $value);
				if ($table != 'tbl_purchase' ) {
					$array['result'][7] += 1;
				} else {
					$array['result'][7] += floatval($value['price']);
				}
			} else if ($value['created'] >= $m9 && $value['created'] < $m10) {
				array_push($array['09'], $value);
				if ($table != 'tbl_purchase' ) {
					$array['result'][8] += 1;
				} else {
					$array['result'][8] += floatval($value['price']);
				}
			} else if ($value['created'] >= $m10 && $value['created'] < $m11) {
				array_push($array['10'], $value);
				if ($table != 'tbl_purchase' ) {
					$array['result'][9] += 1;
				} else {
					$array['result'][9] += floatval($value['price']);
				}
			} else if ($value['created'] >= $m11 && $value['created'] < $m12) {
				array_push($array['11'], $value);
				if ($table != 'tbl_purchase' ) {
					$array['result'][10] += 1;
				} else {
					$array['result'][10] += floatval($value['price']);
				}
			} else if ($value['created'] >= $m12) {
				array_push($array['12'], $value);
				if ($table != 'tbl_purchase' ) {
					$array['result'][11] += 1;
				} else {
					$array['result'][11] += floatval($value['price']);
				}
			}
		}
    }
 //   	function change_status($table, $id, $status)
	// {
	// 	$result = $this->db->get_where($table, array('id' => $id, 'deleted' => 0))->result_array();
	// 	if (count($result) == 0) {
	// 		return 400;
	// 	}
	// 	$this->db->where('id', $id);
	// 	$this->db->update($table, array('status' => $status));
	// 	return 200;
	// }
	function delete_item($table, $id)
	{
		$result = $this->db->get_where($table, array('id' => $id, 'deleted' => 0))->result_array();
		if (count($result) == 0) {
			return 400;
		}
		$this->db->where('id', $id);
		$this->db->update($table, array('deleted' => 1));
		return 200;
	}









    function login($email, $password, $type, &$out_array)
    {
    	$result = $this->db->get_where('tbl_user', array('email' => $email, 'type' => $type, 'deleted' => 0))->result_array();
    	if (count($result) == 0) {
    		$out_array['reason'] = 'Invalid user!';
    		return 400;
    	}
    	if ($result[0]['password'] != $password) {
    		$out_array['reason'] = 'Password is not correct!';
    		return 400;
    	}
    	if ($result[0]['status'] == 'inactive') {
    		$out_array['reason'] = 'Account is inactive!';
    		return 400;
    	}
    	$out_array = $result[0];
    	return 200;
    }
    function checkEmail($email, &$out_array)
    {
    	$result = $this->db->get_where('tbl_user', array('email' => $email, 'deleted' => 0))->result_array();
    	if (count($result) == 0) {
    		$out_array['reason'] = 'Invalid user!';
    		return 400;
    	}
    	$out_array = $result[0];
    	return 200;
    }
    function checkId($id, &$out_array)
    {
    	$result = $this->db->get_where('tbl_user', array('id' => $id, 'deleted' => 0))->result_array();
    	if (count($result) == 0) {
    		$out_array['reason'] = 'Invalid user!';
    		return 400;
    	}
    	$out_array = $result[0];
    	return 200;
    }
    function update_password($id, $password, &$error)
    {
    	$result = $this->db->get_where('tbl_user', array('id' => $id, 'deleted' => 0))->result_array();
    	if (count($result) == 0) {
    		$error = 'Invalid user!';
    		return 400;
    	}
    	$this->db->where('id', $id);
    	$this->db->update('tbl_user', array('password' => $password));
    	$error = 'success';
    	return 200;
   }

    // function get_service_provider_statistics($featured, &$array)
    // {

    // }

    function get_service_statistics($type, $featured, &$array) {
    	$d_timestamp =strtotime("today");
    	$w_timestamp =strtotime("Last Monday");
    	$m_timestamp = strtotime(date('Y-m-01 00:00:00'));
    	$result = $this->db->get_where('tbl_user', array('type' => $type, 'deleted' => 0))->result_array();
		for ($i=0; $i <count($result) ; $i++) { 
			$array[$i]['user_id'] = $result[$i]['id'];
			$array[$i]['username'] = $result[$i]['username'];
			$array[$i]['provider_id_array'] = array();
			
			$rst = $this->db->get_where('tbl_service', array('creator_id' => $array[$i]['user_id'], 'type' => 'private'))->result_array();
			for ($j=0; $j < count($rst); $j++) { 
				array_push($array[$i]['provider_id_array'], $rst[$j]['provider_id']);
			}
			
			$array[$i]['service'][0] = count($this->get_servicesById_Featured_Day($result[$i]['id'], $featured, "daily"));
			$array[$i]['service'][1] = count($this->get_servicesById_Featured_Day($result[$i]['id'], $featured, "weekly"));
			$array[$i]['service'][2] = count($this->get_servicesById_Featured_Day($result[$i]['id'], $featured, "monthly"));
			$array[$i]['service'][3] = count($this->get_servicesById_Featured_Day($result[$i]['id'], $featured));
		}
    }
    // --------------------------------------------------------------------------------------------------------------
 
   function get_servicesByDay($day = "all")
   {
    	$array = array();
    	if ($day == "daily") {
	    	$timestamp =strtotime("today");
    	} else if ($day == "weekly") {
    		$timestamp =strtotime("Last Monday");
    	} else if ($day == "monthly") {
    		$timestamp =strtotime(date('Y-m-01 00:00:00'));
    	} else {
    		$timestamp = 0;
    	}
    	// user statistics
    	$this->db->where('created>', $timestamp);
    	$this->db->where('deleted', 0);
		$this->db->order_by("id", "desc");
		$array = $this->db->get('tbl_service')->result_array();
		return $array;
   }
   function get_servicesById_Featured_Day($id, $featured, $day = "all")
   {
    	$array = array();
    	if ($day == "daily") {
	    	$timestamp =strtotime("today");
    	} else if ($day == "weekly") {
    		$timestamp =strtotime("Last Monday");
    	} else if ($day == "monthly") {
    		$timestamp =strtotime(date('Y-m-01 00:00:00'));
    	} else {
    		$timestamp = 0;
    	}
    	// user statistics

    	$this->db->where('created>', $timestamp);
    	if ($id > 0) {
			$this->db->where('creator_id', $id);
    	}
    	if ($featured == 1) {
	    	$this->db->where('featured', $featured);
    	}
    	$this->db->where('deleted', 0);
		$this->db->order_by("id", "desc");
		$array = $this->db->get('tbl_service')->result_array();
		for ($i=0; $i < count($array); $i++) { 
			$array[$i]['image'] = base_url().'uploadImages/service/'.$array[$i]['image'];
			$result = $this->db->get_where('tbl_user', array('id' => $array[$i]['creator_id']))->result_array();
			$array[$i]['creator'] = $result[0]['username'];
			$result = $this->db->get_where('tbl_big_category', array('id' => $array[$i]['big_category_id']))->result_array();
			$array[$i]['big_category'] = $result[0]['name'];
			$result = $this->db->get_where('tbl_sub_category', array('id' => $array[$i]['sub_category_id']))->result_array();
			$array[$i]['sub_category'] = $result[0]['name'];

			if ($array[$i]['created'] == 0) {
				$array[$i]['created'] = "";
			} else {
				$array[$i]['created'] = date("Y/m/d \<\b\\r\> h/i/s A", $array[$i]['created']);
			}
			if ($array[$i]['updated'] == 0) {
				$array[$i]['updated'] = "";
			} else {
				$array[$i]['updated'] = date("Y/m/d \<\b\\r\> h/i/s A", $array[$i]['updated']);
			}
		}
		return $array;
   }
   // --------------------------------------------------------------------------------------------------------------
	function get_members($type, &$array)
	{
		$array = array();
		$result = $this->db->get_where('tbl_user', array('type' => $type, 'deleted' => 0))->result_array();
		for ($i=0; $i < count($result); $i++) { 
			if ($result[$i]['id'] == 1) {
				continue;
			}
			$result[$i]['photo'] = base_url().'uploadImages/user/'.$result[$i]['photo'];
			$country = $this->db->get_where('tbl_country', array('phonecode' => $result[$i]['country_code']))->result_array();
			$result[$i]['country_name'] = $country[0]['nicename'];
			$result[$i]['country_flag'] = base_url().'assets/images/flags/'.strtolower($country[0]['iso']).'.png';
			array_push($array, $result[$i]);
		}
		return 200;
	}
	function get_userById($id, &$array)
	{
		$result = $this->db->get_where('tbl_user', array('id' => $id, 'deleted' => 0))->result_array();
		if (count($result) == 0) {
			return 400;
		}
		$array = $result[0];
		$array['photo'] = $array['photo'];
		return 200;
	}	
	function getAllCountries(&$array)
	{
		$array = $this->db->get('tbl_country')->result_array();
		return $array;
	}
	function get_Allmembers($my_id, $my_type, $my_code, &$array)
	{
		$array = array();
		$result = $this->db->get_where('tbl_user', array('deleted' => 0))->result_array();
		array_push($array, array('id' => 0, 'username' => 'ALL', 'type' => 'public'));
		for ($i=0; $i < count($result); $i++) { 
			if ($my_id == $result[$i]['id']) {
				continue;
			}
			if ($my_type == 'operator' && $result[$i]['type'] == 'user' && $my_code != $result[$i]['country_code']) {
				continue;
			}
			if ($my_type == 'operator' && $result[$i]['type'] == 'operator') {
				continue;
			}
			$item['id'] = $result[$i]['id'];
			$item['username'] = $result[$i]['username'];
			$item['type'] = $result[$i]['type'];;
			array_push($array, $item);
		}
		return 200;
	}
	function update_profile(&$id, $username, $email, $password, $code, $number,$photo ,$user_type , $page_type, &$error)
	{
		$result = $this->db->get_where('tbl_user', array('email' => $email, 'deleted' => 0))->result_array();
		if (count($result) > 0) {
			if ($page_type == 'new') {
				$error = 'Email already exists';
				return 400;
			}
			if ($result[0]['id'] != $id) {
				$error = 'Email already exists';
				return 400;
			}
		}
		if ($page_type == 'edit') {
			$this->db->where('id', $id);
			$this->db->update('tbl_user', array('username' => $username, 'email' => $email, 'password' => $password, 'country_code' =>$code, 'number' => $number, 'photo' => $photo));
			$error = 'Successfully updated';
		} else {
			$this->db->insert('tbl_user', array('type' => $user_type, 'username' => $username, 'email' => $email, 'password' => $password, 'country_code' =>$code, 'number' => $number, 'photo' => $photo, 'status' => 'active'));
			$id = $this->db->insert_id();
			$error = 'Successfully added';
		}
		
		return 200;
	}

	function get_IdByEmail($email, &$id)
	{
		$query = $this->db->get_where('tbl_user', array('email' => $email, 'deleted' => 0));
		$result = $query->result_array();
		if (count($result) > 0) {
			$id = $result[0]['id'];
			return 200;
		}
		return 400;
	}








































	

	// function chage_status($table, $id, $status)
	// {
	// 	$query = $this->db->get_where($table, array('id' => $id));
	// 	$result = $query->result_array();
	// 	if (count($result) == 0) {
	// 		return 400;
	// 	}

	// 	$this->db->where('id', $id);
	// 	$this->db->update($table, array('status' => $status));
	// 	return 200;
	// }

	// function get_EmailById($id, &$email)
	// {
	// 	$this->db->where("`status`!='delete' AND `id`='".$id."'");
	// 	$query = $this->db->get('tbl_user');
	// 	$result = $query->result_array();
	// 	if (count($result) > 0) {
	// 		$email = $result[0]['email'];
	// 		return 200;
	// 	}
	// 	return 400;
	// }

}

?>