<?php
include 'session.inc';

class Verify extends CI_Controller
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
        $this->go_users();
    }

    function email($id = 0)
    {   
        $this->load->model('mobile_model');
        $result = $this->mobile_model->verify_email($id, $email);
        if ($result == 200) {
            $error = $email.' has been verified successfully';
        } else {
            $error = 'Invalid user!';
        }
        $data = array('error' => $error);
        $this->load->view('verify_email', $data);
    }
    function forgot_password($id = 0, $error = '')
    {   
        $array = array();
        $this->load->model('user_model');
        $result = $this->user_model->checkId($id, $array);
        if ($result != 200) {
            $array['email'] = '';
            $error = 'Invalid user!';
        }
        $data = array('error' => $error, 'email' => $array['email'], 'id' => $id);
        $this->load->view('set_password', $data);
    }
    function update_password()
    {
        $error = '';
        $id = $_REQUEST['id'];
        $password = trim($_REQUEST['password']);
        $conf_password = trim($_REQUEST['conf_password']);
        if ($password == '' || $conf_password == '' ) {
            $error = 'Please fill in empty field';
        } else if ($password != $conf_password) {
            $error = "Password doesn't match";
        } else {
            $this->load->model('user_model');
            $result = $this->user_model->update_password($id, $password, $error);
        }
        $this->forgot_password($id, $error);
    }

}
?>