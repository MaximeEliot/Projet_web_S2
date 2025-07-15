<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Series extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('model_Series');

	}
	public function index(){
		session_start();
		$Series_Choice = filter_input(INPUT_GET, 'Series',FILTER_VALIDATE_INT,['options'=>['default'=>null]]);
		$Saisons_Choice = filter_input(INPUT_GET, 'Saisons',FILTER_VALIDATE_INT,['options'=>['default'=>null]]);
		$comment = filter_input(INPUT_POST, 'comment',FILTER_DEFAULT);
		$note = filter_input(INPUT_POST,'rating',FILTER_VALIDATE_INT,['options'=>['default'=>null,'min_range'=>1,'max_range'=>5]]);
		if($comment !==null && $comment !==false && $note !==null){
			$this->model_Series->saveComment($comment,$note,$Series_Choice,$Saisons_Choice);
		}
		$this->model_Series->reload_data();
		$commentaire = $this->model_Series->getComment($Series_Choice,$Saisons_Choice);
		$Series = $this->model_Series->getSeries($Series_Choice);
		$Genres = $this->model_Series->getGenre($Series_Choice);
		$Saisons = $this->model_Series->getSaisons($Saisons_Choice,$Series_Choice);
		$poster = "";
		if($Saisons_Choice!=null){
			$poster= $this->model_Series->getPoster($Saisons_Choice);
		}
		$this->load->view('layout/header_series');
		$this->load->view('Series_info',['Series'=>$Series,'Saisons'=>$Saisons,'Genre'=>$Genres,'Series_Choice'=>$Series_Choice,'Saisons_Choice'=>$Saisons_Choice,'poster'=>$poster,'commentaire'=>$commentaire]);
		$this->load->view('layout/footer');
	}
}
?>