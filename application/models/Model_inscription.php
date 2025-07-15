<?php 

	if ( ! defined('BASEPATH')) exit('No direct script access allowed');        

	class Model_inscription extends CI_Model {
		public function __construct(){
			$this->load->database();
		}

		public function inscript($log,$psswd,$pseudo){
			if($psswd!==null && $log!==null && $pseudo!==null){
				$query = $this->db->query("INSERT INTO Comment_user VALUES ('$log','$psswd','$pseudo');");
				return $query;}
		else{return null;}
		
		}
	}
?>