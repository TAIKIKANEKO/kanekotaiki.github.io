<?php
//セッションの復元
session_start();

if($_SESSION['login'] != 'OK'){
	//ログインフォーム画面へ
	header('Location: login.php');
	//終了
	exit();
}
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
		<link rel="stylesheet" href="seach.css">
    <title>time_line</title>
  </head>
  <body>
    <?php
    //エスケープ追加
    function h($s){
    $post_data = htmlspecialchars($s,ENT_QUOTES,"utf-8");
    }
    //データベースに接続
    $dsn = 'mysql:dbname=note;host=localhost';
    $user = 'root';
    $password = 'mysql';
    $dbh = new PDO($dsn,$user,$password);
    //検索
    $text = '%'.$_POST['search'].'%';
    $sql = 'select * from touko where text LIKE :text order by date desc';
    $stmt = $dbh->prepare($sql);
    $stmt ->bindParam(':text',$text);
    //実行
    $stmt->execute();

    //取り出せる限り繰り返す
      while($result =$stmt->fetch(PDO::FETCH_ASSOC)) {
      print($result['name'].'さんの投稿'.'  投稿日付'.$result['date'].'<br>');
      print('タイトル：'.$result['title'].'<br>');
      print('本文：'.$result['text'].'<br>'.
			'<ul class="a">'.'<li>'.
			'<form method = "post" action ="bookmark.php">
      		<input type = "hidden" name = "title" value="'.$result['title'].'")>
      		<input type = "hidden" name = "text" value="'.$result['text'].'")>
      		<input type = "hidden" name = "textno" value="'.$result['no'].'")>
      		<input class="sub" type= "submit" value="ブックマーク">
      		</form>'.'</li>'.

			'<li>'.
      	    '<form method = "post" action ="comment.php">
      		<input type = "hidden" name = "textno" value="'.$result['no'].'")>
      		<input type = "hidden" name = "name" value="'.$result['name'].'">
      		<input input class="sub" type="submit" value="コメントする">
      		</form>'.'</li>'.
      	'</ul>');
      	}

      //セッション変数にテキストnoを保存
      $_SESSION['textno'] = $result['no'];
      //切断
      $dbh = null;
      ?>


      <div class="sub"><a href="home.php">ホームへ戻る</a></div>
  </body>
</html>
