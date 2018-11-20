<?php
	/*
		request 정보에서 id,pw,name 추출
		데이터베이스에서 저장된 회원정보 수정
		main 페이지로 이동
	*/

	require_once("../tools.php");
	require_once("MemberDao.php");
	session_start();

	$id = requestValue("id");
	$pw = requestValue("pw");
	$name = requestValue("name");

	/*
		1. 로그인 한 사용자인지 check? -> session으로 확인
		2. 로그인한 사용자가 본인의 회원정보를 수정하려는 것인지 check
	*/

	$suid = isset($_SESSION["uid"])?($_SESSION["uid"]):"";	//suid:세션id uid에는 정보가 다 들어가있음.
	if(!$suid){	//로그인 하지 않은 경우
		errorBack("로그인을 해주십시오.");
		// errorBack에 exit()가 있으므로 쓸 필요가 없다.
	}else{
		//본인인지 어떻게 check??
		if($suid != $id)	//$suid : 로그인한 사용자 
			errorBack("본인의 정보가 아닙니다.");
	}

	if($id && $pw && $name){
		$mdao = new MemberDao();
		$mdao->updateMember($id, $pw, $name);
		$_SESSION["uname"] = $name;

		//okGo("회원정보가 수정되었습니다.", MAIN_PAGE);
		okGo("회원정보가 수정되었습니다.", "/php/homework/h_member/login_form.php");
	}else{
		errorBack("모든 입력란을 채워주십시오..");
	}

?>