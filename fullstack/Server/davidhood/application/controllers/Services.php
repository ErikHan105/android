<?php
include 'session.inc';

class Services extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
		$this->load->helper(array('form', 'url'));
    	$this->load->helper('url');
		$this->load->database();
    }
    
    function index()
    {
    	$this->go_songs();
    }


	// function go_tempos($click = 0, $error = '')
	// {	
	// 	switch ($click) {
	// 		case 0:
	// 			$click1 = '3/4';
	// 			break;
	// 		case 1:
	// 			$click1 = '4/4';
	// 			break;
	// 		case 2:
	// 			$click1 = '6/4';
	// 			break;
	// 		case 3:
	// 			$click1 = '6/8';
	// 			break;
	// 		default:
	// 			break;
	// 	}
	// 	$this->load->view('header', array('active' => 'all tempos'));
	// 	$this->load->model('service_model');
	// 	$result = $this->service_model->get_tempos($click1, $array);
	// 	$data = array('error' => $error, 'data' => $array, 'click' => $click);
	// 	$this->load->view('tempos', $data);
	// }
	function go_purchase($day = 'all', $error = '')
	{
		$this->load->view('header', array('active' => 'purchase'));
		$this->load->model('user_model');
		$array = $this->user_model->get_statisticsByDay('tbl_purchase', $day);
		$data = array('error' => $error, 'data' => $array, 'day' => $day);
		$this->load->view('purchase', $data);
	}
	// function go_share($error = '')
	// {
	// 	$this->load->view('header', array('active' => 'share'));
	// 	$this->load->model('service_model');
	// 	$result = $this->service_model->get_share($array);
	// 	$data = array('error' => $error, 'data' => $array);
	// 	$this->load->view('share', $data);
	// }
	// function change_status($id, $status, $day)
	// {
	// 	$this->load->model('user_model');
	// 	$result = $this->user_model->change_status('tbl_song', $id, $status);
	// 	if ($result != 200) {
	// 		$error = 'Invalid Service';
	// 	} else {
	// 		$error = "Successfully changed.";
	// 	}
	// 	$this->go_songs($day, $error);
	// }
	function delete_video($id, $day)
	{
		$this->load->model('user_model');
		$result = $this->user_model->delete_item('tbl_video', $id);
		if ($result != 200) {
			$error = 'Invalid Video';
		} else {
			$error = "Successfully deleted.";
		}
		$this->go_videos($day, $error);
	}
	// function delete_share($id)
	// {
	// 	$this->load->model('user_model');
	// 	$result = $this->user_model->delete_item('tbl_share', $id);
	// 	if ($result != 200) {
	// 		$error = 'Invalid Song';
	// 	} else {
	// 		$error = "Successfully deleted.";
	// 	}
	// 	$this->go_share($error);
	// }
	// function edit_song($page_type, $id = 0, $error = '')
	// {
	// 	if ($page_type == 'new') {
	// 		$active = 'new song';
	// 	} else {
	// 		$active = 'all songs';
	// 	}
	// 	$this->load->view('header', array('active' => $active));
	// 	$array = array('id' => '', 'photo' => '', 'name' => '', 'duration' => '', 'price' => '', 'url' => '', 'tracks' => array(), 'tkeys' => array(), 'ext' => '');
	// 	if ($id != '0') {
	// 		$this->load->model('service_model');
	// 		$result = $this->service_model->get_SongById($id, $array);
	// 	}
	// 	$this->load->model('service_model');
	// 	$result = $this->service_model->getKeys($key_array);  
	// 	$data = array('data' => $array, 'error' => $error, 'page_type' => $page_type, 'key_array' => $key_array);
	// 	$this->load->view('song_detail', $data);
	// }
	// function edit_tempo($page_type, $id = 0, $error = '')
	// {
	// 	if ($page_type == 'new') {
	// 		$active = 'new tempo';
	// 	} else {
	// 		$active = 'all tempos';
	// 	}
	// 	$this->load->view('header', array('active' => $active));
	// 	$array = array('id' => '', 'bpm' => '', 'url' => '', 'ext' => '', 'click' => '3/4', 'duration' => '');
	// 	if ($id != '0') {
	// 		$this->load->model('service_model');
	// 		$result = $this->service_model->get_TempoById($id, $array);
	// 	}
	// 	$data = array('data' => $array, 'error' => $error, 'page_type' => $page_type);
	// 	$this->load->view('tempo_detail', $data);
	// }
	// function update_song()
	// {
	// 	$id = $_REQUEST['id'];
	// 	$page_type = $_REQUEST['page_type'];
	// 	$name = $_REQUEST['name'];
	// 	$price = $_REQUEST['price'];
	// 	$photo = $_REQUEST['photo'];
	// 	$url = $_REQUEST['url'];
	// 	$ext = $_REQUEST['ext'];
	// 	$duration = $_REQUEST['duration'];
	// 	if (isset($_REQUEST['tkeys'])) {
	// 		$arr_tkeys = $_REQUEST['tkeys'];
	// 	} else {
	// 		$arr_tkeys = array();
	// 	}
	// 	$tkeys = implode(",", $arr_tkeys);
	// 	$array_track = array();
	// 	foreach ($_REQUEST as $key => $value) {
	// 		if (strpos($key, 'track_url_') !== false) {
	// 			$index = intval($this->after_last ('_', $key))-1;
	// 		    $array_track[$index]['url'] = $value;
	// 		} else if (strpos($key, 'track_name_') !== false) {
	// 			$index = intval($this->after_last ('_', $key))-1;
	// 		    $array_track[$index]['name'] = $value;
	// 		} else if (strpos($key, 'track_ext_') !== false) {
	// 			$index = intval($this->after_last ('_', $key))-1;
	// 		    $array_track[$index]['ext'] = $value;
	// 		}
	// 	}
	// 	$array_track = array_values($array_track);
	// 	if (strlen($name) == 0 || strlen($price) == 0 || strlen($photo) == 0 || strlen($url) == 0 || strlen($tkeys) == 0 || count($array_track) == 0) {
	// 		if ($page_type == 'new') {
	// 			$active = 'new song';
	// 		} else {
	// 			$active = 'all songs';
	// 		}
	// 		$this->load->view('header', array('active' => $active));
	// 		$array = array('id' => $id, 'photo' => $photo, 'name' => $name, 'duration' => $duration, 'price' => $price, 'url' => $url, 'tracks' => $array_track, 'tkeys' => $arr_tkeys, 'ext' => $ext);
	// 		$this->load->model('service_model');
	// 		$result = $this->service_model->getKeys($key_array);  
	// 		$data = array('data' => $array, 'error' => 'Please fill in all fields.', 'page_type' => $page_type, 'key_array' => $key_array);
	// 		$this->load->view('song_detail', $data);
	// 		return;
	// 	}
	// 	$this->load->model('service_model');
	// 	$this->service_model->add_track($array_track, $tracks);
	// 	$in_array = array('name' => $name, 'price' => $price, 'photo' => $photo, 'url' => $url, 'tkeys' => $tkeys, 'tracks' => $tracks, 'ext' => $ext, 'duration' => $duration);
	// 	$this->service_model->update_song($id, $page_type, $in_array);
	// 	if ($page_type == 'new') {
	// 		$error = 'Successfully added';
	// 	} else {
	// 		$error = 'Successfully updated';
	// 	}
	// 	$this->edit_song($page_type, $id, $error);
	// }
	// function update_tempo()
	// {
	// 	$id = $_REQUEST['id'];
	// 	$page_type = $_REQUEST['page_type'];
	// 	$click = $_REQUEST['click'];
	// 	$bpm = $_REQUEST['bpm'];
	// 	$url = $_REQUEST['url'];
	// 	$ext = $_REQUEST['ext'];
	// 	$duration = $_REQUEST['duration'];
	// 	if (strlen($bpm) == 0|| strlen($url) == 0) {
	// 		$this->edit_tempo($page_type, $id, 'Please fill in all fields.');
	// 		return;
	// 	}
	// 	$in_array = array('bpm' => $bpm, 'url' => $url, 'ext' => $ext, 'duration' => $duration, 'click' => $click);
	// 	$this->load->model('service_model');
	// 	$result = $this->service_model->update_tempo($id, $page_type, $in_array);
	// 	if ($result == 200) {
	// 		if ($page_type == 'new') {
	// 			$error = 'Successfully added';
	// 		} else {
	// 			$error = 'Successfully updated';
	// 		}
	// 	} else {
	// 		$error = $click.' '.$bpm.' BPM already exists.';
	// 	}
	// 	$this->edit_tempo($page_type, $id, $error);
	// }
	// function delete_tempo($click, $id)
	// {
	// 	$this->load->model('user_model');
	// 	$result = $this->user_model->delete_item('tbl_tempo', $id);
	// 	if ($result != 200) {
	// 		$error = 'Invalid Tempo';
	// 	} else {
	// 		$error = "Successfully deleted.";
	// 	}
	// 	$this->go_tempos($click, $error);
	// }

	// function after_last ($thi, $inthat)
 //    {
 //        if (!is_bool($this->strrevpos($inthat, $thi)))
 //        return substr($inthat, $this->strrevpos($inthat, $thi)+strlen($thi));
 //    }
 //    function strrevpos($instr, $needle)
	// {
	//     $rev_pos = strpos (strrev($instr), strrev($needle));
	//     if ($rev_pos===false) return false;
	//     else return strlen($instr) - $rev_pos - strlen($needle);
	// }

	// function image_upload()
 //    {	    	//FCPATH
	// 	$config['upload_path']          =  FCPATH.'uploadImages/song/';
 //        $config['allowed_types']        = 'gif|jpg|png|jpeg';
 //        $config['max_size']             = 5000;
 //        $config['max_width']            = 4000;
 //        $config['max_height']           = 3000;
	// 	$config['file_name'] 			= time();
	// 	$config['overwrite']			= TRUE;
		
 //        $this->load->library('upload', $config);
 //        if ( ! $this->upload->do_upload('file'))
 //        {
 //            $error = array('error' => $this->upload->display_errors());
	// 		// var_dump($config['upload_path']);
	// 		echo 400;
 //        }
 //        else
 //        {
	// 		$img_info = $this->upload->data();
 //            $image_info = array('full_path' => $img_info['full_path']);
 //            $url = base_url()."uploadImages/song/";
 //            $info = pathinfo($img_info['full_path']);
 //            $filename = $info['filename'];
 //            $extension = $info['extension'];
 //            $real_url = $url.$filename.'.'.$extension;
 //            $image_info = array('full_path' => $real_url);
	// 		echo $filename.'.'.$extension;
 //        }    
	// }
	// function audio_upload()
 //    {	    	//FCPATH
	// 	$config['upload_path']          =  FCPATH.'uploadAudio/song/';
 //        $config['allowed_types']        = 'mp3|wav|wma';
	// 	$config['file_name'] 			= time();
	// 	$config['overwrite']			= TRUE;
		
 //        $this->load->library('upload', $config);
 //        if ( ! $this->upload->do_upload('file'))
 //        {
 //            $error = array('error' => $this->upload->display_errors());
	// 		// var_dump($error);
	// 		echo 400;
 //        }
 //        else
 //        {
	// 		$img_info = $this->upload->data();
 //            $image_info = array('full_path' => $img_info['full_path']);
 //            $url = base_url()."uploadAudio/song/";
 //            $info = pathinfo($img_info['full_path']);
 //            $filename = $info['filename'];
 //            $extension = $info['extension'];
 //            $real_url = $url.$filename.'.'.$extension;
 //            $image_info = array('full_path' => $real_url);
	// 		echo $filename.'.'.$extension;
 //        }    
	// }
	// function track_upload()
 //    {	    	//FCPATH
	// 	$config['upload_path']          =  FCPATH.'uploadAudio/track/';
 //        $config['allowed_types']        = 'mp3|wav|wma';
	// 	$config['file_name'] 			= time().'_'.$_REQUEST['index'];
	// 	$config['overwrite']			= TRUE;
		
 //        $this->load->library('upload', $config);
 //        if ( ! $this->upload->do_upload('file'))
 //        {
 //            $error = array('error' => $this->upload->display_errors());
	// 		// var_dump($error);
	// 		echo json_encode(array('error' => $error, 'status' => 400));
 //        }
 //        else
 //        {
	// 		$img_info = $this->upload->data();
 //            $image_info = array('full_path' => $img_info['full_path']);
 //            $url = base_url()."uploadAudio/track/";
 //            $info = pathinfo($img_info['full_path']);
 //            $filename = $info['filename'];
 //            $extension = $info['extension'];
 //            $real_url = $url.$filename.'.'.$extension;
 //            $image_info = array('full_path' => $real_url);
	// 		echo json_encode(array('filename' => $_REQUEST['filename'], 'result' => $filename.'.'.$extension, 'status' => 200, 'index' => strval($_REQUEST['index'])));
 //        }    
	// }
	// function tempo_upload()
 //    {	    	//FCPATH
	// 	$config['upload_path']          =  FCPATH.'uploadAudio/tempo/';
 //        $config['allowed_types']        = 'mp3|wav|wma';
	// 	$config['file_name'] 			= time();
	// 	$config['overwrite']			= TRUE;
		
 //        $this->load->library('upload', $config);
 //        if ( ! $this->upload->do_upload('file'))
 //        {
 //            $error = array('error' => $this->upload->display_errors());
	// 		// var_dump($error);
	// 		echo 400;
 //        }
 //        else
 //        {
	// 		$img_info = $this->upload->data();
 //            $image_info = array('full_path' => $img_info['full_path']);
 //            $url = base_url()."uploadAudio/tempo/";
 //            $info = pathinfo($img_info['full_path']);
 //            $filename = $info['filename'];
 //            $extension = $info['extension'];
 //            $real_url = $url.$filename.'.'.$extension;
 //            $image_info = array('full_path' => $real_url);
	// 		echo $filename.'.'.$extension;
 //        }    
	// }
	function delete_purchase($id, $day)
	{
		$this->load->model('user_model');
		$result = $this->user_model->delete_item('tbl_purchase', $id);
		if ($result != 200) {
			$error = 'Invalid Purchase';
		} else {
			$error = "Successfully deleted.";
		}
		$this->go_purchase($day, $error);
	}

}
?>