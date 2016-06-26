<?php
/***********************	AJAX 数据库之服务端部分		***********************/
require("conn.php");		//连接数据库

//我计划传入两个参数：
//	cmd：指定需要让后台服务器执行的操作
//		操作有两个：显示所有数据（all）、执行检索（query）。
//	key：指定检索数据库的关键字
if(isset($_GET['cmd']))		//若有参数传入
	$cmd = $_GET['cmd'];	//就用本地变量来接收参数。频繁使用$_GET不是好习惯，代码会很乱。
if(isset($_GET['key']))
	$key = $_GET['key'];

//根据传入参数，判断该执行“显示所有数据”还是“信息检索”
switch($cmd){
	
	/**********		传入所有数据	**********/
	case 'all':	
		$sql = 'SELECT * FROM tblax';		//读取数据表中的所有条目
		$res = mysql_query($sql, $con);		//执行SQL查询
		
		//生成HTML列标头~~~
		echo '<div class="row header">
			<div class="col-one-in-four">ID</div>
			<div class="col-one-in-four">姓名</div>
			<div class="col-one-in-four">邮箱</div>
			<div class="col-one-in-four">地址</div>	
		</div>';

		$col_html = '';		//网页缓冲变量，用于存储将要输出到网页中的HTML代码
		for($i = 0; $i < mysql_num_rows($res); $i++)	//数据表逐行操作
		{
			mysql_data_seek($res, $i);		//数据表指针定位
			$arr = mysql_fetch_assoc($res);		//获取单行的内容，并放入数组中
			
			//生成单行表格的HTML代码~~~
			$col_html = $col_html .  '<div class="row">';		
				$col_html = $col_html . '<div class="col-one-in-four">' . $arr['ID'] . '</div>';
				$col_html = $col_html . '<div class="col-one-in-four">' . $arr['name'] . '</div>';
				$col_html = $col_html . '<div class="col-one-in-four">' . $arr['email'] . '</div>';
				$col_html = $col_html . '<div class="col-one-in-four">' . $arr['address'] . '</div>';
			$col_html = $col_html . '</div>';
		}
		echo $col_html;		//将最后结果输出
		exit();		break;
		
		
	/**********		执行检索	**********/
	case 'query': 
		//若清空了搜索框导致key变量失效，那么就退出
		//否则会导致一大版的警告消息输出！
		if(empty($key)){
			return;
		}
		
		$sql = 'SELECT * FROM tblax';		//读取数据表中的所有条目
		$res = mysql_query($sql, $con);		//执行SQL查询
		
		//生成HTML列标头~~~
		echo '<div class="row header">
			<div class="col-one-in-four">ID</div>
			<div class="col-one-in-four">姓名</div>
			<div class="col-one-in-four">邮箱</div>
			<div class="col-one-in-four">地址</div>	
		</div>';

		$col_html = '';		//网页缓冲变量，用于存储将要输出到网页中的HTML代码
		for($i = 0; $i < mysql_num_rows($res); $i++)		//数据表逐行检索
		{
			mysql_data_seek($res, $i);		//数据表指针定位
			$arr = mysql_fetch_assoc($res);		//获取单行的内容，并放入数组中
			
			//接下来我使用的方法比较特别：
			//		将单行的所有字符全部拼接在一起，再使用substr_count函数检验关键字是否存在
			$temp = '';
			foreach($arr as $each_column){
				$temp = $temp . $each_column; 
			}
			
			//substr_count函数可用于检测关键字是否存在。若存在则返回该关键字的出现次数（大于零）。
			if(substr_count($temp, $key)){
				//若关键字存在，则输出单行表格
				$col_html = $col_html .  '<div class="row">';		
					$col_html = $col_html . '<div class="col-one-in-four">' . $arr['ID'] . '</div>';
					$col_html = $col_html . '<div class="col-one-in-four">' . $arr['name'] . '</div>';
					$col_html = $col_html . '<div class="col-one-in-four">' . $arr['email'] . '</div>';
					$col_html = $col_html . '<div class="col-one-in-four">' . $arr['address'] . '</div>';
				$col_html = $col_html . '</div>';		
			}

			$col_html = $col_html . '</div>';
		}
		
		echo $col_html;		//将最后结果输出
		break;
		
	default:
		die("<h1>非法请求！</h1>");
}

/*********	值得注意的地方	*********
mysql_fetch_row 和 mysql_fetch_assoc 还是有所区别的。
◆前者输出的结果形如：
	array(4) { [0]=> string(1) "1" [1]=> string(4) "Andy" [2]=> string(14) "qwerty@eml.com" [3]=> string(13) "Avenue in NYC" } 
◆后者输出的结果形如：
	array(4) { ["ID"]=> string(1) "1" ["name"]=> string(4) "Andy" ["email"]=> string(14) "qwerty@eml.com" ["address"]=> string(13) "Avenue in NYC" } 
*************************************/

?>