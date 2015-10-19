<?php
	//获取excel文件并导入mysql数据库
	$dir = dirname(__FILE__);
	require_once $dir.'/PHPExcel.php';
	require_once $dir.'/PHPExcel/IOFactory.php';
	require_once $dir.'/PHPExcel/Reader/Excel5.php';
	mysql_connect("localhost","root","sa");
	mysql_select_db("phpexcel");
	mysql_query("set names utf8");
	//$filename = $dir.'/esport_1.xls';
	$a = $_POST['abd'];
	$filename = $dir."/".$a;
	$excel_name = iconv("gb2312","utf-8",$_POST['abd']);
	$objReader = PHPExcel_IOFactory::createReader('Excel5');//use excel2007 for 2007 format 
	$objPHPExcel = $objReader->load($filename); //$filename可以是上传的文件，或者是指定的文件
	$sheet = $objPHPExcel->getSheet(0); 
	$highestRow = $sheet->getHighestRow(); // 取得总行数 
	$highestColumn = $sheet->getHighestColumn(); // 取得总列数
	$k = 0;

	//循环读取excel文件,读取一条,插入一条
	for($j=2;$j<$highestRow;$j++)
	{
	$a = $objPHPExcel->getActiveSheet()->getCell("A".$j)->getValue();//获取A列的值
	$b = $objPHPExcel->getActiveSheet()->getCell("B".$j)->getValue();//获取B列的值
	$c = $objPHPExcel->getActiveSheet()->getCell("C".$j)->getValue();//获取C列的值
	$d = $objPHPExcel->getActiveSheet()->getCell("D".$j)->getValue();//获取D列的值
	$e = $objPHPExcel->getActiveSheet()->getCell("E".$j)->getValue();//获取E列的值
	$sql = "INSERT INTO user VALUES('".$a."','".$b."','".$c."','".$d."','".$e."')";
	//echo($sql);exit;
	mysql_query($sql);
	echo "第".$j."行插入成功<br/>";
	}
?>