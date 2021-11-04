<?php
//セッションの復元
session_start();

//ワンタイムチケット作成
$ticket = md5(uniqid(rand(), true));

//ワンタイムチケットをセッション変数に格納
$_SESSION['ticket'] = $ticket;

//ログインチェック
if ($_SESSION['login'] != 'OK'){
	//ログインフォーム画面へ
	header('Location: login.html');
	//終了
	exit();
	}

//POSTで受け取る
$name = $_POST['name'];
$textno = $_POST['textno'];

//htmlでのエスケープ処理
function h($s){
  return htmlspecialchars($s, ENT_QUOTES, "UTF-8");
}

?>
<!DOCTYPE html>
<html>
	<head>
	  <title>コメント入力ページ</title>
	  	<meta charset="utf-8">
	  	<link rel="stylesheet" href=".css">
	  </head>
	  <body>
		<form method = "post" action ="commentok.php">
	   <?php print $name; ?> さんの投稿にコメントする<br>
	   	<textarea name="message" cols = "20" rows = "2">
	   	</textarea>
	   	<br>
	   	<input type="hidden" name="ticket" value="<?php print ($ticket);?>"/>
	   	<div class=""><input type ="submit" value = "コメントする"></div>
	   	<div class=""><input type ="reset" value = "入力内容をクリアする"></div>
	   </form>
	  <div class=""><a href="home.php">ホームへ戻る</a></div>
	   <?php
	   //セッション変数に保存する
	   $_SESSION['textno'] = $textno;
	   ?>
	   </body>
</html> 