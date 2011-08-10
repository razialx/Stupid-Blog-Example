<?php
include_once('Zend/Cache.php');
set_include_path(get_include_path() . PATH_SEPARATOR . dirname(__FILE__) );
//$_cache_id = array();
$frontend = array('lifetime' => NULL );
$backend = array('cache_dir' => '/tmp/cache');
$_cache = Zend_Cache::factory(
	'Output',
	'Apc',
	$frontend,
	$backend
	);
function cache_start($id){
	
	global $_cache;
	return $_cache->start($id);
}
function cache_stop(){
	
	global $_cache;
	$_cache->end();
}

function cache_get_filename($id)
{
	return sys_get_temp_dir() . '/cache/c_' . preg_replace('/[\\\\|\&|\/|\^|\:|\?|<|>|\*\|]/','',$id) . '.cache';
}