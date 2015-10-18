<?php
	header("content-type:text/html; charset='utf-8'");
	ini_set("error_reporting","E_ALL & ~E_NOTICE");
	$dir = dirname(__FILE__);//查找当前脚本路径
	//require_once $dir."/db.php";
	require_once $dir."/PHPExcel/PHPExcel/IOFactory.php";//引入读取excel的类文件
	//$db = new db($phpexcel);//实例化db类，连接数据库
	//$objPHPExcel = new PHPExcel();//实例化PHPExcel类，类似新建一个excel
	$filename = $dir."/esport_1.xls";
	
	//以下四句为加载指定sheet内容
	//自动获取文件的类型，提供给phpexcel使用
	$fileType = PHPExcel_IOFactory::identify($filename);
	//获取文件读取操作对象
	$objReader = PHPExcel_IOFactory::createReader($fileType);
	$sheetName = array("2年级","3年级");
	//只加载指定的sheet
	$objReader -> setLoadSheetsOnly($sheetName);
	//加载文件
	$objPHPExcel = $objReader -> load($filename);
	
	/*直接加载所有文件内容
	$objPHPExcel = PHPExcel_IOFactory::load($filename);
	*/



	/*
	暴力循环读取excel内的所有数据，这种方法过于消耗内存，若数据量过大，则会直接崩溃
	$sheetCount = $objPHPExcel -> getSheetCount();//获取excel文件里有多少个sheet
	for($i=0;$i<$sheetCount;$i++){
		$data = $objPHPExcel -> getSheet($i) -> toArray();//读取每个sheet里的数据，全部放入到数组中
		print_r($data);
	}
	*/
	
	//通过PHP内置函数，循环读取每格数据，并输出
	//IteratorAggregate::getIterator — 获取一个外部迭代器
	foreach($objPHPExcel -> getWorksheetIterator() as $sheet){//循环取sheet
		foreach($sheet -> getRowIterator() as $row){//逐行处理
			if($row -> getRowIndex()<2){//获取行数，这里判断，当行数小于2时，即第一行时，不执行下面语句，跳出循环直接进入下一次循环过程
				//continue 在循环结构用用来跳过本次循环中剩余的代码并在条件求值为真时开始执行下一次循环。
				continue;
			}
			foreach($row -> getCellIterator() as $cell){//逐列读取
				$data = $cell -> getValue();//获取单元格数据
				echo $data." ";
			}
			echo "<br/>";
		}
		echo "<br/>";
	}
	
	exit;

?>