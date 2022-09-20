<?php
include 'HitChecker.php';

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
		$checker = new HitChecker;
		//exit("$x $y $r");
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
				<th>GOVNO</th>
				<th>$result_time</th>
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
