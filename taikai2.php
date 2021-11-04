<?php

//$_POSTで受け取る
$userno = $_POST['no'];

?>

<!DOCTYPE html>
<html>
	<head>
		<title>退会フォーム</title>
		<meta charset="utf-8">
		<link rel="stylesheet" href="taikai.css">
	</head>
	<body>
				<h2>本当に退会しますか？</h2>
				<br>
			<ul class="a">
				<li>
				<form action="taikai3.php" method="post">
				<input type="hidden" name="no" value="<?php echo $userno; ?>">
				<input id="lo" type="submit" value="はい">
				</form>
				</li>
				<li><button id="lo" type="button" onclick="location.href='home.php'">いいえ</button></li>
			</ul>
	</body>
</html>