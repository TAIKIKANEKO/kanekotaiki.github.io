<?php
	//セッションの復元
	session_start();
	$userno = $_SESSION['no'];
?>

<!DOCTYPE html>
<html>
	<head>
		<title>退会フォーム</title>
		<meta charset="utf-8">
		<link rel="stylesheet" href="taikai.css">
	</head>
	<body>
				<h2>退会しますか？</h2>
				<br>
			<ul class="a">
				<li>
				<form action="taikai2.php" method="post">
				<input type="hidden" name="no" value="<?php echo $userno; ?>">
				<input id="lo" type="submit" value="はい">
				</form>
				</li>
				<li><button id="lo" type="button" onclick="location.href='home.php'">いいえ</button></li>
			</ul>
	</body>
</html>