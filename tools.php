<?php
	define("MAIN_PAGE", "main.php");
	// "MAIN_PAGE" 메인 페이지의 파일명
	function requestValue($name){
		return isset($_REQUEST["$name"])?$_REQUEST["$name"]:"";
		// 있으면 값을 주고 없으면 빈 문자열을 리턴하기 위해서
	}

	function errorBack($msg){
		
	?>
		<script>
			alert('<?= $msg ?>');
			history.back();
		</script>
	<?php
		exit();
	}
	function okGo($msg,$url){
	?>
		<script>
			alert('<?= $msg ?>');
			location.href = '<?= $url ?>';
		</script>
	<?php
		exit();
	}

	function goNow($url){
	?>
		<script>
			location.href = '<?= $url ?>';
		</script>
	<?php
		exit();
	}
	
	function sessionStartIfNone(){
		if(session_status() == PHP_SESSION_NONE){
			session_start();
		}
	}

	// 로그인 했는지 안했는지 체크

	function isLogin(){
		sessionStartIfNone();
		return isset($_SESSION["uid"]);
	}

	function isMyArticle($writer){
		sessionStartIfNone();
		if(isset($_SESSION["uname"])?$_SESSION["uname"]:""){
			return $writer == $_SESSION["uname"];
		}
		return false;
	}
?>