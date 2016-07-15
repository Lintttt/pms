<?php
  
  /*
   * File: init.php
   * Name: 配置文件
   */ 
   
   header("Content-Type:text/html; charset=UTF-8");

   /*定义全局数据*/
   //define('ROOT_PATH', str_replace('config/init.php', '', str_replace('\\', '/', __FILE__)));
   date_default_timezone_set('Asia/Shanghai');
   $rootdir = dirname(dirname(__FILE__));
   //ini_set("error_reporting","E_ALL & ~E_NOTICE");
  
   /*加载文件*/
   require_once($rootdir.'/db/database.php'); 
   require_once($rootdir.'/db/db.php');

   $db     = new DB($config);

   $home = "/Bio/Project/Web/htdocs/";
?>
