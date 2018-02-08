<?php $title = 'Page non trouvée';
ob_start(); ?>

<div class="news">
	<p>Page non trouvée !</p>
</div>

<?php $content = ob_get_clean();
if (empty($_SESSION['admin']))
	require('./view/frontend/template.php');
} else {
	require('./view/backend/adminTemplate.php');
}
?>