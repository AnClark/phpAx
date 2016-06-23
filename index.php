<html>
<head>

<link rel="stylesheet" href="phpAx.css" />

</head>

<body>

<?php
	require("conn.php");

	$res = mysql_query("SELECT * FROM tblax");
	
	$row_number = 0; $col_html = '';

	
	for($i = 0; $i < mysql_num_rows($res); $i++){
		mysql_data_seek($res, $i);
		
		$arr = mysql_fetch_row($res);
		$col_html = $col_html .  '<div class="row">';
		foreach($arr as $eachcol){
			$col_html = $col_html . '<div class="col-one-in-four">' . $eachcol . '</div>';
		}
		$col_html = $col_html . '</div>';		
	}

?>

<div class="row header">
	<div class="col-one-in-four">ID</div>
	<div class="col-one-in-four">姓名</div>
	<div class="col-one-in-four">邮箱</div>
	<div class="col-one-in-four">地址</div>	
</div>

<?php
echo $col_html;
?>

</body>

</html>