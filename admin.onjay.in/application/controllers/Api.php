<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Api extends CI_Controller {

	public function search($data = 'a')
	{
//SELECT * FROM `myapp` WHERE `endDate` > CAST('2014-02-01' AS DATE)
        $this->load->database();
        $res = $this->db->query("SELECT DISTINCT serchText FROM `myapp` WHERE startDate < CURRENT_DATE  AND endDate > CURRENT_DATE AND serchText LIKE '".$data."%' LIMIT 10")->result_array();
        
        echo json_encode(array_map(function($data){ return $data['serchText']; },$res));       
	}

}