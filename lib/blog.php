<?php 

function load_post($post_id)
{
	$db = new mysqli('localhost','username','password','blog');
	/* ... snip error checking ... */
	$query = $db->prepare('select content, title, post_date, author from posts where id=?');
	$query->bind_param('i', $post_id);
	$query->execute();
	$query->bind_result($content, $title, $post_date, $author);
	if(!$query->fetch()){
		/* ... Snip Error handling ... */
	}
	$query->close();
	$db->close();
	?>
	<h1><?php echo $title ?></h1>
	<h2>Written by <?php echo $author ?> on <?php echo $post_date ?></h2>
	<div class='blog-post'>
		<?php echo $content ?>
	</div>
	<?php
}
function list_posts($cat_id=null)
{
	$db = new mysqli('localhost','username','password','blog');
	/* ... snip error checking ... */
	if(!$cat_id){
		$query = $db->prepare('select id, title, post_date, author from posts order by post_date desc limit 10');
	}
	else {
		$query = $db->prepare('select id, title, post_date, author from posts where category_id=? order by post_date desc limit 10');
		$query->bind_param('i',$cat_id);
	}
	$query->execute();
	$query->bind_result($post_id, $title, $post_date, $author);
	while($query->fetch()){
		?>
		<h1><a href='?post_id=<?php echo $post_id; ?>' ><?php echo $title; ?></a></h1>
		<h2>Written by <?php echo $author; ?> on <?php echo $post_date ?></h2>
		<?php 
	}
	$query->close();
	$db->close();
}
?>