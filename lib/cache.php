<?php

$_cache_id = array();
function cache_start($id){
	$filename = cache_get_filename($id);
	if(file_exists($filename)){
		include($filename);
		return true;
	}
	global $_cache_id;
	array_push($_cache_id, $id);
	ob_start(); //Turn on output buffering
	return false;
}
function cache_stop(){
	global $_cache_id;
	$_id = array_pop($_cache_id);
	if($_id===null){
		/*... snip error handing code...*/
	}
	//The in-memory version of what generate_some_page produced
	$page_to_cache = ob_get_contents(); 
	//Remove any characters in ID that would be invalid in a filesystem. 
	//$cache_filename = 'c_' . preg_replace('/[\\\\|\&|\/|\^|\:|\?|<|>|\*\|]/','',$_id) . '.cache';
	//echo cache_get_filename($_id);
	file_put_contents( cache_get_filename($_id), $page_to_cache);

	ob_end_flush(); //Write in-memory version out to the client
}

function cache_get_filename($id)
{
	return sys_get_temp_dir() . '/cache/c_' . preg_replace('/[\\\\|\&|\/|\^|\:|\?|<|>|\*\|]/','',$id) . '.cache';
}