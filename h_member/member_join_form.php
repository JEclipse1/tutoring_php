<!DOCTYPE html>
<html>
<head>
<?php require_once("../html_head.php") ?>
</head>
<body>
  <?php require_once("../header.php") ?>
  <?php require_once("../menu.php") ?>
<div class="container">
  <h2>회원가입</h2>
  <p>회원가입을 위해 아래의 모든 정보를 작성해 주세요.</p>
  <form action="member_join.php" method="post" >
    <div class="form-group">
      <label for="usr">Id:</label>
      <input type="text" class="form-control" id="usr" name="id">
    </div>
    <div class="form-group">
      <label for="pwd">Password:</label>
      <input type="password" class="form-control" id="pwd" name="pw">
    </div>
    <div class="form-group">
      <label for="name">Name:</label>
      <input type="text" class="form-control" id="name" name="name">
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
</div>
  <?php require_once("../footer_fixed.php") ?>
</body>
</html>