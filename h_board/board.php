<!DOCTYPE html>
<html>
<head>
	<?php require_once("../html_head.php") ?>
	<style>
		a:hover{text-decoration: none}
	</style>

</head>
<body>
	<!-- 부트스트랩 부분 이것으로 대체함 -->
	<?php require_once("../header.php") ?>
	<?php require_once("../menu.php") ?>
	
<div class="container">
	<table class="table table-hover">
		<tr>
			<th>번호</th>
			<th>제목</th>
			<th>작성자</th>
			<th>작성일시</th>
			<th>조회수</th>
		</tr>


	<?php
	
		require_once("boardDao.php");
		require_once("../tools.php");
		$numPageLinks = 5;	// 한 페이지에 출력할 페이지 링크의 수
		$numMsgs = 5; // 한 페이지에 출력할 게시글 수
		$dao = new BoardDAO();
		$msgs = $dao->getManyMsgs();

		$page = requestValue("page");	//현재 페이지
		if($page < 1)
			$page = 1;	//$page 0이나 음수같은 이상한 값이 오면 1로 오게

		$dao = new BoardDao();
		//$msgs = $dao->getManyMsgs(); 이것 말고 필요한 것만 빌려와보자.
		$startRecord = ($page-1)*$numMsgs;	// numMsgs : 한 페이지에 나타내고 싶은 게시글 수
		$msgs = $dao->getPageMsgs($startRecord, $numMsgs);

	?>
		<?php foreach ($msgs as $msg) : ?> 
			<tr>
				<td><?=$msg["Num"]?></td>	<!--번호 생성 찍어줌-->
				<td>
					<a href="view.php?num=<?=$msg["Num"]?>&page=<?= $page ?>"> 
					<?=$msg["Title"]?> </a>
				</td>
				<td><?=$msg["Writer"]?></td>
				<td><?=$msg["Regtime"]?></td>
				<td><?=$msg["Hits"]?></td>
			</tr>
		<?php endforeach ?>	
	</table>
	<div class="float-right">
	<button onclick="location.href='write_form.php'" class="btn btn-primary">글쓰기</button>
	</div>
</div>
	<?php

		$startPage = floor(($page-1)/$numPageLinks)*$numPageLinks+1;
		$endPage = $startPage + ($numPageLinks-1);
		$count = $dao->getTotalCount();	// 전체 게시글 수
		$totalPages = ceil($count/$numMsgs);
		//$totalPages = 올림 (전체게시글수/numMsgs = 한페이지에 출력할 게시글 수)
		if($endPage > $totalPages)
			$endPage = $totalPages;
	?>
<div class="container">
	<ul class="pagination">
	<?php if($startPage > 1) : ?>
	<li class="page-item"><a class="page-link" href="board.php?page=<?= $startPage - $numPageLinks ?>">	
		&lt; 
	</a></li>
	<?php endif ?>

	<?php
		
	?>

	<?php for($i=$startPage; $i <= $endPage; $i++) : ?>
		<li class="page-item"><a class="page-link" href="board.php?page=<?= $i ?>"> 
			<?php if($i==$page) :?>
				<b>
					<?= $i ?> 
				</b>
			<?php else :?>
				<?= $i ?>
			<?php endif ?>
		</a></li>
	<?php endfor ?>

	<?php if($endPage < $totalPages) : ?>
		<li class="page-item"><a class="page-link" href="board.php?page=<?=$endPage+1?>">
			&gt;
		</a></li>
	<?php endif ?>
</ul>
</div>

	
	<?php require_once("../footer_fixed.php") ?>
</body>
</html>