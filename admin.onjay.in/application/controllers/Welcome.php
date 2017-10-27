<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index($data = 'login')
	{
		//$this->load->view('welcome_message');

		$this->load->library('user_agent');
		if ($this->agent->is_browser())
		{
				$agent = $this->agent->browser().' '.$this->agent->version();
		}
		elseif ($this->agent->is_robot())
		{
				$agent = $this->agent->robot();
		}
		elseif ($this->agent->is_mobile())
		{
				$agent = $this->agent->mobile();
		}
		else
		{
				$agent = 'Unidentified User Agent';
		}
		$this->load->database();
		$ip = $this->input->ip_address();
		$this->db->query("INSERT INTO `log`(`userAgent`, `userIp`, `serchText`) VALUES ('$agent','$ip','$data')");
		$this->load->view('login');

	}
	public function show($data = 'login')
	{
		$this->load->library('user_agent');
		if ($this->agent->is_browser())
		{
				$agent = $this->agent->browser().' '.$this->agent->version();
		}
		elseif ($this->agent->is_robot())
		{
				$agent = $this->agent->robot();
		}
		elseif ($this->agent->is_mobile())
		{
				$agent = $this->agent->mobile();
		}
		else
		{
				$agent = 'Unidentified User Agent';
		}
		$this->load->database();
		$ip = $this->input->ip_address();
		$this->db->query("INSERT INTO `log`(`userAgent`, `userIp`, `serchText`) VALUES ('$agent','$ip','$data')");
		id($data == 'login')
		$this->load->view('login');

	}
}
