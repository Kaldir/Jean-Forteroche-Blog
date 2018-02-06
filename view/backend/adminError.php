<?php $title = 'Erreur';
ob_start(); ?>

<div class="news">
	<p>Erreur !</p>
	<?php echo $error; ?>
</div>

<?php $content = ob_get_clean();
require('./view/backend/adminTemplate.php'); ?>