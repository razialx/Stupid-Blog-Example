<!DOCTYPE html>
<html>
<head>
	<title>Blog Title!</title><!-- .. Snip other header elements .. -->
	<link rel='stylesheet' type='text/css' href='style.css'>
</head>
<body>
<h1><a href='?home'>Home</a></h1>
<ul class='navigation'>
<?
$db = new mysqli('localhost','username','password','blog');
$query = $db->prepare('select cat_name, id from categories order by cat_order asc');
$query->execute();
$query->bind_result($cat_name, $cat_id);
while($query->fetch()){
	?>
	<li><a href='?cat_id=<?php echo $cat_id; ?>' ><?php echo $cat_name; ?></a></li>
	<?php
}
$query->close();
$db->close();
?>
</ul>
<div class='blog'>