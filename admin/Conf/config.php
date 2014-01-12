<?php
if (!defined('THINK_PATH'))	exit();
$config = require("config.inc.php");
$array =array(
	//'配置项'=>'配置值'
	'USER_AUTH_ON'			=>		true, 			//开启认证
	'USER_AUTH_TYPE'		=>		1,  			//用户认证使用SESSION标记
	'USER_AUTH_KEY'			=>		'authId',  		//设置认证SESSION的标记名称
	'USER_AUTH_GATEWAY'		=>		'/Public/login',//默认的认证网关
	'NOT_AUTH_MODULE'		=>		'Public',  		//默认不需要认证的模块'A,B,C'
	'USER_AUTH_MODEL'		=>		'User',  		//验证用户的表模型joys_user
	'ADMIN_AUTH_KEY'		=>		'administrator',//管理员用户标记
	'RBAC_ROLE_TABLE'		=>		'think_role',
	'RBAC_USER_TABLE'		=>		'think_role_user',
	'RBAC_ACCESS_TABLE'		=>		'think_access',
	'RBAC_NODE_TABLE'		=>		'think_node',
	'LANG_SWITCH_ON' => true,
    'DEFAULT_LANG' => 'zh-cn', // 默认语言
    'LANG_AUTO_DETECT' => true, // 自动侦测语言
	'PAGESIZE'				=>		10,
);
return array_merge($config,$array);
?>