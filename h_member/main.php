<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<h1>메인 페이지</h1>
		<?php
			session_start();
			if(isset($_SESSION["uname"])){
				echo "<h3>", $_SESSION["uname"], "님 환영합니다.</h3>";
				echo "<input type='submit' value='로그아웃' onclick=\"location.href = 'logout.php'\">";
				echo "<input type='submit' value='회원수정' onclick=\"location.href = 'update_form.php'\">";
			}else{
				echo "<input type='submit' value='로그인' onclick=\"location.href = 'login_form.php'\">";
				echo "<input type='submit' value='회원가입' onclick=\"location.href = 'member_join_form.php'\">";
			}
		 ?>
		


</body>
</html>