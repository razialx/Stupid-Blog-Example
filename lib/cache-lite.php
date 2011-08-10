<?php
set_include_path(get_include_path() . PATH_SEPARATOR . dirname(__FILE__) );
require_once('Cache/Lite.php');
$options = array ( 'cacheDir'=>'/tmp/cache/', 'lifeTime'=>NULL, 'fileLocking'=>false,'writeControl'=>false,'readControl'=>false);
$_cache = new Cache_Lite($options);
function cache_start($id){
	global $_cache;
	
	
	if($data = $_cache->get($id)){
		echo $data;
		//echo "CACHED";
		return true;
	}
	ob_start(); //Turn on output buffering
	return false;
}
function cache_stop(){
	global $_cache;
	
	
	//The in-memory version of what generate_some_page produced
	$page_to_cache = ob_get_contents(); 
	
	$_cache->save($page_to_cache);
	ob_end_flush(); //Write in-memory version out to the client
}

function cache_get_filename($id)
{
	return sys_get_temp_dir() . '/cache/c_' . preg_replace('/[\\\\|\&|\/|\^|\:|\?|<|>|\*\|]/','',$id) . '.cache';
}