<?php
	//$_POSTで受け取る
	$id = $_POST['id'];
	$pw = $_POST['pw'];

	//セッションの生成
	session_start();
?>

<!DOCTYPE html>
<html>
	<head>
		<title>ログイン</title>
		<meta charset="utf-8">
	</head>
	<body>
		<?php

		//データベース接続
		$dsn = 'mysql:dbname=note;host=localhost';
		$user = 'root';
		$password = 'mysql';
		$dbh = new PDO($dsn,$user,$password);

		//SQL文(データベースからIDとpwを検索してnoを取得)
		$sql = 'select * from user where mail = :userid AND pw = :userpw';
		$stmt = $dbh->prepare($sql);

		$id = $_POST['id'];
		$pw = $_POST['pw'];
		$stmt->bindParam(':userid',$id);
		$stmt->bindParam(':userpw',$pw);

		//SQL実行
		$stmt->execute();


		//ログイン認証
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
			if ($result == null){
				$login = 'Error';
			} else {
				$login = 'OK';
			}

		//セッションIDを再発行
		session_regenerate_id();

		//セッション変数に記録
		$_SESSION['login'] = $login;
		$_SESSION['no'] = $result['no'];
		$_SESSION['id'] = $_POST['id'];
		$_SESSION['pw'] = $_POST['pw'];
		$_SESSION['name'] = $result['name'];

		//移動
		if($login == 'OK'){
			header('Location: home.php');
		}else{
			header('Location: error.html');
		}

		//データベース切断
		$dbh = null;
		?>
	</body>
</html>
