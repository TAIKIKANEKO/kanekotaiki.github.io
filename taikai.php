<?php

//$_POSTで受け取る
$userno = $_POST['no'];

?>

<!DOCTYPE html>
<html>
	<head>
		<title>退会フォーム</title>
		<meta charset="utf-8">
	</head>
	<body>
		<?php
		
		//データベース接続
		$dsn = 'mysql:dbname=note;host=localhost';
		$user = 'root';
		$password = 'mysql';
		$dbh = new PDO($dsn,$user,$password);

		//SQL文(データベースのユーザ管理テーブルからユーザのデータを削除)
		$sql = 'delete from user where no = :no';
		$stmt = $dbh->prepare($sql);

		$no = $_POST['no'];
		$stmt->bindParam(':no',$no);
			
		//SQL実行
		$stmt->execute();

		//退会ユーザのID検索
		$sql = 'select * from user where no = :no';
		$stmt = $dbh->prepare($sql);
		
		$no = $_POST['no'];
		$stmt->bindParam(':no',$no);
		
		//SQL実行
		$stmt->execute();

		//IDヒットがなければ退会ページにリンク
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
			if ($result == null){
				header('Location: taikai.html');
			} else {
				print('退会できませんでした。<br>マイページからやり直してください。');
			}

		//データベース切断
		$dbh = null;
		?>
	</body>
</html>