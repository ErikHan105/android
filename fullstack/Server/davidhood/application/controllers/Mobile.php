<?php

    class Mobile extends CI_Controller
    {
	    function __construct()
	    {
	        parent::__construct();
	    	$this->load->helper('url');
			$this->load->model('mobile_model');
	    }
        
        function index()
        {
        	$status = 400;
			$out_array = array();
			$type = $_REQUEST['type'];
			switch ($type) {
				case 'login':
					$status = $this->mobile_model->login($_REQUEST['email'], $_REQUEST['password'], $out_array);
					break;
				case 'check_email':
					$status = $this->mobile_model->check_email($_REQUEST['email']);
					break;
				case 'signup':
					$param = json_decode($_REQUEST['param']);
					$status = $this->mobile_model->signup($param->lang, $param->first_name, $param->last_name, $param->email, $param->password, $param->birth_date, $param->address, $param->city, $param->postal_code, $param->iban, $out_array);
					break;
				case 'get_advertisement':
					$status = $this->mobile_model->get_advertisement($_REQUEST['user_id'], $out_array);
					break;
				case 'check_transfer':
					$status = $this->mobile_model->check_transfer($_REQUEST['user_id'], $out_array);
					break;
				case 'ask_transfer':
					$status = $this->mobile_model->ask_transfer($_REQUEST['user_id']);
					break;
				case 'profile_update':
					$status = $this->mobile_model->profile_update($_REQUEST['id'], $_REQUEST['email'], $_REQUEST['password'], $out_array);
					break;
				case 'read_video':
					$status = $this->mobile_model->read_video($_REQUEST['user_id'], $_REQUEST['advertise_id'], $out_array);
					break;
				case 'ask_question':
					$status = $this->mobile_model->ask_question($_REQUEST['email'], $_REQUEST['subject'], $_REQUEST['body']);
					$status = $this->send_email($_REQUEST['email'], $_REQUEST['subject'], $_REQUEST['body']);
					break;
				// case 'get_videos':
				// 	$this->load->model('user_model');
				// 	$out_array = $this->user_model->get_statisticsByDay('tbl_video', 'all');
				// 	$status = 200;
				// 	break;
				// case 'get_my_videos':
				// 	$this->load->model('service_model');
				// 	$status = $this->service_model->get_myVideosByDeviceId($_REQUEST['device_id'], $out_array);
				// 	break;
				// case 'purchase_report':
				// 	$this->load->model('service_model');
				// 	$status = $this->service_model->purchase_report($_REQUEST['video_id'], $_REQUEST['device_id'],$_REQUEST['price']);
				// 	break;



				default:
					break;
			}
			echo json_encode(array('status' => $status, 'data' => $out_array));
        }

  		function send_email($email, $subject, $body)
		{
			$subject = $subject.'from '.$email;
			$site_email = SERVER_EMAIL;	//who does this mail get sent from (must be in the same domain as this site)
			$headers = "From: ". $email . "\r\n";
			
			if (!mail (ADMIN_EMAIL, $subject, $body, $headers)) {
				return 400;
				// echo "Couldn't send mail";
			}
			return 200;
		
		}

   }
?>