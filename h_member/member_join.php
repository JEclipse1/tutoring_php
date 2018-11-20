<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<?php
		require_once("../tools.php");	//포함시키기
		require_once("MemberDao.php");
		// requset로부터 id 값 읽어 오기
		//$id = isset($_REQUEST["id"])?$_REQUEST["id"]:"";
		$id = requestValue("id");	// -> request 자주쓰니 간단하게 만듬
		// requset로부터 pw 값 읽어 오기
		$pw = requestValue("pw");
		// requset로부터 name 값 읽어 오기
		$name = requestValue("name");

		// 모든 입력란이 채워져 있고, 사용 중인 아이디가 아니라면 회원정보 추가
		if($id && $pw && $name){
			$mdao = new MemberDAO();
			if($mdao->getMember($id)){//이미 사용중인 아이디라면
				//에러 메시지 출력 후 회원가입 페이지로 이동
				//Javascript 코드로 web browser에게 전송
				/*
				echo "<script>
						alert('이미 사용중인 아이디 입니다.')
						loction.href = 'member_join_form.php';
				</script>";*/
	
				errorBack('이미 사용중인 아이디 입니다.');
				
		
				exit();
			}else{
				$mdao->insertMember($id , $pw , $name);
				okGo("가입이 완료 되었습니다." , "/php/homework/h_member/login_form.php");
				//데이터베이스 회원정보 insert
				//"가입이 완료 되었습니다" 라는 메시지 출력 후, 메인 페이지로 이동
			}
		}
	?>
</body>
</html>