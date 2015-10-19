<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>首页</title>
</head>

<body>
	<form action="export.php" method="post">
		<select name="abc">
			<option value="处理中">处理中</option>
			<option value="已完成">已完成</option>
		</select>
		<select name="abd">
			<option value="超市">超市</option>
			<option value="百货">百货</option>
		</select>
		<input type="submit" value="导出" />
	</form>
	
	<form action="load.php" method="post">
		<input type="file" name="abd">
		<input type="submit" value="上传">
	</form>

</body>
</html>