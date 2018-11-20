<!DOCTYPE html>
<html lang="en">
<head>
<?php require_once("../html_head.php") ?>
</head>
<body>
	<?php session_start() ?>
	<?php require_once("../header.php") ?>
	<?php require_once("../menu.php") ?>
	

	<!-- 만약에 로그인이 되어 있지 않다면 ? -->
	<?php if(!isset($_SESSION["uname"])) : ?>

	<div class="container">
	  <h2>로그인</h2>
	  <form action="login.php" method="post">
	    <div class="form-group">
	      <label for="usr">ID</label><!-- 사용중인 아이디일 경우 회원가입 X -->
	      <input type="text" class="form-control" id="usr" name="id" maxlength="10" style="width: 400px";>
	    </div>
	    <div class="form-group">
	      <label for="pwd">Password</label>
	      <input type="password" class="form-control" id="pwd" name="pw" maxlength="10" style="width: 400px";>
	    </div>
	    <button type="submit" class="btn btn-primary">Login</button>
	  </form>

	  <button onclick="location.href='/php/homework/h_member/member_join_form.php'" class="btn btn-info">회원가입</button>

	</div>
	<?php else : ?>
		<h3>"<?= $_SESSION["uname"] ?>"님 환영합니다.</h3>;
	 	<button onclick="location.href='/php/homework/h_member/update_form.php'" class="btn btn-primary">회원수정</button>
	 	<button onclick="location.href='/php/homework/h_member/logout.php'" class="btn btn-danger">로그아웃</button>
	<?php endif ?>
	

	 <!-- 로그인 되었을 경우 -->
	<?php require_once("../footer_fixed.php") ?>
</body>
</html>