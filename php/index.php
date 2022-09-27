<?php
include 'HitChecker.php';

date_default_timezone_set('UTC');
$start_time = microtime(true);

session_start();
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if($_SESSION['table'] == null) {
        $_SESSION['table'] = '';
    }
    exit($_SESSION['table']);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	if ($_POST["clean"] === 'true') {
		$_SESSION['table'] = '';
		exit("clean successful");
	}
	if ($_POST["x"] !== null && $_POST["y"] !== null && $_POST["r"] !== null) {
		$x = $_POST["x"];
		$y = $_POST["y"];
		$r = $_POST["r"];
        $timezone = $_POST["timezone"];
        $curTime = date("H:i:s", time() - $timezone * 60);
		$checker = new HitChecker;
		if (!$checker->validate($x, $y, $r)) {
			exit("Некоректные данные на сервере");
		}
		$hit = $checker->checkHit($x, $y, $r) ? "Попал" : "Промах";

		$result_time = number_format((microtime(true) - $start_time) * 1000000, 2, ".", "");

		http_response_code(200);

		$result = "
			<tr>
				<th>$x</th>
				<th>$y</th>
				<th>$r</th>
				<th>$curTime</th>
				<th>$result_time ms</th>
				<th>$hit</th>
			</tr>
		";
		$_SESSION['table'] .= $result;

		exit($result);
	} else {
		http_response_code(400);
		exit("Some parameters are missing");
	}

}

?>
