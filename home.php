<?php
//セッションの復元
session_start();

//ワンタイムチケット作成
$ticket = md5(uniqid(rand(), true));

//ワンタイムチケットをセッション変数に格納
$_SESSION['ticket'] = $ticket;

//htmlでのエスケープ処理
function h($s){
  return htmlspecialchars($s, ENT_QUOTES, "UTF-8");
}
?>

<!DOCTYPE html>
<html>
  <head>
    <title>home</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="home.css">
    <link rel="stylesheet" href="btn1h.css">
  </head>
    <body>
      <a href="trymypage2.php">
        <img alt="home" src="icon-home.png"width="32"height="32">
      </a><br>
      <h1>HOME</h1>
       <form method="post" action="search.php">
        <input type="search" required name="search" size="48">
        <div><input type="submit" value="検索" class="btn1"></div>
        <br><br>
      </form>
      <form method="post" action="throw.php">
      <input type="text"placeholder="タイトルを入力" required name="title"><br><br>
      <textarea name="message" placeholder="好きなテキストを入力" required rows="8" cols="50"></textarea>
        <input type="hidden" name="ticket" value="<?php print ($ticket);?>"/>
        <div><input type="submit" value="投稿" class="btn1"></div><br>
      </form>
      <br>
          <a href="logout.php">
        <div><input id="lo" type="submit" value="ログアウト"></div>
          </a>
    </body>
  </html>
