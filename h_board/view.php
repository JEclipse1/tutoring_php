<?php
	/*
		1. 클라이언트로부터 전송되어 온 num 값을 추출
		2. 그 num 값으로 DB에서 게시글 레코드를 읽고
		3. 그 읽은 레코드를 이용해서 게시글 상세정보를 html로 만든다.
	*/
	require_once("../tools.php");
	require_once("boardDao.php");
	$num = requestValue("num");
	$dao = new BoardDao();
	$dao->increaseHits($num);
	$msg = $dao->getMsg($num);
	$page = requestValue("page");
	?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
	<script>
		function processDelete(num){
			result = confirm("정말 삭제하시겠습니까?");
			if(result){
				location.href="delete.php?num="+num;
			}
		}
	</script>
<?php require_once("../html_head.php") ?>
<meta charset="utf-8">
<!-- <script type="text/javascript" src="/php/homework/ckeditor/ckeditor.js"></script> -->

</head>
<body>
	<?php require_once("../header.php") ?>
	<?php require_once("../menu.php") ?>

	<div class="jumbotron">
		<h1> 게시글 상세 내용 </h1>
	</div>
 		<div class="form-group">
 			<label for="title">제목 :</label>
	 		<input type="text" id="title" class="form-control" value="<?= $msg["Title"]?>" readonly>	
 		</div>

 		<div class="form-group">
	 		<label for="writer">작성자 :</label>
	 		<input type="text" id="writer" class="form-control" value="<?= $msg["Writer"]?>" readonly>
 		</div>

 		<div class="form-group">
	 		<label for="regtime">작성일자 :</label>
	 		<input type="text" id="regtime" class="form-control" value="<?= $msg["Regtime"]?>" readonly>
 		</div>

 		<div class="form-group">
	 		<label for="hits">조회수 :</label>
	 		<input type="text" id="hits" class="form-control" value="<?= $msg["Hits"]?>" readonly>
 		</div>

 		<div class="form-group">
 			<label for="content">내용 :</label>
 			<div><?= $msg["Content"]?></div>

	 	</div>

	 		<button type="submit" class="btn btn-primary" onclick="location.href='board.php?page=<?= $page ?>'">
	 			목록보기
	 		</button>
	 		<!-- 로그인을 해야만 게시글을 수정.삭제 가능하게끔 바꿈 -->
	 	<?php 
		 	$loginFlag = isLogin();	// 로그인 했는지 안했는지 확인하기 위한 변수
		 	$mygul = isMyArticle($msg["Writer"]);	// 작성자 이름
		 		
		 	if($loginFlag && $mygul ) {?>

	 		<button type="submit" class="btn btn-warning" onclick="location.href='modify_form.php?num=<?= $msg["Num"] ?>'">수정</button>
	 		<button type="submit" class="btn btn-danger" onclick="processDelete(<?= $msg["Num"]?>)" value="">삭제하기</button>
		 	
		 	<?php } ?>
	</div>

 		<?php require_once("../footer.php") ?>
</body>
</html>


