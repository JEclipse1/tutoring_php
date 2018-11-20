<?php



$product  = $_GET[p_num];



session_start();



if(!$_SESSION["p_num"][0]) { //생성된 세션이 없으면

$_SESSION["p_num"][0] = $product; //세션 array변수에 제품을 담는다.

}



else //생성된 세션(장바구니) 가 있으면

{

   $s_c = count($_SESSION["p_num"]); //총 장바구니의 크기를 구한다.

for($i=0;$i<$s_c;$i++) //장바구니에 추가한 제품이 있는지 찾기 위한 for문

{

if($_SESSION["p_num"][$i] == $product) //저장된 제품이 있는지 검사

{

$is_p_num = 1; //이미 장바구니에 추가된 제품이라면 1을 저장

echo "장바구니에 추가한 제품이 이미 존재합니다.<br>";


}

}


if($is_p_num != 1) { //장바구니에 추가된 제품이 아니라면

$_SESSION["p_num"][$s_c] = $product;  //세션변수에 새로 제품 등록

}

}



//저장된 세션 배열 변수에서 장바구니 제품을 꺼내 온다.

global $s_c;

for($i=0;$i<$s_c;$i++) {

echo "귀하가 장바구니 추가한 제품은";

echo $_SESSION["p_num"][$i] . "<br>";

}



?>