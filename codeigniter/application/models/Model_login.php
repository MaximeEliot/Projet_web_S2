<?php 

	if ( ! defined('BASEPATH')) exit('No direct script access allowed');        

	class Model_login extends CI_Model {
		public function __construct(){
			$this->load->database();
		}
		 
		 public function getPassword($log){
		 	$res = null;
		 	if($log!==null){	
			$query = $this->db->query("SELECT password FROM Comment_user WHERE login ='$log';");
			foreach ($query->result() as $temp ) {
				$res = $temp->password;
			}
		 }
		 return $res;

		}
		public function getPseudo($log){
			$res=null;
			if($log!==null){
				$query=$this->db->query("SELECT pseudo FROM Comment_user WHERE login ='$log';");
				foreach ($query->result() as $temp) {
					$res = $temp->pseudo;
				}
			}
		return $res;
		}


			
	}

	
?>