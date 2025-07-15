<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');                                             

class Model_tvshow extends CI_Model {
	public function __construct(){
		$this->load->database();
	}
	public function getTvshow($genre,$search){
		if($genre !==null && $genre>=0){
			$query = $this->db->query("
				SELECT tvshow.name,tvshow.id,jpeg,note.note,note.nombre,
						(SELECT COUNT(*) from season
						 WHERE season.tvShowId = tvshow.id) as nb
				FROM tvshow LEFT JOIN note ON tvshow.id = note.idserie AND note.idsaison = -1
				JOIN poster ON tvshow.posterId = poster.id WHERE lower(tvshow.name) like '$search'AND tvshow.id in (SELECT tvshowid FROM tvshow_genre where genreid = $genre);"
		
		);}
		elseif($genre==null){
			$query = $this->db->query("
				SELECT tvshow.name,tvshow.id,jpeg,note.note,note.nombre,
						(SELECT COUNT(*) from season
						 WHERE season.tvShowId = tvshow.id) as nb
				FROM tvshow LEFT JOIN note ON tvshow.id = note.idserie AND note.idsaison = -1
				JOIN poster ON tvshow.posterId = poster.id
				WHERE lower(tvshow.name) like '$search';"
		
		);
		}
		else{
			$genre=$genre*-1;
			$query = $this->db->query("
				SELECT tvshow.name,tvshow.id,jpeg,note.note,note.nombre,
						(SELECT COUNT(*) from season
						 WHERE season.tvShowId = tvshow.id) as nb
				FROM tvshow LEFT JOIN note ON tvshow.id = note.idserie AND note.idsaison = -1
				JOIN poster ON tvshow.posterId = poster.id WHERE lower(tvshow.name) like '$search'AND tvshow.id in (SELECT idserie FROM note where idsaison=-1 and note BETWEEN $genre-1 AND $genre);"
		
		);
			if($genre-1==0){
				$query = $this->db->query("
				SELECT tvshow.name,tvshow.id,jpeg,note.note,note.nombre,
						(SELECT COUNT(*) from season
						 WHERE season.tvShowId = tvshow.id) as nb
				FROM tvshow LEFT JOIN note ON tvshow.id = note.idserie AND note.idsaison = -1
				JOIN poster ON tvshow.posterId = poster.id WHERE lower(tvshow.name) like '$search'AND tvshow.id not in (SELECT idserie FROM note where idsaison=-1 and note BETWEEN 1 AND 5);"
		
		);
			}
		}
	return $query->result();
	}

	public function getGenre(){
		$query = $this->db->query("
			SELECT id,name
			FROM genre"
	);
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

