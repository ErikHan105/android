<?php
// include 'session.inc';
class Login extends CI_Controller
{
	protected $email = 'root';
	protected $password = 'root';
    
    function __construct()
    {
        parent::__construct();
    	$this->load->helper('url');
		$this->load->library('session');    
		$this->load->model('Admin_model');
    }
    
    function index()
    {
    	$data = array('email' => $this->email, 'password' => $this->password, 'error' => '');
        $this->load->view('login',  $data);   
    }
	
	function do_login()
	{	
		$status = 400;
		$out_array = array();
		$out_array['reason'] = "Invalid Information";	

		$email = trim($_REQUEST['email']);
		$password = trim($_REQUEST['password']);
		
		if ($email == "" || $password == "") {			
			$out_array['reason'] = "Please fill in email and password.";
		} else {
			$status = $this->admin_model->loginAdmin($email, $password, $out_array);
		}
		if ($status != 200) {
			$data = array('email' => $email, 'password' => $password, 'error' => $out_array['reason']);
        	$this->load->view('login',  $data);
		} else {
			$_SESSION[SITE] = $out_array;
			
			redirect(base_url().'main/advertisement', 'refresh');
		}		
	}
	
	function forgot_password($error = '')
	{		        
		$data = array('error' => $error);
		$this->load->view('forgot_password', $data);
	}
	function send_email()
	{
		$email = $_REQUEST['email'];
		if ($email == '') {
			$out_array['reason'] = 'Please input your email';
			$status = 400;
		} else {
			$status = $this->model->checkEmail($email, $out_array);
			if ($status == 200) {
				// send email func ----------------
				$body = "Please click the following url to reset your password. \n".base_url().'verify/forgot_password/'.$out_array['id'];
				$subject = "Reset password";
				$headers = "From: ". SERVER_EMAIL . "\r\n";
				
				if (!mail ($email, $subject, $body, $headers))
					echo "Couldn't send mail";
  				//-------------------------------
  				$out_array['reason'] = 'We have sent an email successfully. Please check your email';

			}	
		}
		$this->forgot_password($out_array['reason']);
	}
	function do_logout()
	{
		$_SESSION = array();
		session_destroy();
		
		redirect(base_url());
	}
	
}
?>