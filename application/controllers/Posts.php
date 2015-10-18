<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';

class Posts extends REST_Controller {

	function __construct() {

		header('Access-Control-Allow-Origin: *');
		header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
		header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
		$method = $_SERVER['REQUEST_METHOD'];
		if($method == "OPTIONS") {
			die();
		}
		parent::__construct();
	}

	public function index_options(){
		die();
	}
	public function index_get()
	{		
		$this->load->model('Posts_model','posts');
		$data = $this->posts->get_all();
		$this->response($data, 200);
	}
	
	public function index_post()
	{
		$data = $this->post();
		$this->load->model('Posts_model','posts');
		$id = $this->posts->insert($data);
				
		$this->response(array('id' => $id), 200);
	}
	public function index_delete()
	{
		$id = (int) $this->get('id');
		$data = $this->post();
		$this->load->model('Posts_model','posts');
		if($this->posts->delete($id))
			$this->response(array('ok' => 'Deleted'), 200);
		else
			$this->response(array('error' => 'Not deleted'), 400);
		
	}

	public function index_put()
	{	
		$this->load->model('Posts_model','posts');
		$data = $this->put();
		$this->questions->update($data);
		$this->response($this->index_get(), 200);
	}

}