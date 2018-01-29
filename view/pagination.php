<?php
$pagination = '<div class="pagination">';
$nbPost = ceil($nbPost/5); // nombre de billet divisé par 5
$pagination .= 'Page '; // .= permet 'd'ajouter à" en php
for ($i = 1; $i < $nbPost + 1; $i++) {
	$pagination .= "<a href='index.php?page=". $i ."'>". $i ." </a>";
}
$pagination .= '</div>';
?>