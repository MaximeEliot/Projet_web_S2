<h6>Liste des séries</h6>
<section class="list">
<?php
foreach($tvshow as $show){
	$note = $show->note;
	$nombre = $show->nombre;
	if($note==null||$nombre==null){
		$note = 0;
		$nombre = 0;
	}
	echo "<article>";
	echo "<header class='short-text'>";
	echo anchor("/Series?Series={$show->id}&Saisons=","{$show->name}");
	echo "</header>";
	echo '<img src="data:image/jpeg;base64,'.base64_encode($show->jpeg).'" />';
	echo "<footer class='short-text'>{$show->nb} saisons</footer>";
	echo "<footer class='short-text'>$note/5 </footer>";
	echo "<footer class='short-text'>$nombre notations</footer>";
	echo "</article>";
}
?>
</section>
