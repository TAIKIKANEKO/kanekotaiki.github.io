<?php
//セッションの復元
session_start();

//POSTで受け取る
$toukono = $_POST['textno'];
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
	  <title>マイページからもらったコメントを見る</title>
	  	<meta charset="utf-8">
	  	<link rel="stylesheet" href="commentok.css">
	  </head>
	  <body>
	 <?php
	 	//データベース接続
		$dsn = 'mysql:dbname=note;host=localhost';
    	$user = 'root';
    	$password = 'mysql';
   		$dbh = new PDO($dsn,$user,$password);
   		
   		//コメントを表示する
   		$stmt = $dbh->prepare('select * from com where toukono = :toukono');
   			$toukono = $_POST['textno'];
   			$stmt->bindParam(':toukono',$toukono);
   			//SQL実行
			$stmt->execute();
			
			while($result =$stmt->fetch(PDO::FETCH_ASSOC)) {
				print ($result['date'].' に'.$result['name'].'がコメントしました'.'<br>');
				print ($result['text'].'<br>');
				}
				
      ?>
	   <div class="sub"><a href="home.php">ホームへ戻る</a></div>
	   <div class="sub"><a href="trymypage2.php">マイページへ戻る</a></div>
	  </body>
</html> 