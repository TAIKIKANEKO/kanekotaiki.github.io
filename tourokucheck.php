<?php
	//$_POSTで受け取る
	$name = $_POST['name1'];
	$id = $_POST['mail1'];
	$pw = $_POST['password1'];
	$mess1 = $_POST['message1'];
	$mess2 = $_POST['message2'];
	
	//サニタイジング
	$name = htmlspecialchars($name);
	$id = htmlspecialchars($id);
	$pw = htmlspecialchars($pw);
	$mess1 = htmlspecialchars($mess1);
	$mess2 = htmlspecialchars($mess2);
	
	function h($s){
	return htmlspecialchars($s, ENT_QUOTES, "UTF-8");
	}
	
	//セッションの生成
	session_start();
?>
<!DOCTYPE html>
<html>
	<head>
		<title>登録チェック</title>
		<meta charset="utf-8">
	</head>
	<body>
		<?php
		//セッション変数に記録
		$_SESSION['id'] = $id;
		$_SESSION['pw'] = $pw;
		$_SESSION['name'] = $name;
		$_SESSION['mess1'] = $mess1;
		$_SESSION['mess2'] = $mess2;
		
		$mailc = "/^([a-zA-Z0-9])+([a-zA-Z0-9._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9._-]+)+$/";
		
		if(empty($_POST['name1'])){
			header('Location: tourokuerror.html');//name空欄時エラー画面へ//
		}else{
			if(empty($_POST['mail1'])){
				header('Location: tourokuerror.html');//mail空欄時エラー画面へ//
			}else{
				if(empty($_POST['password1'])){
					header('Location: tourokuerror.html');//password空欄時エラー画面へ//
				}else{
					if(strlen($_POST['password1']) < 8){
						header('Location: tourokuerror.html');//passwordが8文字未満の時エラー画面へ//
					}else{
						if(strlen($_POST['password1']) > 16){
							header('Location: tourokuerror.html');//passwordが16文字より多い時エラー画面へ//
						}else{
							
							if(preg_match($mailc,$_POST['mail1'])){
								header('Location: comp.php');//mailが正規表現の時//
							}else{
								header('Location: tourokuerror.html');//正規表現でないとき
							}
						}
					}
				}
			}
		}
		?>
	</body>
</html>