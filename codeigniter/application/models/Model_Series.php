<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');                                             

class Model_Series extends CI_Model {
	public function __construct(){
		$this->load->database();
	}
	public function getSeries($id){
	if($id!==null){	
		$query = $this->db->query("
			SELECT DISTINCT tvshow.name,tvshow.originalName,tvshow.homepage,tvshow.overview,poster.jpeg,(SELECT COUNT(*) from season
						 WHERE season.tvShowId = tvshow.id) as nb,note.note,note.nombre
						  FROM poster JOIN tvshow on poster.id=tvshow.posterid LEFT JOIN note ON tvshow.id = note.idserie AND note.idsaison = -1 JOIN tvshow_genre on tvshow.id=tvshow_genre.tvshowid where tvshow.id = $id;"
		);
		
	return $query->result();}
	else{return null;}
	}

	public function getGenre($id){
		if($id!==null){	
		$query = $this->db->query("
			SELECT name from genre join tvshow_genre on genre.id=tvshow_genre.genreid WHERE tvshow_genre.tvshowid=$id;"
		);
		
	return $query->result();}
	else{return null;}
	}

	public function getSaisons($idseason,$idseries){
		if($idseason!==null){
			$query = $this->db->query("
				SELECT name,overview,episodeNumber FROM episode where seasonid=$idseason;"
		
		);}
		elseif($idseries!==null){
			$query = $this->db->query("
				SELECT season.id,name,jpeg,note FROM season join poster on season.posterid=poster.id LEFT JOIN note ON tvshowid = note.idserie AND note.idsaison = season.id WHERE tvshowid=$idseries"
		
		);
		}
		else{return null;}
	return $query->result();
	}

	public function getPoster($idseason){
		$query = $this->db->query("SELECT jpeg,note,nombre from poster join season on poster.id=season.posterid LEFT JOIN note ON tvshowid = note.idserie AND note.idsaison = season.id where season.id=$idseason");
		return $query->result();
	}

	public function saveComment($comment,$note,$Series_Choice,$Saisons_Choice){
		if($Saisons_Choice ===null)$Saisons_Choice=-1;
		$this->db->query("INSERT INTO comment (pseudo,commentaire,note,idserie,idsaison) VALUE ('{$_SESSION['pseudo']}','$comment',$note,$Series_Choice,$Saisons_Choice);");
	}

	public function getComment($Series_Choice,$Saisons_Choice){
		if($Saisons_Choice ===null)$Saisons_Choice=-1;
		$query = $this->db->query("SELECT pseudo,commentaire,note from comment where idserie=$Series_Choice and idsaison=$Saisons_Choice;");
		return $query->result();
	}

	public function reload_data(){
		$query = $this->db->query("SELECT * FROM comment");
		$list = $query->result();
		foreach ($list as $comment) {
			$idseries=$comment->idserie;
			$idsaison=$comment->idsaison;
			$idsaisontemp=$idsaison;
			if($idsaison==-1)$idsaison="'%'";
			$query = $this->db->query("SELECT note from comment where idserie=$idseries and idsaison like $idsaison;");
			$listnote=$query->result();
			$count=0;
			$note=0;
			foreach ($listnote as $list_note){
				$count=$count+1;
				$note=$note+$list_note->note;
			}
			$idsaison=$idsaisontemp;
			$note_moy=$note/$count;
			$this->db->query("delete from note where idserie=$idseries and idsaison=$idsaison;");
			$this->db->query("insert into note value ('$note_moy','$idseries','$idsaison','$count');");
		}
		return true;
	}
}

