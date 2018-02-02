<?php
$actionAdmin = '';
if ($_SESSION['admin'] == true) {
	$actionAdmin = 'action=adminViewPosts&';
}
$pagination = '<div class="pagination">';
$nbPost = ceil($nbPost/5); // nombre de billet divisé par 5
$pagination .= ''; // '.=' est égal à : 'ajouter à', en php
for ($i = 1; $i < $nbPost + 1; $i++) {
	$pagination .= "<div class='divNumber'><div class='nb'><a href='index.php?". $actionAdmin ."page=". $i ."'>". $i ." </a></div></div>";
}
$pagination .= '</div>';