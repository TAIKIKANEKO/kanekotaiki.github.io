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
	  <title>ブックマーク完了</title>
	  	<meta charset="utf-8">
	  	<link rel="stylesheet" href="bookmark.css">
	  </head>
	  <body>
	  <p>ブックマークが完了しました。</p>
	 <?php
		//セッションの削除
		$_SESSION['textno']='';
      ?>
      	<br>
	   <p class="sub"><a href = "trymypage2.php">マイページに戻る</a></p>
	   <br>
	   <p class="sub"><a href = "home.php">ホームに戻る</a></p>
	  </body>
</html> 