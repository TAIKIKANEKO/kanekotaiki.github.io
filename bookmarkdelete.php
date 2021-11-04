<?php
//セッションの復元
session_start();


//ログインチェック
if ($_SESSION['login'] != 'OK'){
	//ログインフォーム画面へ
	header('Location: login.html');
	//終了
	exit();
}
?>
<!DOCTYPE html>
<html>
	<head>
	  <title>ブックマーク解除</title>
	  	<meta charset="utf-8">
	  	<link rel="stylesheet" href=".css">
	  </head>
	  <body>
	 <?php
	 	//データベース接続
		$dsn = 'mysql:dbname=note;host=localhost';
		$user = 'root';
		$password = 'mysql';
		$dbh = new PDO($dsn,$user,$password);
		
		//favテーブルから削除する。（textnoをキーに削除）
		$stmt = $dbh->prepare('delete from fav where textno = :textno');
		
		$textno = $_POST['textno'];
		$stmt->bindParam(':textno',$textno);
		
		//SQL実行
		$stmt->execute();
		
		header('Location:bookmarkdelok.php');
      ?>
	   
	  </body>
</html> 