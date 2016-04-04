<?php
if (isset($_GET['num']) and isset($_GET['guess']) and isset($_GET['count']) and isset($_GET['length'])) {
    $length  = (int) $_GET['length'];
    $counter = (int) $_GET['count'];
	$guess=strval($_GET['guess']);
    if (strlen($guess) == $length) {
		$guess   = str_split(str_pad($guess,$length,'0',STR_PAD_LEFT));
    $num     = str_split(str_pad(strval(base64_decode($_GET['num'])),$length,'0',STR_PAD_LEFT));
        //计算a
        $a = 0;
        for ($row = 0; $row < count($guess); $row++) {
            if ($guess[$row] == $num[$row]) {
                $a = $a + 1;
            }
        }
        //计算b
        $guess_array = array(
            0,
            0,
            0,
            0,
            0,
            0,
            0,
            0,
            0,
            0
        );
        $num_array   = array(
            0,
            0,
            0,
            0,
            0,
            0,
            0,
            0,
            0,
            0
        );
        $b           = 0;
        for ($row = 0; $row < count($guess); $row++) {
            $guess_array[$guess[$row]] = $guess_array[$guess[$row]] + 1;
        }
        for ($row = 0; $row < count($num); $row++) {
            $num_array[$num[$row]] = $num_array[$num[$row]] + 1;
        }
        for ($row = 0; $row < 10; $row++) {
            $count = min($num_array[$row], $guess_array[$row]);
            $b     = $b + $count;
        }
        $b     = $b - $a;
        $color = ($a > 2 or $b > 3) ? 'warning' : 'danger';
        if ($a == $length) {
            $color = 'success';
            echo '<h2 class="text-center">恭喜你猜中了</h2>';
        }
        echo '<div class="col-xs-2"><h3><span class="label label-' . $color . '">' . $counter . '</span></h3></div></div><div class="col-xs-6"><h3>' . $_GET['guess'] . '</h3></div><div class="col-xs-4"><h3>' . $a . 'A ' . $b . 'B</h3></div>';
    } else {
        echo '<h2 class="text-center">数字位数错误</h2>';
    }
    
} else {
    echo '<h2 class="text-center">参数错误</h2>';
}
?>