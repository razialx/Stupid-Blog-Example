<?php
// Fake Blogging Engine
// Load the functions for reading blog posts
include('lib/blog.php');
include('lib/cache-apc.php');
// Load the header content
if(cache_start('header')){

} else {
	include('template/header.php');
	cache_stop();
}
// Get requested blog post, or if none specified get homepage (post_id===0)
$post_id = intval($_GET['post_id']);
$cat_id = intval($_GET['cat_id']);
$cache_id = ($post_id? 'page'. $post_id: ($cat_id? 'category'.$cat_id:'homepage'));

if(!cache_start($cache_id))
{
	if($post_id) {
		load_post($post_id);
	} 
	else {
		list_posts(intval($_GET['cat_id']));
	}
	cache_stop();
}
else {
//	echo "CACHED";
}
if(!cache_start('footer')){
	// Load the footer content 
	include('template/footer.php');
	cache_stop();
}
?>