<?php
	//セッションの復元
	session_start();
	
	//セッション変数を初期化
	$_SESSION = array();
	
	//セッションIDを破棄
	if (isset($_COOKIE[session_name()])) {
		setcookie(session_name(),'',time()-3600,'/');
	}
	
	//セッションを破棄
	session_destroy();
?>

<!DOCTYPE html>
<html>
	<head>
		<title>ログアウト</title>
		<meta charset="utf-8">
		<link rel="stylesheet" href="a.css">
	</head>
	<body>
		<?php
		//ログアウト処理後に移動
			if ($_SESSION == null){
				header('Location: login.html');
			} else {
				print 'ログアウトできませんでした。';
			}
		?>
	</body>
</html>