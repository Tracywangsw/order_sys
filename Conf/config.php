<?php
return array(
	//'配置项'=>'配置值'
	// DB Setting
        'DB_TYPE'               => 'mysql',         // datebase type
        'DB_HOST'               => 'localhost', // datebase ip address
        'DB_NAME'               => 'order_sys',       // datebase name
        'DB_USER'               => 'root',          // datebase username
        'DB_PWD'                => 'qwer1234',           // datebase password
	//开启默认模板
	'LAYOUT_ON' => true,
	'URL_MODEL' => 2,
	'LAYOUT_NAME' => 'layout',
	//'SHOW_PAGE_TRACE' => true,
	'TMPL_PARSE_STRING' => array(
		'__WEB__' => WEB_PATH,
	),
	//'SHOW_PAGE_TRACE' => true
);
?>
