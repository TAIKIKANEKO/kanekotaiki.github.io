

<?php
	function h($s){
		return htmlspecialchars($s, ENT_QUOTES, "UTF-8");
	}
 ?>
<!DOCTYPE html>
<html>
	<head>
		<title>投稿</title>
		<meta charset="utf-8">
		<link rel = "stylesheet" href= "btn-square-shadow.css">
		<link rel = "stylesheet" href= "btn1.css">
	</head>
	<body>
    <?php
	//セッションの生成
	session_start();

	//チケットを確認
	if (isset($_POST['ticket']) && isset($_SESSION['ticket'])){
		$ticket = $_POST['ticket'];
		if ($ticket !=$_SESSION['ticket']) {
			print'<html>投稿完了。(有効期限切れ)<a href="home.php" title="ホーム"class="btn1">ホームへ戻る</a></html>';
			exit();
		}
	}else {
		print'<html>投稿できませんでした。(有効期限切れ) <a href="home.php" title="ホーム"class="btn1">ホームへ戻る</a></html>';
		exit();
	}

    //データベースに接続
    $dsn = 'mysql:dbname=note;host=localhost';
    $user = 'root';
    $password = 'mysql';
    $dbh = new PDO($dsn,$user,$password);
  	//投稿
  	$stmt = $dbh->prepare('insert into touko (title,text,date,id) values (:title,:text,:now,:id)');
		$title = $_POST['title'];
		$text = $_POST['message'];
    $now = date('Y-m-d H:i');
    $id = $_SESSION['no'];

		$stmt->bindParam(':title',$title);
		$stmt->bindParam(':text',$text);
    $stmt->bindParam(':now',$now);
    $stmt->bindParam(':id',$id);
    //実行
  	$stmt->execute();
	//切断
	$dbh = null;
	//セッション破棄
	$_SESSION ['ticket']='';
	?>
	<p>投稿完了</p>
	<a href="home.php">
		<input type="button"　name="ホームへ戻る" value="ホームへ戻る"class="btn-square-shadow">
	</a>
  </body>
</html>
