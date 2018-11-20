<?php
	require_once("../tools.php");
	require_once("boardDao.php");

	$num = requestValue("num");
	$dao = new BoardDao();
	$dao->deleteMsg($num);


	$loginFlag = isLogin();
	$myArticle = isMyArticle($writer);

	// 권한이 없으면 삭제가 불가능하게
	if($loginFlag == false || $myArticle == false){
		//errorBack("권한이 없습니다.");
		errorBack("삭제되었습니다.");
		exit();
	}


	header("Location: board.php");
?>