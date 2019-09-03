<?php

class Mobile_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
		$this->load->database();
    }

    public function login($email, $password, &$data) {
    	$data = $this->db->get_where('tbl_user', array('email' => $email, 'password' => $password, 'deleted' => 0))->result_array();
    	if (count($data) == 0) {
    		return 400;
    	}
        $this->check_gain_log($data[0]['id']);
        $data = $this->db->get_where('tbl_user', array('email' => $email, 'password' => $password, 'deleted' => 0))->result_array();
    	return 200;
    }
    public function check_gain_log($user_id) {
        $user = $this->db->get_where('tbl_user', array('id' => $user_id))->result_array()[0];
        $result = $this->db->get_where('tbl_gain_log', array('user_id' => $user_id))->result_array();
        $cur_time = time();
        for ($i=0; $i < count($result); $i++) { 
            if (($cur_time-$result[$i]['created'])/3600/24 > 365) {
                $this->db->delete('tbl_gain_log', array('id' => $result[$i]['id']));
                $new_price = $user['price'] - $result[$i]['price'];
                if ($new_price < 0) {
                    $new_price = 0;
                }
                $this->db->where('id', $data[0]['id']);
                $this->db->update('tbl_user', array('price' => $new_price));
            }
        }
    }
    public function check_email($email) {
        $data = $this->db->get_where('tbl_user', array('email' => $email, 'deleted' => 0))->result_array();
        if (count($data) > 0) {
            return 400;
        }
        return 200;
    }
    public function check_iban($iban) {
        $data = $this->db->get_where('tbl_user', array('iban' => $iban, 'deleted' => 0))->result_array();
        if (count($data) > 0) {
            return 400;
        }
        return 200;
    }
    public function signup($lang, $first_name, $last_name, $email, $password, $birth_date, $address, $city, $postal_code, $iban, &$data) {
        $status = $this->check_email($email);
        if ($status == 400) {
            return 400;
        }
        $status = $this->check_email($iban);
        if ($status == 400) {
            return 401;
        }
        $data = array('email' => $email, 'password' => $password, 'lang' => $lang, 'first_name' => $first_name, 'last_name' => $last_name, 'birth_date' => $birth_date, 'address' => $address, 'city' => $city, 'postal_code' => $postal_code, 'iban' => $iban, 'created' => time(), 'price' => 0, 'paid' => 0);
        $this->db->insert('tbl_user', $data);
        $id = $this->db->insert_id();
        $data = $this->db->get_where('tbl_user', array('id' => $id))->result_array();
        return 200;
    }
    public function get_advertisement($user_id, &$data) {
        $lang = $this->db->get_where('tbl_user', array('id' => $user_id))->result_array()[0]['lang'];
        $data1 = $this->db->get_where('tbl_advertise', array('lang' => $lang, 'deleted' => 0))->result_array();
        for ($i=0; $i < count($data1); $i++) { 
            if ($data1[$i]['remains'] == 0) {
                continue;
            }
            $answer_arr = $this->db->get_where('tbl_answer', array('advertise_id' => $data1[$i]['id']))->result_array();

            $data1[$i]['answer'] = array();

            if (count($answer_arr) > 0) {
                $right_answer_arr = array();
                $wrong_answer_arr = array();
                for ($j=0; $j < count($answer_arr); $j++) { 
                    if ($answer_arr[$j]['isright'] == 1) {
                        array_push($right_answer_arr, $answer_arr[$j]);
                    } else {
                        array_push($wrong_answer_arr, $answer_arr[$j]);
                    }
                }
                if (count($right_answer_arr) > 0) {
                    array_push($data1[$i]['answer'], $right_answer_arr[rand(0,count($right_answer_arr)-1)]);
                }
                if (count($wrong_answer_arr) > 0) {
                    array_push($data1[$i]['answer'], $wrong_answer_arr[rand(0,count($wrong_answer_arr)-1)]);
                }
            }

            $result = $this->db->get_where('tbl_log', array('user_id' => $user_id, 'advertise_id' => $data1[$i]['id']))->result_array();
            $data1[$i]['created'] = 0; 
            if (count($result) == 0) {
                array_push($data, $data1[$i]);
                continue;
            }
            if ($data1[$i]['type'] == 'once') {
                $data1[$i]['created'] = $result[0]['updated']; 
                array_push($data, $data1[$i]);
                continue;
            }
            if ($result[0]['cnt'] > 0) {
                $data1[$i]['cnt'] = $result[0]['cnt']; 
                array_push($data, $data1[$i]);
            }
        }
        $this->check_gain_log($user_id);
        return 200;
    }
    public function check_transfer($user_id, &$data) {
        $this->check_gain_log($user_id);
        $data = $this->db->get_where('tbl_user', array('id' => $user_id))->result_array();
        $result1 = $this->db->get_where('tbl_purchase', array('user_id' => $user_id, 'status' => 0))->result_array();
        if (count($result1) > 0) {
            return 201;
        }
        return 200;
    }
    public function ask_transfer($user_id) {
        $result = $this->db->get_where('tbl_user', array('id' => $user_id))->result_array()[0];
        $result1 = $this->db->get_where('tbl_purchase', array('user_id' => $user_id, 'status' => 0))->result_array();
        if (count($result1) > 0) {
            $this->db->where('id', $result1[0]['id']);
            $this->db->update('tbl_purchase', array('updated' => time()));
        } else {
            $this->db->insert('tbl_purchase', array('user_id' => $user_id, 'price' => $result['price'], 'updated' => time()));
        }
        $this->db->delete('tbl_gain_log', array('user_id' => $user_id));
        return 200;
    }
    public function profile_update($id, $email, $password, &$data) {
        $result = $this->db->get_where('tbl_user', array('email' => $email))->result_array();
        if (count($result) > 0) {
            if ($result[0]['id'] != $id) {
                return 400;
            }
        }
        $this->db->where('id', $id);
        $this->db->update('tbl_user', array('email' => $email, 'password' => $password));
        $this->login($email, $password, $data);
        return 200;
    }
    public function read_video($user_id, $advertise_id, &$data) {
        $advertise = $this->db->get_where('tbl_advertise', array('id' => $advertise_id))->result_array()[0];
        $remains = $advertise['remains'];
        if ($remains == 0) {
            $remains = 0;
        } else {
            $remains = $remains - 1;
        }
        $this->db->where('id', $advertise['id']);
        $this->db->update('tbl_advertise', array('remains' => $remains));

        $new_cnt = 0;
        $log = $this->db->get_where('tbl_log', array('user_id' => $user_id, 'advertise_id' => $advertise_id))->result_array();
        if (count($log) == 0) {
            if ($advertise['type'] == 'multi') {
                $new_cnt = intval($advertise['cnt'])-1;
            }
            $this->db->insert('tbl_log', array('user_id' => $user_id, 'advertise_id' => $advertise_id, 'updated' => time(), 'cnt' => $new_cnt));
        } else {
            if ($advertise['type'] == 'multi') {
                $new_cnt = intval($log[0]['cnt'])-1;
            }
            $this->db->where('id', $log[0]['id']);
            $this->db->update('tbl_log', array('cnt' => $new_cnt, 'updated' => time()));
        }
        $data = $this->db->get_where('tbl_user', array('id' => $user_id))->result_array()[0];
        $new_price = $data['price']+$advertise['price'];
        $this->db->where('id', $user_id);
        $this->db->update('tbl_user', array('price' => $new_price));
        $data['price'] = $new_price;
        $this->db->insert('tbl_gain_log', array('user_id' => $user_id, 'price' => $advertise['price'], 'created' => time()));
        return 200;
    }
    function ask_question($email, $subject, $body) {
        $this->db->insert('tbl_question', array('email' => $email, 'subject' => $subject, 'body' => $body, 'created' => time()));
        return 200;
    }

}

?>