<?php
	require_once dirname(__FILE__)."/dbconfig.php";//引入db配置文件
	
	class db{
		public $conn = null;//连接资源句柄
		public function __construct($config){
			$this -> conn = mysql_connect($config['host'],$config['username'],$config['password']) or die (mysql_error());
			mysql_select_db($config['database'],$this -> conn) or die (mysql_error());
			mysql_query("set names ".$config['charset']) or die (mysql_error());
		}
		
		//根据传入的sql语句，查询mysql结果集
		public function getResult($sql){
			$resource = mysql_query($sql,$this -> conn) or die (mysql_error());
			$res = array();
			while (($row = mysql_fetch_assoc($resource))!=false){
				$res[] = $row;
			}
			return $res;
		}
		
		public function getDataByGrade($grade){
			$sql = "select username,score,class from user where grade = ".$grade." order by score desc";
			$res = self::getResult($sql);
			return $res;
		}
	}
?>