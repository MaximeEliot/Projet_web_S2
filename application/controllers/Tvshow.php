<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Tvshow extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('model_tvshow');

	}
	public function index(){
		session_start();
		$this->model_tvshow->reload_data();
		$select_genre = filter_input(INPUT_GET, 'type',FILTER_VALIDATE_INT);
		$search= "%".filter_input(INPUT_GET, 'search',FILTER_DEFAULT)."%";
		$tvshow = $this->model_tvshow->getTvshow($select_genre,$search);
		$genres = $this->model_tvshow->getGenre();
		$this->load->view('layout/header',['genres'=>$genres]);
		$this->load->view('tvshow_list',['tvshow'=>$tvshow]);
		$this->load->view('layout/footer');
	}
}
?>