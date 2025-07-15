<?php 
if($Saisons_Choice==null){
	foreach ($Series as $serie) {
		$note=$serie->note;
		$nombre=$serie->nombre;
		if($note==null)$note=0;
		if($nombre==null)$nombre=0;
		echo "<article>";
		echo "<header class='short-text'>";
		echo "<h3>{$serie->name}</h3>";
		echo "</header>";
		echo '<img src="data:image/jpeg;base64,'.base64_encode($serie->jpeg).'" />';
		echo "<p>Note: $note/5 </p>";
		echo "<p>nombre d'avis: $nombre </p>";
		echo "<p>{$serie->overview} </p>";
		echo "<a href='{$serie->homepage}'>regarder</a>";

		
	}

	echo "<table>";
	foreach ($Saisons as $saison) {
		$note = $saison->note;
		if($note==null)$note=0;
		echo "<tr><th><a href='?Series=$Series_Choice&Saisons={$saison->id}'>{$saison->name}</a></th><th><p>$note/5</p></th></tr>";
	}
	echo "</table>";
	echo "</article>";
}

else{
	echo "<article>";
	foreach ($poster as $Poster){
		$note=$Poster->note;
		$nombre=$Poster->nombre;
		if($note==null)$note=0;
		if($nombre==null)$nombre=0;
	echo '<img src="data:image/jpeg;base64,'.base64_encode($Poster->jpeg).'" />';
	echo "<p>Note: $note/5</p>";
	echo "<p>nombre d'avis: $nombre</p>";
	}
	echo "<table>";
	foreach ($Saisons as $saison){
		echo "<tr><td>{$saison->episodeNumber}</td><td>{$saison->name}</td><td>{$saison->overview}</td></tr>";
	}
	echo "</table>";
	echo "</article>";
}
echo "<h2>Commentaire</h2>";
if(isset($_SESSION['login'])){
	echo "<form method='post'>
		  <label for='comment'>Votre commentaire :</label><br>
		  <textarea id='comment' name='comment' rows='4' cols='50' required></textarea><br><br>

		  <label for='rating'>Votre note :</label><br>
		  <select id='rating' name='rating' required>
		    <option value=''>--Choisissez une note--</option>
		    <option value='1'>1 - Très mauvais</option>
		    <option value='2'>2 - Mauvais</option>
		    <option value='3'>3 - Moyen</option>
		    <option value='4'>4 - Bon</option>
		    <option value='5'>5 - Excellent</option>
		  </select><br><br>
		<input type='submit' value='commenter'>
		</form>";
}

foreach ($commentaire as $comment) {
	echo "<article>";
	echo "<table class='divisor'>";
	echo "<tr><th>{$comment->pseudo}</th><th>{$comment->note}/5</th></tr>";
	echo "<tr><th>{$comment->commentaire}</th></tr>";
	echo "</table>";
	echo "</article>";
}

