<?php
function create_number($length)
{
    for ($a; $a < $length; $a++) {
        $num .= intval(rand(0, 9));
    }
    return base64_encode($num);
}
$length = (isset($_GET['length'])) ? (int) $_GET['length'] : 6;
$num    = (isset($_GET['num'])) ? $_GET['num'] : create_number($length);
if (isset($_GET['num']) and isset($_GET['length'])) {
} else {
    header("Location:" . $_SERVER['SCRIPT_NAME'] . '?num=' . $num . '&length=' . $length);
}
?>
<!DOCTYPE html>
<html lang="zh-CN">
  <head>
    <!-- Required meta tags always come first -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
	<title>猜数字</title>
	<link href="//cdn.bootcss.com/bootstrap/3.3.4/css/bootstrap.min.css" rel="stylesheet">
	<style>
	/* Custom page header */
.header {
  padding:10px 0 10px 0;
}
/* Make the masthead heading the same height as the navigation */
.header h3 {
  margin-top: 0;
  margin-bottom: 0;
  line-height: 40px;
}

	.ui-block{
	width:25%;
	padding:  3px;
	border: 0;
	float: left;
	min-height: 1px;
	-webkit-box-sizing: border-box;
	-moz-box-sizing: border-box;
	box-sizing: border-box;
}
</style>
</head>
  <body>
  <div class="container">
      <div class="header clearfix">
        <nav>
          <ul class="nav nav-pills pull-right">
           
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">重设 <span class="caret"></span></a>
              <ul class="dropdown-menu">
			  <?php
for ($row = 4; $row < 10; $row++) {
    echo '<li><a href="' . $_SERVER['SCRIPT_NAME'] . '?length=' . $row . '">' . $row . '</a></li>';
}
?>
              </ul>
            </li> <li role="presentation"><a href="#" onclick="alert('输入<?php
echo $length;
?>位数字\nA前面的数字表示有A个数字与位置完全一致\nB前面的数字表示存在有B个数字正确但位置不对')">规则</a></li>
          </ul>
        </nav>
        <h3 class="text-muted">猜数字</h3>
      </div>
<input class="form-control" type="text" id="num" placeholder="输入<?php
echo $length;
?>位数字">
<div class="ui-block"><button type="button" class="btn btn-success btn-lg btn-block" onclick="add(1);">1</button></div>
<div class="ui-block"><button type="button" class="btn btn-success btn-lg btn-block" onclick="add(2);">2</button></div>
<div class="ui-block"><button type="button" class="btn btn-success btn-lg btn-block" onclick="add(3);">3</button></div>
<div class="ui-block"><button type="button" class="btn btn-danger btn-lg btn-block" onclick="empty();">清空</button></div>
<div class="ui-block"><button type="button" class="btn btn-success btn-lg btn-block" onclick="add(4);">4</button></div>
<div class="ui-block"><button type="button" class="btn btn-success btn-lg btn-block" onclick="add(5);">5</button></div>
<div class="ui-block"><button type="button" class="btn btn-success btn-lg btn-block" onclick="add(6);">6</button></div>
<div class="ui-block"><button type="button" class="btn btn-success btn-lg btn-block" onclick="add(0);">0</button></div>
<div class="ui-block"><button type="button" class="btn btn-success btn-lg btn-block" onclick="add(7);">7</button></div>
<div class="ui-block"><button type="button" class="btn btn-success btn-lg btn-block" onclick="add(8);">8</button></div>
<div class="ui-block"><button type="button" class="btn btn-success btn-lg btn-block" onclick="add(9);">9</button></div>
<div class="ui-block"><button id="button" type="button" class="btn btn-primary btn-lg btn-block">提交</button></div>
<div id="result"></div>
</div>
<script src="//cdn.bootcss.com/jquery/1.11.3/jquery.min.js"></script>
<script src="//cdn.bootcss.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
<script>
var counter = 0;
function add(i) {
    $('#num').val($('#num').val() + i)
}
function empty() {
    $('#num').val('');
}
$(document).ready(function() {
    $("#button").click(function() {
        counter = counter + 1;
        $.get('callback.php?count=' + counter + '&length=<?php
echo $length;
?>&num=<?php
echo $num;
?>&guess=' + $("#num").val(),
        function(data, status) {
            $('#result').prepend(data);
            empty()
        })
    })
})</script>
  </body>
</html>