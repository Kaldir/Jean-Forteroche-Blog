<!doctype html>
<html lang="fr">
	<head>
	    <meta charset="utf-8" />
	    <title><?php echo $title ?></title>
	   	<meta name="description" content="Jean Forteroche : Billet simple pour l'Alaska..." />
	    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" />
		<link rel="stylesheet" href="public/css/style.css" type="text/css" />
	    <meta name="viewport" content="initial-scale=1.0" />
	    <link rel="icon" type="image/png" href="img/favicon.png" />
	</head>

	<body>
		<div id="header">
		    <div class="container">
		        <div class="row headerRow">
		            <h1><a href="index.php">Jean Forteroche</a></h1>
		            <h2>Billet simple pour l'Alaska</h2>
		        </div>
		    </div>
		</div>

		<div id="content">
		    <div class="container">
		        <div class="row">
		            <div class="choice col-md-3">
		                <img src="./public/img/leather.jpg" alt="logo_JF" id="logo_JF" />

		                <h4>Administration</h4>

		                <a href="index.php?action=adminViewPosts" method="post">Billets</a><br />
		                <a href="index.php?action=adminViewComments" method="post">Commentaires</a>               
		            </div>

					<?php echo $content ?>

					<div class="admin col-md-2">			
						<a href="index.php?action=listPosts">Déconnexion</a>
					</div>
				</div>
			</div>
		</div>

		<div id="footer">
			<div class="container">
				<div class="row footerRow">
					<p>Site créé par Lucie Kojadinovic - 2018</p>
				</div>
			</div>
		</div>

<!-- SCRIPTS -->

		<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script><script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
		<script src="https://use.fontawesome.com/bcf89603c7.js"></script>
	    <script src="public/js/tinymce/tinymce.min.js"></script>
  		<script>tinymce.init({ selector:'textarea' });</script>
	    <script src="public/js/tinymce/jquery.tinymce.min.js"></script>
		<script>$("p:empty").remove();</script> <!-- permet d'enlever les <p> vides générés par tinyMCE -->

	</body>
</html>