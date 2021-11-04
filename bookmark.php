<?php
//セッションの復元
session_start();


//POSTで受け取る
$title = $_POST['title'];
$text = $_POST['text'];
$textno = $_POST['textno'];


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
	  <title>ブックマークをつける</title>
	  	<meta charset="utf-8">
	  	<link rel="stylesheet" href="bookmark.css">
	  </head>
	  <body>
	 <?php
	 	//データベース接続
		$dsn = 'mysql:dbname=note;host=localhost';
		$user = 'root';
		$password = 'mysql';
		$dbh = new PDO($dsn,$user,$password);
		
		//favテーブルに登録する。
		$stmt = $dbh->prepare('insert into fav (id,title,text,textno) values (:id,:title,:text,:textno)');
		
		$id = $_SESSION['id'];
		$title = $_POST['title'];
		$text = $_POST['text'];
		$textno = $_POST['textno'];
		
		$stmt->bindParam(':id',$id);
		$stmt->bindParam(':title',$title);
		$stmt->bindParam(':text',$text);
		$stmt->bindParam(':textno',$textno);
		
		//SQL実行
		$stmt->execute();
		
		header('Location:bookmarkok.php');
      ?>
	   
	  </body>
</html> 