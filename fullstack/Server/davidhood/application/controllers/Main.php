<?php
// include 'session.inc';

class Main extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
    	$this->load->helper('url');
		$this->load->library('session');
		$this->load->model('model');
    }
    
    function index()
    {
    }

	function advertisement($lang = 'french', $error = '')
	{	
		$_SESSION[SITE]['lang'] = $lang;
		$this->load->view('header', array('active' => 'advertisement'));
		$result = $this->model->get_advertisement($lang, $data);
		$data = array('error' => $error, 'data' => $data['data']);
		$this->load->view('advertisement', $data);
	}
	function add_advertisement($error = '', $arr_initials = array('title' => '', 'price' => '', 'url' => '', 'description' => '', 'lang' => 'french', 'cnt' => 1, 'limits' => 1, 'type' => 'once', 'question' => '', 'company_url' => ''), $answer = array(0=>array('answer' => "", 'isright' => 0)))
	{	
		if ($arr_initials['cnt'] == 0) {
			$arr_initials['cnt'] = 1;
		}
		$this->load->view('header', array('active' => 'advertisement'));
		$data = array('error' => $error, 'data' => $arr_initials, 'answer' => $answer);
		$this->load->view('add_advertisement', $data);
	}
	function do_add_advertisement()
	{
		$title = trim($_REQUEST['title']);
		$price = ($_REQUEST['price']);
		$description = trim($_REQUEST['description']);
		$url = trim($_REQUEST['url']);
		$type = trim($_REQUEST['type']);
		$company_url = trim($_REQUEST['company_url']);
		$cnt = 1;
		if (isset($_REQUEST['cnt'])) {
			$cnt = trim($_REQUEST['cnt']);
		}
		$lang = trim($_REQUEST['lang']);
		$limits = trim($_REQUEST['limits']);
		$question = "";
		if (isset($_REQUEST['question'])) {
			$question = trim($_REQUEST['question']);
		}
		$answer = array();
		foreach ($_REQUEST as $key => $value) {
			if (strpos($key, 'answer') !== false) {
				$index = substr($key, 6, strlen($key)-5);
				$isright = 0;
				if (isset($_REQUEST['check'.$index])) {
					$isright = 1;
				}
				array_push($answer, array('answer' => trim($_REQUEST[$key]), 'isright' => $isright)) ;
			}
		}
		$arr_data = array('title' => $title, 'price' => $price, 'url' => $url, 'description' => $description, 'lang' => $lang, 'type' => $type, 'cnt' => $cnt, 'limits' => $limits, 'question' => $question, 'company_url' => $company_url);
		if (strlen($title) == 0 || strlen($price) == 0 || strlen($description) == 0 || strlen($url) == 0 || strlen($type) == 0 || strlen($cnt) == 0 || strlen($limits) == 0 || strlen($lang) == 0 || strlen($company_url) == 0) {
			$this->add_advertisement('Please fill in mandatory fields.', $arr_data);
			return;
		}
		if (intval($limits) < intval($cnt)) {
			$this->add_advertisement('Limit views can not be smaller than Max views.', $arr_data);
			return;
		}
		if (strlen($question) == 0 && strlen(trim($answer[0]['answer'])) > 0) {
			$this->add_advertisement('Please fill in question field.', $arr_data);
			return;
		}
		if (strlen($question) > 0 && strlen(trim($answer[0]['answer'])) == 0) {
			$this->add_advertisement('Please fill in answer field.', $arr_data);
			return;
		}
		if (strlen($question) == 0 && strlen(trim($answer[0]['answer'])) == 0) {
			$answer = array();
		}
		if (strpos($company_url, "http") !== false) {
		} else {
			$this->add_advertisement('Invalid company url.', $arr_data, $answer);
			return;
		}
		if (strpos($url, "https://drive.google.com/open?id=") !== false) {
			$result = $this->model->add_advertisement($arr_data, $answer);
			if ($result == 200) {
				$this->add_advertisement('Successfully added.', $arr_data, $answer);
			} else {
				$this->add_advertisement('The public url already exists. Please input other url.', $arr_data, $answer);
			}
			return;
		} else {
			$this->add_advertisement('Invalid public url.', $arr_data, $answer);
			return;
		}
	}

	function delete($table, $id) {
		$result = $this->model->delete($table, $id);
		if ($table == 'tbl_advertise') {
			redirect(base_url().'main/advertisement/'.$_SESSION[SITE]['lang'].'/SuccessfullyDeleted');
			return;
		} else if ($table == 'tbl_user') {
			redirect(base_url().'main/user/SuccessfullyDeleted');
			return;
		} else if ($table == 'tbl_purchase') {
			redirect(base_url().'main/payment_made/SuccessfullyDeleted');
			return;
		} else if ($table == 'tbl_question') {
			redirect(base_url().'main/question/SuccessfullyDeleted');
			return;
		}
		return;
	}

	function user($error = '')
	{	
		$this->load->view('header', array('active' => 'user'));
		$result = $this->model->get_user($data);
		$data = array('error' => $error, 'data' => $data['data']);
		$this->load->view('user', $data);
	}

	function purchase($error = '')
	{
		$this->load->view('header', array('active' => 'purchase'));
		$result = $this->model->get_purchase($data);
		$data = array('error' => $error, 'data' => $data['data']);
		$this->load->view('purchase', $data);
	}
	function payment_made($error = '')
	{
		$this->load->view('header', array('active' => 'payment_made'));
		$result = $this->model->get_purchase($data);
		$data = array('error' => $error, 'data' => $data['data']);
		$this->load->view('payment_made', $data);
	}
	function question($error = '')
	{
		$this->load->view('header', array('active' => 'question'));
		$result = $this->model->get_question($data);
		$data = array('error' => $error, 'data' => $data['data']);
		$this->load->view('question', $data);
	}

	function change_status($id, $user_id) {
		$reslt = $this->model->change_status($id, $user_id);
		redirect(base_url().'main/purchase/SuccessfullyUpdated');

	}

	function reset_password() {
		$id = $_REQUEST['id'];
		$email = $_REQUEST['email'];
		$password = $_REQUEST['password'];
		$address = $_REQUEST['address'];
		$city = $_REQUEST['city'];
		$postal_code = $_REQUEST['postal_code'];
		$iban = $_REQUEST['iban'];
		$this->model->reset_password($id, $email, $password, $address, $city, $postal_code, $iban);
		$this->user();
	}




























	function edit_profile($page_type, $id, $user_type, $error = '')
	{
		$active = $user_type;
		if ($_SESSION['id'] == $id) {
			$active = '';
		}
		$this->load->model('message_model');
		$result = $this->message_model->getUnreadMessages($_SESSION['id'], $array);
		$data = array('msg_badge' => $array['count'], 'active' => $active);
		$this->load->view('header', $data);
		$array = array('id' => '', 'country_code' => '', 'username' => '', 'email' => '', 'number' => '', 'password' => '', 'photo' => '');
		if ($id != '0') {
			$this->load->model('model');
			$result = $this->model->get_userById($id, $array);
		}
		$this->load->model('model');
		$result = $this->model->getAllCountries($country_array);
		$data = array('data' => $array, 'error' => $error, 'user_type' => $user_type, 'page_type' => $page_type, 'country_array' => $country_array);
		$this->load->view('user_profile', $data);
	}
	
	function update_profile()
	{
		$user_type = $_REQUEST['user_type'];
		$page_type = $_REQUEST['page_type'];
		$id = $_REQUEST['id'];
		$username = trim($_REQUEST['username']);
		$number = trim($_REQUEST['number']);
		$password = trim($_REQUEST['password']);
		$email = trim($_REQUEST['email']);
		$photo = trim($_REQUEST['photo']);
		$code = trim($_REQUEST['code']);

		if ($username == '' || $email == '' || $password == '' || $code == '') {
			$error = 'Please fill in empty fields.';			
		} else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		    $error = 'Invalid email format';
		} else {
			$error = '';
			$this->load->model('model');
			$result = $this->model->update_profile($id, $username, $email, $password, $code, $number,$photo, $user_type, $page_type, $error);
		}

		$this->edit_profile($page_type, $id, $user_type, $error);
	}

	function image_upload()
    {	    	//FCPATH
		$config['upload_path']          =  FCPATH.'uploadImages/user/';
        $config['allowed_types']        = 'gif|jpg|png';
        $config['max_size']             = 5000;
        $config['max_width']            = 4000;
        $config['max_height']           = 3000;
		$config['file_name'] 			= time();
		$config['overwrite']			= TRUE;
		
        $this->load->library('upload', $config);
        if ( ! $this->upload->do_upload('file'))
        {
            $error = array('error' => $this->upload->display_errors());
			// var_dump($config['upload_path']);
			echo 400;
        }
        else
        {
			$img_info = $this->upload->data();
            $image_info = array('full_path' => $img_info['full_path']);
            $url = base_url()."uploadImages/user/";
            $info = pathinfo($img_info['full_path']);
            $filename = $info['filename'];
            $extension = $info['extension'];
            $real_url = $url.$filename.'.'.$extension;
            $image_info = array('full_path' => $real_url);
			echo $filename.'.'.$extension;
        }    
	} 
}
?>