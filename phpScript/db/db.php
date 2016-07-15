<?php

  /*
   * name: DB.php
   * Modified on: 2014-4-17
   *
   */
   
class DB
{

	var $_type = 'mysql';
	var $_host = '';     //主机
	var $_user = '';     //用户名
	var $_pwd  = '';     //密码
	var $_db   = '';     //数据库
	var $_conn = null;       
	
	/**
	* 构造函数
	*/
	function DB($ar = array('dbhost'=>'localhost', 'dbuser'=>'root', 'dbpasw'=>'', 'dbname'=>''))
	{
	   $this->_host = $ar['dbhost'];
	   $this->_user = $ar['dbuser'];
	   $this->_pwd  = $ar['dbpasw'];
	   $this->_db   = $ar['dbname'];
	   
	   $this->_open($this->_db);
	}
	
	/**
	* 执行查询
	*/
	function query($sql)
	{  
	   mysql_select_db($this->_db);
	   //$rs = mysql_query($sql) OR $this->_quit("Query error: <!-- $sql -->");
	   $rs = @mysql_query($sql); 
	   return $rs;
	}
	
	/**
	* 返回某一单独字段值的查询。例如SELECT COUNT(id) FROM ...
	*/
	function getOne($sql)
	{
	   $rs = $this->query($sql);
	   if(!is_resource($rs)){
		return null;	
	   }
	   $arr = mysql_fetch_array($rs, MYSQL_NUM);
	   mysql_free_result($rs);     
	   
	   return $arr[0];
	}
	
	/**
	* 只返回一行的查询
	*/
	function getRow($sql)
	{
	   $rs = $this->query($sql);
	   if(!is_resource($rs)){
		return null;	
	   }
	   $arr = mysql_fetch_array($rs, MYSQL_ASSOC);
	   mysql_free_result($rs);
	   
	   return $arr;
	}
	
	/**
	* 返回多行的查询
	*/
	function getRows($sql)
	{
	   $result = $this->query($sql);
	   if(!is_resource($result)){
		return null;	
	   }
	   $arr = array();
	   while ($row = mysql_fetch_array($result, MYSQL_ASSOC))
	   {
		   $arr[] = $row;
	   }
	   mysql_free_result($result);
	   
	   return $arr;
	}
	
	/**
	* 分页查询
	*/
	function getPages($sql, $page = '1', $pageSize = '20')
	{
	   $start = ($page - 1) * $pageSize;
	   $arr = $this->getRows($sql . " LIMIT $start, $pageSize");
	   
	   return $arr;
	}
	
	/**
	* 关闭数据库
	*/
	function close()
	{
	   mysql_close();
	} 
	
	/**
	* 打开数据库
	*/
	function _open($database = 'test')
	{
	   @$this->_conn = mysql_connect($this->_host, $this->_user, $this->_pwd) || $this->_quit('Connect error: ');
	   
	   if ($this->_getDbVersion() >= 4.1)
	   {
		   mysql_query('SET NAMES utf8');
	   }
	   
	   return mysql_select_db($database);
	}
	
	
	/**
	* 获取数据库版本
	*/
   function _getDbVersion()
   {
	 $rs = mysql_query("SELECT VERSION();");
	 $row = mysql_fetch_array($rs, MYSQL_NUM);
	 
	 $ver = $row[0];
	 $vers = explode(".", trim($ver));
	 $ver = $vers[0] . ".".$vers[1];
	 
	 return $ver;
   }
	
	/**
	* 退出
	*/
	function _quit($msg = 'Error: ')
	{
	   exit($msg . mysql_error());
	   
	   return false;
	}
	
	
	/**
	* 获取列
	*/
	function getCol($sql)
	{
	  $res = $this->query($sql);
	  if ($res !== false)
	  {
		  $arr = array();
		  while ($row = mysql_fetch_row($res))
		  {
			  $arr[] = $row[0];
		  }
	
		  return $arr;
	  }
	  else
	  {
		  return false;
	  }
	}
	
	//自动操作插入、删除  
	function autoExecute($table, $field_values, $mode = 'INSERT', $where = '', $querymode = '')
	{
		$field_names = $this->getCol('DESC ' . $table);
		
		$sql = '';
		if ($mode == 'INSERT')
		{
			$fields = $values = array();
			foreach ($field_names AS $value)
			{
				if (array_key_exists($value, $field_values) == true)
				{
					$fields[] = $value;
					$values[] = "'" . $field_values[$value] . "'";
				}
			}
		
			if (!empty($fields))
			{
				$sql = 'INSERT INTO ' . $table . ' (' . implode(', ', $fields) . ') VALUES (' . implode(', ', $values) . ')';
			}
		}
		else
		{
			$sets = array();
			foreach ($field_names AS $value)
			{
				if (array_key_exists($value, $field_values) == true)
				{
					$sets[] = $value . " = '" . $field_values[$value] . "'";
				}
			}
		
			if (!empty($sets))
			{
				$sql = 'UPDATE ' . $table . ' SET ' . implode(', ', $sets) . ' WHERE ' . $where;
			}
		}
		
		if ($sql)
		{
			return $this->query($sql, $querymode);
		}
		else
		{
			return false;
		}
	}

}
?>
