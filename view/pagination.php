<div class="pagination">
<?php
$nbPost = ceil($nbPost/5); // nombre de billet divisé par 5
for ($i = 1; $i < $nbPost + 1; $i++) {
?>
<div class='divNumber'><div class='nb'><a href='index.php?page=<?php echo $i; ?>'><?php echo $i; ?></a></div></div>
<?php
}
?>
</div>