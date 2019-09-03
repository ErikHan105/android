<?php

class Service_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    function add_video($arr_data)
    {
    	$arr_data['created'] = time();
    	$pos = strrpos($arr_data['url'], "=");
    	$id = substr($arr_data['url'], -1*(strlen($arr_data['url'])-$pos-1));
    	$arr_data['download'] = 'https://drive.google.com/uc?export=download&id='.$id;
    	$result = $this->db->get_where('tbl_video', array('url' => $arr_data['url'], 'deleted' => 0))->result_array();
    	if (count($result) > 0) {
    		return 400;
    	}
    	$this->db->insert('tbl_video', $arr_data);
    	return 200;
    }
    function get_myVideosByDeviceId($device_id, &$out_array)
    {
        $out_array = array();
        $result = $this->db->get_where('tbl_purchase', array('device_id' => $device_id, 'deleted' => 0))->result_array();
        for ($i=0; $i < count($result); $i++) { 
            $out_array[$i] = $this->db->get_where('tbl_video', array('id' => $result[$i]['video_id'], 'deleted' => 0))->result_array()[0];
        }
        return 200;
    }
    function purchase_report($video_id, $device_id, $price)
    {
        $this->db->insert('tbl_purchase', array('device_id' => $device_id, 'video_id' => $video_id, 'price' => $price, 'created' => time()));
        return 200;
    }

}

?>