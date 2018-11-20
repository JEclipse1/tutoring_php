 <!DOCTYPE html>
 <html>
 <head>
 <script type="text/javascript" src="/php/homework/ckeditor/ckeditor.js"></script>
<?php 
	session_start();
	$name = $_SESSION["uname"];
	require_once("../html_head.php") 
	?>

<script type="text/javascript">	
		//<![CDATA[
function LoadPage() {
    CKEDITOR.replace('content');
}

function FormSubmit(f) {
	// form 전송시 에디터의 내용을 textarea로 넣어주는 역할
    CKEDITOR.instances.content.updateElement();
	if(f.content.value == "") {
		alert("내용을 입력해 주세요.");
		return false;
	}
   // alert(f.content.value);    
	// 전송은 하지 않습니다.
   // return false;
}

</script>
 </head>
 <body onload="LoadPage();">
 	<?php require_once("../header.php") ?>
	<?php require_once("../menu.php") ?>
 	<form action="write.php" method="post" id="EditorForm" name="EditorForm" onsubmit="return FormSubmit(this);" novalidate>
 		<div class="form-group">
 			<label for="title">제목 :</label>
	 		<input type="text" id="title" name="title" class="form-control" required>	<!-- required는 반드시 입력하라는 뜻이다. -->
 		</div>

 		<div class="form-group">
	 		<label for="writer">작성자 :</label>
	 		<input type="text" id="writer" name="writer" class="form-control" value="<?= $name ?>" required readonly>
 		</div>

 		<div class="form-group">
 			<label for="content">내용 :</label>
	 		<textarea id="content" name="content" required></textarea>
	 		<script>
	 			CKEDITOR.replace('content',{
    			filebrowserUploadUrl:'upload.php?type=image',//type 안넣어서 존나 시간버림
    			//extraPlugins:'uploadimage'

				});
	 		</script>


	 		<button type="submit" class="btn btn-primary">글등록</button>
	 		<button onclick="location.href='board.php'" class="btn btn-danger">목록보기</button>
 		</div>



 	</form>

 	<?php require_once("../footer.php") ?>
 </body>
 </html>








<!--  <!DOCTYPE html>
 <html>
 <head>
<script type="text/javascript" src="/php/homework/ckeditor/ckeditor.js"></script>
<?php require_once("../html_head.php") ?>
<script type="text/javascript">	
		//<![CDATA[
function LoadPage() {
    CKEDITOR.replace('content');
}

function FormSubmit(f) {
	// form 전송시 에디터의 내용을 textarea로 넣어주는 역할
    CKEDITOR.instances.content.updateElement();
	if(f.content.value == "") {
		alert("내용을 입력해 주세요.");
		return false;
	}
   // alert(f.content.value);    
	// 전송은 하지 않습니다.
   // return false;
}
</script>
 </head>
 <body onload="LoadPage();">
 	<?php require_once("../header.php") ?>
	<?php require_once("../menu.php") ?>
 	<form action="write.php" method="post" id="EditorForm" name="EditorForm" onsubmit="return FormSubmit(this);" novalidate>
 		<div class="form-group">
 			<label for="title">제목 :</label>
	 		<input type="text" id="title" name="title" class="form-control" required>	
	 		required는 반드시 입력하라는 뜻이다.
 		</div>

 		<div class="form-group">
	 		<label for="writer">작성자 :</label>
	 		<input type="text" id="writer" name="writer" class="form-control" required>
 		</div>

 		<div class="form-group">
 			<label for="content">내용 :</label>
	 		<textarea id="content" name="content" required></textarea>

	 		<button type="submit" class="btn btn-primary">글등록</button>
	 		<button onclick="location.href='board.php'" class="btn btn-danger">목록보기</button>
 		</div>



 	</form>
 	<?php require_once("../footer.php") ?>
 </body>
 </html> -->