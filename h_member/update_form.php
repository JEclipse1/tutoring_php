<!DOCTYPE html>
<html>
<head>
<?php require_once("../html_head.php") ?>
</head>
<body>
	<?php require_once("../header.php") ?>
	<?php require_once("../menu.php") ?>
	
	<?php
		/*
			이 회원정보 수정 요청을 한 사용자의 원래 정보를 어떻게 알지??
		*/
			session_start();	//세션을 가져오려면 무조건 start 부터
			require_once("MemberDao.php");
			require_once("../tools.php");
			
			$uid = isset($_SESSION["uid"])?$_SESSION["uid"]:"";
			/* uid를 가지고 데이터베이스 질의해야지.. 이 id를 가진 회원정보를 가져오라고*/
			$mdao = new MemberDao();
			$member = $mdao->getMember($uid);

			if(!$member){
				errorBack("그런 사람은 없습니다.");
				exit();
			}
	?>

<div class="container">
  <h2>회원정보수정</h2>
  <p>회원정보수정을 위해 아래의 모든 정보를 작성해 주세요.</p>
  <form action="update.php" method="post" >
    <div class="form-group">
      <label for="usr">Id:</label><!-- 사용중인 아이디일 경우 회원가입 x-->
      <input type="text" class="form-control" readonly value="<?= $member['id']?>" id="usr" name="id"> 
    </div>
    <div class="form-group">
      <label for="pwd">Password:</label>
      <input type="password" class="form-control" id="pwd" name="pw" value="<?= $member['pw']?>">
    </div>
    <div class="form-group">
      <label for="name">Name:</label>
      <input type="text" class="form-control" id="name" name="name" value="<?= $member['name']?>">
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
</div>
<?php require_once("../footer.php") ?>
</body>
</html>
