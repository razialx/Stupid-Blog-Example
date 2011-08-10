<!-- END div.blog -->
</div>
<ul class='footer'>
<?
$db = new mysqli('localhost','username','password','blog');
$query = $db->prepare('select link from footer order by footer_order asc');
$query->execute();
$query->bind_result($link);
while($query->fetch()){
	?>
	<li><?php echo $link; ?></li>
	<?php
}
$query->close();
$db->close();
?>
</ul>
</body>
</html>