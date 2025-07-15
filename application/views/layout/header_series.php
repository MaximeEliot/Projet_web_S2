<!doctype html>
<html lang="fr">
	<head>
		<meta charset="UTF-8" />
		<title>SERIES</title>
		<link
	  rel="stylesheet"
   href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.min.css"
   />
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

		<?=link_tag('assets/style.css')?>
	</head>
	<body>
		<main class='container'>
			<nav>
				<ul>
					<li><strong>Séries</strong></li>
					<li><a href="<?php echo site_url('/')?>"><i class="fas fa-home"></i></a></li>
					<?php if(isset($_SESSION['login'])) {echo "<li><a href='".site_url('users/disconnect')."'><i class='fas fa-user-slash'></i></a></li>";}
					else{echo "<li><a href='".site_url('users/login')."'><i class='fas fa-user'></i></a></li>";}?>
					<li><p><?php if(isset($_SESSION['pseudo'])){ echo $_SESSION['pseudo'];}?></p></li>
				</ul>
			</nav>
