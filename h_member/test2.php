<?php

session_start();
$connect = mysqli_connect("localhost","root","a85263","php3");
$connect = mysqli_connect("localhost","root","a85263","php3");

//name 속성이 add_to_cart 인 form태그에 submit 버튼을 눌렀을때
if(isset($_POST["add_to_cart"]))
{

//쇼핑카트 세션 배열이 존재한다면
	if(isset($_SESSION["shopping_cart"]))
	{
//참고:https://www.w3schools.com/php/func_array_column.asp
//값이 배열로 이루어진 배열에서 key 값이 item_id인 값을 찾아서 배열로 리턴
		$item_array_id = array_column($_SESSION["shopping_cart"],"item_id");

//클릭한 상품의 id가 $item_array_id 배열에 존재 하지 않으면
		if(!in_array($_GET["id"], $item_array_id))
		{
//shopping_cart 세션 배열에 들어있는 배열의 수
			$count = count($_SESSION["shopping_cart"]);
//클릭한 상품의 데이터를 배열에 넣는다.
			$item_array = array(
				'item_id' => $_GET["id"],
				'item_name' => $_POST["hidden_name"],
				'item_price' => $_POST["hidden_price"],
				'item_quantity' => $_POST["quantity"]
			);

//shopping_cart 세션 배열에서 그 다음 방부터 차례로 넣는다.
			$_SESSION["shopping_cart"][$count] = $item_array;

		}else
		{
//클릭한 상품의 id가 $item_array_id 배열에 존재한다면
			echo '<script>alert("같은 상품이 존재합니다.")</script>';
			echo '<script>window.location="index.php"</script>';
		}


//쇼핑카트 세션 배열이 존재하지 않는다면(즉, 제일 처음 카트 버튼을 눌렀을 때)
	}else
	{
		$item_array = array(
			'item_id' => $_GET["id"],
			'item_name' => $_POST["hidden_name"],
			'item_price' => $_POST["hidden_price"],
			'item_quantity' => $_POST["quantity"]

		);

//key 값이 shopping_cart 인 배열 0번 방에 상품 배열을 넣었다.
		$_SESSION["shopping_cart"][0] = $item_array;
//echo var_dump($_SESSION["shopping_cart"]);
//array(1) { [0]=> array(4) { ["item_id"]=> string(1) "1" ["item_name"]=> string(14) "Samsung J2 Pro" ["item_price"]=> string(6) "100.00" ["item_quantity"]=> string(1) "1" } }
//echo var_dump($_SESSION["shopping_cart"][0]);
//array(4) { ["item_id"]=> string(1) "1" ["item_name"]=> string(14) "Samsung J2 Pro" ["item_price"]=> string(6) "100.00" ["item_quantity"]=> string(1) "1" }
	}

}


if(isset($_GET["action"]))
{
	if($_GET["action"]=="delete")
	{
//shopping_cart 세션 배열에 존재하는 배열들을 $values 에 넣는다.
		foreach($_SESSION["shopping_cart"] as $keys => $values)
		{
//배열의 item_id 값이 클릭한 id 값과 같으면
			if($values["item_id"] == $_GET["id"])
			{
//세션에서 제거한다.
				unset($_SESSION["shopping_cart"][$keys]);
				echo '<script>alert("삭제 되었습니다")</script>';
				echo '<script>window.location="index.php"</script>';
			}
		}
	}

}





?>

<!DOCTYPE html>
<html>
<head>
	<title>php session을 이용한 장바구니</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</head>
<body>

	<br />

	<div class="container" style="width:700px;">
		<h3 align="center">php session을 이용한 장바구니</h3>
		<br>
		<?php
		$query = "SELECT * FROM tbl_product ORDER BY id ASC";
		$result = mysqli_query($connect,$query);

		if(@mysqli_num_rows($result) > 0)
		{
			while($row = mysqli_fetch_array($result))
			{
				?>
				<!-- =============반복 되는 상품 리스트 부분=============== -->
				<div class="col-md-4">
					<!-- action 속성에 주소와 상품 id 번호 담는다 -->
					<form method="post" action="index.php?action=add&id=<?php echo $row["id"]; ?> ">
						<div style="border:1px solid #333; background-color:#f1f1f1; border-radius:5px; padding:16px;" align="center">
							<img src="<?php echo $row["image"]; ?>" class="img-responsive" /> </br>
							<h4 class="text-info"> <?php echo $row["name"]; ?> </h4>
							<h4 class="text-danger"> <?php echo $row["price"]; ?> </h4>

							<!-- submit 버튼을 누를때 name 속성의 값이 url로 넘어간다. post 방식으로 -->
							<input type="text" name="quantity" class="form-control" value="1" />
							<input type="hidden" name="hidden_name" value="<?php echo $row["name"] ?>" />
							<input type="hidden" name="hidden_price" value="<?php echo $row["price"] ?>" />
							<input type="submit" name="add_to_cart" style="margin-top:5px;" class="btn btn-success" value="추가"/>
						</div>
					</form>
				</div>
				<!-- 반복 되는 상품 리스트 부분 종료-->
				<?php
			}

		}
		?>
		<div style="clear:both"></div>
		<br>

		<h3>주문내역</h3>
		<div class="table-responsive">
			<table class="table table-bordered">
				<tr>
					<th width="40%">상품</th>
					<th width="10%">수량</th>
					<th width="20%">가격</th>
					<th width="15%">총금액</th>
					<th width="5%">옵션</th>
				</tr>


				<?php
//쇼핑카트에 물건이 존재하면!
				if(!empty($_SESSION["shopping_cart"]))
				{
					$total = 0;
					foreach($_SESSION["shopping_cart"] as $keys => $values)
					{
						?>

						<tr>
							<td><?php echo $values["item_name"]; ?></td>
							<td><?php echo $values["item_quantity"]; ?></td>
							<td><?php echo $values["item_price"]; ?></td>
							<td><?php echo number_format($values["item_quantity"] * $values["item_price"],2);?></td>
							<td><a href="index.php?action=delete&id=<?php echo $values["item_id"]?>"> <span class="text-danger">삭제</span> </a></td>

						</tr>

						<?php
						$total = $total + ($values["item_quantity"] * $values["item_price"]);
} //foreach 끝
?>

<tr>
	<td colspan="3" align="right">총금액</td>
	<td align="right"><?php echo number_format($total,2);?> </td>
	<td></td>
</tr>


<?php
} //if문 끝
?>

</table>
</div>



</div>


</body>
</html>