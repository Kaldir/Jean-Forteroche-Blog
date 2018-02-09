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
		<div class="container-fluid">
			<div class="row introContainer">
				<div id="header" class="col-md-4">
					<div id="titleBlog">
			            <a href="index.php"><img id="leather" src="./public/img/leather2.png" />
			            <h2>Billet simple pour l'Alaska</h2></a>
			        </div>
		       
			        <div id="biography">
			                <strong><p>Acteur renommé mais également écrivain, Jean Forteroche vous propose aujourd'hui de découvrir son dernier livre, par publication régulière, sur son blog spécialement dédié.</p></strong>
			        </div>

					<div id="adminPart">
						<div id="adminLinks">
							<a href="mailto:jean-forteroche@kldr.com"><i class="fa fa-envelope-o fa-2x" aria-hidden="true"></i></a>
							<a href=""><i class="fa fa-facebook-square fa-2x" aria-hidden="true"></i></a>
							<a href=""><i class="fa fa-twitter fa-2x" aria-hidden="true"></i></a>
						</div>
						
						<a href="index.php?action=loginForm">
							<div class="buttonStyle">Connexion administrateur</div>
						</a>
					</div>

					<div class="footer">
						<p>Site créé par Lucie Kojadinovic - 2018</p>
					</div>
				</div>

				<div id="content" class="content col-md">
			        <?php echo $content ?>
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

	<?php
	if (!empty($signalised)) {
	?>
	    <script> $('#modalSignal').modal('show'); </script> <!-- display la modal lorsqu'un commentaire est signalé (passe en true dans la bdd) -->
	<?php
	}
	?>
	</body>
</html>