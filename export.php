<?php
	ini_set("error_reporting","E_ALL & ~E_NOTICE");
	$dir = dirname(__FILE__);//查找当前脚本路径
	require_once $dir."/db.php";
	require_once $dir."/PHPExcel/PHPExcel.php";
	$db = new db($phpexcel);//实例化db类，连接数据库
	$objPHPExcel = new PHPExcel();//实例化PHPExcel类，类似新建一个excel
	for($i=1;$i<=3;$i++){
		if($i>1){
			$objPHPExcel -> createSheet();//创建新的内置表
		}
		$objPHPExcel -> setActiveSheetIndex($i-1);//把新创建的sheet设置为当前活动sheet，sheet的index默认是从0开始，所以i-1
		$objSheet = $objPHPExcel -> getActiveSheet();//获得当前活动区域的sheet
		$objSheet -> setTitle($i."年级");//给当前活动sheet命名
		$data = $db -> getDataByGrade($i);//查询每个年级的学生数据
		//填充数据
		$objSheet -> setCellValue("A1","姓名") -> setCellValue("B1","分数") -> setCellValue("C1","班级");
		$j = 2;
		foreach($data as $key => $val){
			$objSheet -> setCellValue("A".$j,$val['username']) -> setCellValue("B".$j,$val['score']) -> setCellValue("C".$j,$val['class']."班");
			$j++;
		}
	}
	$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel,"Excel5");//生成excel文件
	
	//保存excel至指定目录
	//$objWriter -> save($dir."/esport_1.xls");
	
	//输出到浏览器
	browser_export("Excel6","browser_excel03.xls");
	$objWriter -> save("php://output");
	
	//输出至浏览器函数
	function browser_export($type,$filename){
		if($type == "Excel5"){
			//输出03文件
			//ob_end_clean — 清空（擦除）缓冲区并关闭输出缓冲
			ob_end_clean();
			header('Content-Type: application/vnd.ms-excel');
		}else{//输出07文件
			ob_end_clean();
			header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		}
		//告诉浏览器将输出文件的名称
		header('Content-Disposition: attachment;filename="'.$filename.'"');
		//禁止缓存
		header('Cache-Control: max-age=0');
	}
?>