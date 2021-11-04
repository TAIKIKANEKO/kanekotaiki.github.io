<?php
	//セッションの復元
	session_start();
?>
<!DOCTYPE html>
<html>
	<head>
		<title>登録</title>
		<meta charset="utf-8">
	</head>
	<body>
		<?php
		//データベース接続
		$dsn = 'mysql:dbname=note;host=localhost';
		$user = 'root';
		$password = 'mysql';
		$dbh = new PDO($dsn,$user,$password);

		//SQL文
		$sql = 'select mail from user where mail = :mail';
		$stmt = $dbh->prepare($sql);

		$mail = $_SESSION['id'];
		$stmt->bindParam(':mail',$mail);

		//SQL実行
		$stmt->execute();

		//ヒットがなければ新規登録
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
			if ($result == null){
				header('Location: complete.php');
			} else {
				header('Location: tourokuerror.html');
			}

		//データベース切断
		$dbh = null;
		?>
	</body>
</html>
