<?php
	//セッションの復元
	session_start();
?>
<!docktype html>
<html>
	<head>
		<title>登録</title>
		<meta charset="utf-8">
		<link rel = "stylesheet" href= "tourokukanryo.css">
	</head>
 	<body>
 		<?php
		$dsn = 'mysql:dbname=note;host=localhost';
		$user = 'root';
		$password = 'mysql';
		$dbh = new PDO($dsn,$user,$password);

		//sql文
		$names = $_SESSION['name'];
		$mails = $_SESSION['id'];
		$pass = $_SESSION['pw'];
		$pf_sx = $_SESSION['mess1'];
		$pf_bx = $_SESSION['mess2'];

		$stmt = $dbh->prepare('insert into user(name,mail,pw,pf_s,pf_b) values(:name,:mail,:pw,:pf_s,:pf_b)');

		$name = $names;
		$mail = $mails;
		$pw = $pass;
		$pf_s = $pf_sx;
		$pf_b = $pf_bx;

		$stmt->bindParam(':name',$name);
		$stmt->bindParam(':mail',$mail);
		$stmt->bindParam(':pw',$pw);
		$stmt->bindParam(':pf_s',$pf_s);
		$stmt->bindParam(':pf_b',$pf_b);
		//挿入

		//sql実行
		$stmt->execute();

		//そのままログイン
		//SQL文(データベースからIDとpwを検索してnoを取得)
		$sql = 'select * from user where mail = :userid AND pw = :userpw';
		$stmt = $dbh->prepare($sql);

		$id = $_SESSION['id'];
		$pw = $_SESSION['pw'];
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

		//移動
		if($login == 'OK'){
			header('Location: complete.html');
		}else{
			header('Location: error.html');
		}
 		?>
 	</body>
</html>
