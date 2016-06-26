<?php

require("conn.php");

if(isset($_GET['cmd']))
	$cmd = $_GET['cmd'];
if(isset($_GET['key']))
	$key = $_GET['key'];

switch($cmd){
	case 'all':
		$sql = 'SELECT * FROM tblax';
		$res = mysql_query($sql, $con);
		
		echo '<div class="row header">
		<div class="col-one-in-four">ID</div>
		<div class="col-one-in-four">姓名</div>
		<div class="col-one-in-four">邮箱</div>
		<div class="col-one-in-four">地址</div>	
	</div>';

		$col_html = '';
		for($i = 0; $i < mysql_num_rows($res); $i++)
		{
			mysql_data_seek($res, $i);
			$arr = mysql_fetch_assoc($res);
			$col_html = $col_html .  '<div class="row">';		
			
			$col_html = $col_html . '<div class="col-one-in-four">' . $arr['ID'] . '</div>';
			$col_html = $col_html . '<div class="col-one-in-four">' . $arr['name'] . '</div>';
			$col_html = $col_html . '<div class="col-one-in-four">' . $arr['email'] . '</div>';
			$col_html = $col_html . '<div class="col-one-in-four">' . $arr['address'] . '</div>';
			
			$col_html = $col_html . '</div>';
	}
	
		echo $col_html;
		exit();
		break;
		
	case 'query':
		if(empty($key)){
			return;
		}
		
		$sql = 'SELECT * FROM tblax';
		$res = mysql_query($sql, $con);
		
		
		echo '<div class="row header">
		<div class="col-one-in-four">ID</div>
		<div class="col-one-in-four">姓名</div>
		<div class="col-one-in-four">邮箱</div>
		<div class="col-one-in-four">地址</div>	
	</div>';

		$col_html = '';
		for($i = 0; $i < mysql_num_rows($res); $i++)
		{
			mysql_data_seek($res, $i);
			$arr = mysql_fetch_assoc($res);	
			
			$temp = '';
			foreach($arr as $each_column){
				$temp = $temp . $each_column; 
			}
			
			
			if(substr_count($temp, $key)){
				$col_html = $col_html .  '<div class="row">';		
				
				$col_html = $col_html . '<div class="col-one-in-four">' . $arr['ID'] . '</div>';
				$col_html = $col_html . '<div class="col-one-in-four">' . $arr['name'] . '</div>';
				$col_html = $col_html . '<div class="col-one-in-four">' . $arr['email'] . '</div>';
				$col_html = $col_html . '<div class="col-one-in-four">' . $arr['address'] . '</div>';
				
				$col_html = $col_html . '</div>';		
				
				
			}

			
			$col_html = $col_html . '</div>';
		}
		
		echo $col_html;
		break;
		
	default:
		echo $cmd;
		echo "<h1>非法请求！</h1>";
}

/*********	值得注意的地方	*********
mysql_fetch_row 和 mysql_fetch_assoc 还是有所区别的。
◆前者输出的结果形如：
	array(4) { [0]=> string(1) "1" [1]=> string(4) "Andy" [2]=> string(14) "qwerty@eml.com" [3]=> string(13) "Avenue in NYC" } 
◆后者输出的结果形如：
	array(4) { ["ID"]=> string(1) "1" ["name"]=> string(4) "Andy" ["email"]=> string(14) "qwerty@eml.com" ["address"]=> string(13) "Avenue in NYC" } 
*************************************/

?>