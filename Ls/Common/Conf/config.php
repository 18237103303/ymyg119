<?php
return array(
	//'配置项'=>'配置值'
	//模块配置
	'APP_GROUP_LIST'=>'Admin,Home,App,User',
    'DEFAULT_GROUP'=>'Home',
	//数据库配置
    'DB_TYPE'      =>  'mysql',     // 数据库类型
    'DB_HOST'      =>  'localhost',     // 服务器地址
    'DB_NAME'      =>  'lx_ymy',     // 数据库名
    'DB_USER'      =>  'root',     // 用户名
    'DB_PWD'       =>  'root',     // 密码
    'DB_PORT'      =>  '3306',     // 端口
    'DB_PREFIX'    =>  'lx_',     // 数据库表前缀
   // 'DB_DSN'       =>  'mysql://root:root@localhost:3306/lx_hzl#utf8',     // 数据库连接DSN 用于PDO方式
    'DB_CHARSET'   =>  'utf8', // 数据库的编码 默认为utf8
    'SHOW_PAGE_TRACE' =>true,

    /*自己新增的*/
    'TOKEN_ON'      =>    true,  // 是否开启令牌验证 默认关闭
    'TOKEN_NAME'    =>    '__hash__',    // 令牌验证的表单隐藏字段名称，默认为__hash__
    'TOKEN_TYPE'    =>    'md5',  //令牌哈希验证规则 默认为MD5
    'TOKEN_RESET'   =>    true,  //令牌验证出错后是否重置令牌 默认为true
);