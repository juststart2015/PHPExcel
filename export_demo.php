<?php
	//从数据库导出文件至硬盘
	ini_set("error_reporting","E_ALL & ~E_NOTICE");
	$dir = dirname(__FILE__);
	require_once $dir."/db.php";
	require_once $dir."/PHPExcel/PHPExcel.php";
	
	$i = $_POST['abc'];//传入的文件名
	$excel_name = iconv("utf-8","gb2312",$_POST['abd']);//转换中文文件名，供windows识别
	$db = new db($dbconfig);//连接数据库
	$objPHPExcel = new PHPExcel();//新建表
	$objPHPExcel -> createSheet();//新建sheet
	$objPHPExcel -> setActiveSheetIndex(0);//设置当前活动分区
	$objSheet = $objPHPExcel -> getActiveSheet();//获得当前活动分区
	$objSheet -> setTitle("超市");//设置sheet的名字
	$data = $db -> getDataByZt($i);//进行数据库查询，获取数据
	$objSheet -> setCellValue("A1","ID") -> setCellValue("B1","ID") -> setCellValue("C1","ID") -> setCellValue("D1","ID") -> setCellValue("E1","ID") -> setCellValue("F1","ID") -> setCellValue("G1","ID") -> setCellValue("H1","ID") -> setCellValue("I1","ID") -> setCellValue("J1","ID");//设置各列的值，这里为第一行
	$j = 2;
	foreach($data as $key => $val){
		$objSheet -> setCellValue("A".$j,$val['wt_id']) -> setCellValue("B".$j,$val['zt']) -> setCellValue("C".$j,$val['jlr']) -> setCellValue("D".$j,$val['tcr']) -> setCellValue("E".$j,$val['djrq']) -> setCellValue("F".$j,$val['wtms']) -> setCellValue("G".$j,$val['cljg']) -> setCellValue("H".$j,$val['clr']) -> setCellValue("I".$j,$val['wcrq']) -> setCellValue("J".$j,$val['bx']);//设置各列的值，这里从第二行开始
		$j++;
	}
	$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel,"Excel5");//设置输出excel的格式
	$objWriter -> save($dir."/".$excel_name.".xls");//设置输出文件的保存地址

?>