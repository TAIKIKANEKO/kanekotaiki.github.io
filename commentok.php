<?php
//セッションの復元
session_start();


//htmlでのエスケープ処理
function h($s){
return htmlspecialchars($s, ENT_QUOTES, "UTF-8");
}

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
	  <title>コメント入力完了</title>
	  	<meta charset="utf-8">
	  	<link rel="stylesheet" href="commentok.css">
	  </head>
	  <body>
	 <?php		
	//チケットを確認
	if (isset($_POST['ticket']) && isset($_SESSION['ticket'])){
		$ticket = $_POST['ticket'];
		if ($ticket !=$_SESSION['ticket']) {
			print'<html>コメント完了。(有効期限切れ)<a href="home.php" title="ホーム">ホームへ戻る</a></html>';
			exit();
		}
	}else {
		print'<html>コメントできませんでした。(有効期限切れ) <a href="home.php" title="ホーム">ホームへ戻る</a></html>';
		exit();
	}
	
	 	//データベース接続
		$dsn = 'mysql:dbname=note;host=localhost';
    	$user = 'root';
    	$password = 'mysql';
   		$dbh = new PDO($dsn,$user,$password);
   		 
  		//コメント
  		$stmt = $dbh->prepare('insert into com (id,name,text,toukono,date) values (:id,:name,:text,:toukono,:now)');
  			$id = $_SESSION['no'];
  			$name = $_SESSION['name'];
  			$text = $_POST['message'];
  			$toukono = $_SESSION['textno'];
   			$now = date('Y-m-d H:i');

		$stmt->bindParam(':id',$id);
		$stmt->bindParam(':name',$name);
  		$stmt->bindParam(':text',$text);
  		$stmt->bindParam(':toukono',$toukono);
    	$stmt->bindParam(':now',$now);
    	
    	//実行
  		$stmt->execute();
	   
		//切断
		$dbh = null;
		//セッション破棄
		$_SESSION ['ticket']='';
		
      ?>
      <p>コメント完了</p>
      <a href="home.php">
		<input class="sub" type="button" name="ホームへ戻る" value="ホームへ戻る">
		</a>
	   
	  </body>
</html> 