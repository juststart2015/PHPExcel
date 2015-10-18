<?php
	//找到当前脚本所在路径
	$dir = dirname(__FILE__);
	require_once ("PHPExcel/PHPExcel.php");
	//实例化PHPExcel类，等同于在桌面上新建excel表
	$objPHPExcel = new PHPExcel();
	//获得当前活动sheet的操作对象
	$objSheet = $objPHPExcel -> getActiveSheet();
	//给当前活动sheet设置名称
	$objSheet -> setTitle("demo");
	//给当前活动sheet填充数据
	/*第一种方法
	$objSheet -> setCellValue("A1","姓名") -> setCellValue("B1","分数");
	$objSheet -> setCellValue("A2","张三") -> setCellValue("B2","50");
	*/
	//第二种方法,这个方法对于大数据(过于消耗内存)及添加样式控制都不太友好
	$array = array(//这个大array类似于整个的sheet的数组，有几个array就有几个sheet
		//php按顺序执行，所有多个array就多一行，array里多个空白内容""，就多一格
		array(),
		array("","姓名","分数"),//这个里面的array类似于每个sheet里的内容，一个array代表一行，有几个array，就有几行
		array("","李四","60"),
		array("","王五","70")
	);
	//直接加载数据块来填充数据
	$objSheet -> fromArray($array);
	//按照指定格式生成excel文件,$objPHPExcel在上面已经获得了活动sheet及设置了值
	$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel,"Excel2007");
	//保存到指定路径
	$objWriter -> save($dir."/demo_1.xlsx");
?>