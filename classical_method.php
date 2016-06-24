<html>
<head>

<link rel="stylesheet" href="phpAx.css" />

</head>

<body>

<?php
	require("conn.php");

	$res = mysql_query("SELECT * FROM tblax");
	
	$col_html = '';

	
	for($i = 0; $i < mysql_num_rows($res); $i++){
		mysql_data_seek($res, $i);
		
		$arr = mysql_fetch_row($res);
		$col_html = $col_html .  '<div class="row">';
		foreach($arr as $eachcol){
			$col_html = $col_html . '<div class="col-one-in-four">' . $eachcol . '</div>';
		}
		$col_html = $col_html . '</div>';		
	}
/*********	值得注意的地方	*********
mysql_fetch_row 和 mysql_fetch_assoc 还是有所区别的。
◆前者输出的结果形如：
	array(4) { [0]=> string(1) "1" [1]=> string(4) "Andy" [2]=> string(14) "qwerty@eml.com" [3]=> string(13) "Avenue in NYC" } 
◆后者输出的结果形如：
	array(4) { ["ID"]=> string(1) "1" ["name"]=> string(4) "Andy" ["email"]=> string(14) "qwerty@eml.com" ["address"]=> string(13) "Avenue in NYC" } 
*************************************/
?>

<?php
function tester(){
	echo 'aaaaaaa';
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

<button onclick="tester()">PHP 单击测试</button>

</body>

</html>