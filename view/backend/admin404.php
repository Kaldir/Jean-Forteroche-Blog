<?php $title = 'Page non trouvée';
ob_start(); ?>

<div class="news">
	<p>Page non trouvée !</p>
</div>

<?php $content = ob_get_clean();
require('./view/backend/adminTemplate.php'); ?>