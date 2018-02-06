<?php $title = 'Erreur';
ob_start(); ?>

<div class="news">
	<p>Erreur !</p>
	<?php echo $message; ?>
</div>

<?php $content = ob_get_clean();
require('./view/frontend/template.php'); ?>