<?php
//セッションの復元
session_start();


//セッション変数の指定
$no = $_SESSION['no'];
$id = $_SESSION['id'];


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
	  <title>マイページ</title>
	  	<meta charset="utf-8">
	  	<link rel="stylesheet" href="trymypage2.css">
	  </head>
	  <body>
	  <?php
		
		//データベース接続
		$dsn = 'mysql:dbname=note;host=localhost';
		$user = 'root';
		$password = 'mysql';
		$dbh = new PDO($dsn,$user,$password);
		
		//セッションで取り出した番号からなまえ、プロフィールの情報をとりあえず出す。
		$sql = $dbh->query("select * from user where no = '$no'");
		$result =$sql->fetch(PDO::FETCH_ASSOC);
		
		
		//データベース切断
		$dbh = null;
		?>
		
	  	<h1>ようこそ!!<?php print ($result['name']); ?> さん</h1>
	  	<br>

	  	<p class = "pf"><?php print ($result['name']); ?> さんの プロフィール<br></p>
	  	<p class = "pf">学んでいること<br></p>
	  	<p>	<?php print ($result['pf_s']); ?></Pp>
	  	<br>
	  	<br>
	  	<p class = "pf">専門分野<br></p>
	  	<p class = "text">	<?php print ($result['pf_b']); ?></p>
	  	<br>
	  	<br>
	  	<hr>
	  	<h3>あなたのマイノート（ブックマーク一覧）</h3>
	  	
	  <div class=""><?php
		//セッションで取り出したnoから投稿情報を表示する
		//データベース接続
		$dsn = 'mysql:dbname=note;host=localhost';
		$user = 'root';
		$password = 'mysql';
		$dbh = new PDO($dsn,$user,$password);
		
		//ブックマークした投稿をid（メールで）取り出す
		$sql = 'select * from fav where id = :userid';
		$stmt = $dbh->prepare($sql);
		
		$stmt->bindParam(':userid',$id);
		
		//SQL実行
		$stmt->execute();
		//取り出したブクマ内容を並べて表示、ブックマーク解除ボタン
		while($result =$stmt->fetch(PDO::FETCH_ASSOC)) {
			
			print ('タイトル：'.
	  		$result['title']).'<br>';
      		print($result['text']).
      		'<form method = "post" action ="bookmarkdelete.php">
      		<input type = "hidden" name = "textno" value="'.$result['textno'].'">
      		<input class="sub" type="submit" value="ブックマーク解除">
      	</form>';
      	}

		//データベース切断
		$dbh = null;
	  	?>
	  	</div>
	  	<hr>
	  <h3>あなたの投稿一覧</h3>
	<div class="">
	  	<?php
	  	//セッションで取り出したnoから投稿情報を表示する
	  	
	  	//データベース接続
	  	$dsn = 'mysql:dbname=note;host=localhost';
		$user = 'root';
		$password = 'mysql';
		$dbh = new PDO($dsn,$user,$password);
		
		//セッションで取り出した番号からtoukoの投稿情報を取り出す。
		$sql = $dbh->query( "select * from touko where id = '$no'");
		
		//取り出した投稿情報を並べて出す。
	  	while($result = $sql->fetch(PDO::FETCH_ASSOC)){
	  		print ('タイトル：'.
	  		$result['title']).'<br>';
			print('投稿内容：'.
			$result['text'].
			'<form method = "post" action = "mypagecom.php">
				<input type ="hidden" name ="textno" value="'.$result['no'].'">
				<input class="sub" type = "submit" value = "コメントを見る">
				</form>');
	  	}
	   	
	   	//データベース切断
	  	$dsn = null;
	   ?>
	   </div>
	   
	   	<br>
	   	<hr>
	   	<div class = "sub"><a href="home.php">ホームへ戻る</a></div>
	   	<div class="sub"><a href="taikai1.php">退会する</a></div>
	   	
	  </body>
</html> 