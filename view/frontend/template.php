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
	    <script src="https://use.fontawesome.com/bcf89603c7.js"></script>
	</head>

	<body>
		<div id="header">
		    <div class="container">
		        <div class="row headerRow">
		            <h1>Jean Forteroche</h1>
		            <h2>Billet simple pour l'Alaska</h2>
		        </div>
		    </div>
		</div>

		<div id="content">
		    <div class="container">
		        <div class="row">
		            <div class="biography col-md-3">
		                <img src="./public/img/leather.jpg" alt="logo_JF" id="logo_JF" />

		                <h4>Biographie</h4>

		                <p>Jean Forteroche, principalement connu pour ses rôles dans des films français renommés, est avant tout un grand écrivain. Pour rester au plus proche de ses nombreux fans, il vous propose aujourd'hui de découvrir son dernier livre, avec une publication régulière de chaque chapitre, sur son blog spécialement dédié à celui-ci. Vous pourrez commenter chaque publication grâce au formulaire de commentaire situé sous chaque billet.</p>
		            </div>

					<?php echo $content ?>

					<div class="admin col-md-2">			
						<div id="contact">
							<h4><a href="mailto:jean-forteroche@kldr.com"><i class="fa fa-envelope-o fa-3x" aria-hidden="true"></i>Contact</a></h4>
						</div>

						
						<div id="socialNetwork">
							<p>Réseaux sociaux</p>
							<i class="fa fa-facebook-square fa-2x" aria-hidden="true"></i>
							<i class="fa fa-twitter fa-2x" aria-hidden="true"></i>
						</div>

						<p>Connexion administrateur</p>
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
	</body>
</html>