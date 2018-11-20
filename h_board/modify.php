<?php
	/*
		1. DAO와 공통모듈 파일을 include 한다.
		2. form에서 넘겨준 값을 추출한다.
			content, title, num, writer
		3. 모든 값이 넘어 왔으면 $dao 변수에 DAO 객체를 생성 할당한 후에 $dao에게 그 값을 넘겨주고 update 요청한다.
		4. 성공하면 board 페이지로 이동
	*/

	require_once("../tools.php");
	require_once("boardDao.php");

	$num = requestValue("num");
	$content = requestValue("content");
	$title = requestValue("title");
	$writer = requestValue("writer");
	// 추가됨 
	$loginFlag = isLogin();
	$myArticle = isMyArticle($writer);
	//권한이 없다면 끝내게끔 바꿈
	if($loginFlag == false || $myArticle == false){
		// 로그인도 안되어있고 || 내 글도 아니면
		errorBack("권한이 없습니다.");
		alert("");
		exit();

	}


	if($content && $title && $writer){
		$dao = new BoardDao();
		$dao->updateMsg($num, $writer, $title, $content);

		okGo("게시글이 수정되었습니다.","board.php");	
		//수정된 메시지 출력하려면 okGo, 아니라면 goNow 사용해도 됨
	}else{
		errorBack("모든 항목이 빈칸 없이 입력되어야 합니다.");
		// 이번 페이지로 돌아가게 함. tools.php
	}

?>