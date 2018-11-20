<?php
class BoardDAO{
	private $db;

	public function __construct(){	//객체가 생성되면 자동으로 실행
		try{
			$this->db = new PDO("mysql:host=localhost;dbname=php3" , "root" , "a85263");	//port 기본은 3306로 되어있다.
			$this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		}catch(PDOException $e){
			exit($e->getMessage());
		}
	}

	public function insertMsg($title, $writer , $content){
		try{	
			//$sql = "insert into member (id, pw, name) value(:id, :pw , :name)";
			// 위의 구문에서 순서가 같거나 모든 칼럼값을 쓰면 (id, pw, name) 부분은 생략이 가능하다.
			$sql = "insert into board (title, writer, content) value(:title, :writer , :content)";
			$pstmt = $this->db->prepare($sql);
			$pstmt->bindValue(":title" , $title , PDO::PARAM_STR);
			$pstmt->bindValue(":writer" , $writer , PDO::PARAM_STR);
			$pstmt->bindValue(":content" , $content , PDO::PARAM_STR);

			$pstmt->execute();
		}catch(PDOException $e){
			exit($e->getMessage());
		}
	}

	public function getManyMsgs(){
		try{
			/*
				1. sql: select * from board;
				2. prepare
				3. binding X , execute O
			*/
			$sql = "select * from board";
			$this->db->prepare($sql);
			$pstmt = $this->db->prepare($sql);
			$pstmt->execute();
			$msgs = $pstmt->fetchAll(PDO::FETCH_ASSOC);


		}catch(PDOException $e){
			exit($e->getMessage());
		}
		return $msgs;
	}

	public function getMsg($num){
		try{
			$sql = "select * from board where num=:num";
			$pstmt = $this->db->prepare($sql);
			$pstmt->bindValue(":num", $num, PDO::PARAM_STR);
			$pstmt->execute();

			$msg = $pstmt->fetch(PDO::FETCH_ASSOC);	//fetch - 가져오다
			//msg에 줬으면 반드시 return 해주어야 한다.
		}catch(PDOException $e){
			exit($e->getMessage());
		}
		return $msg;
	}

	// 조회수
	public function increaseHits($num){
		try{
			$sql = "update board set hits=hits+1 where num=:num";
			$pstmt = $this->db->prepare($sql);
			$pstmt->bindValue(":num" , $num , PDO::PARAM_INT);

			$pstmt->execute();

		}catch(PDOException $e){
			exit($e->getMessage());
		}

	}

	// 삭제시 
	public function deleteMsg($num){
		try{
			$sql = "delete from board where num=:num";
			$pstmt = $this->db->prepare($sql);
			$pstmt->bindValue(":num" , $num, PDO::PARAM_INT);
			$pstmt->execute();
			
		}catch(PDOException $e){
			exit($e->getMessage());
		}

	}

	// 수정시
	public function updateMsg($num, $writer, $title, $content){
		try{
			$sql = "update board set writer=:w , title=:t, content=:c where num=:n";

			/*
				1. prepare
				실행할 sql 문을 DB서버에 전송한다.
				DB서버는 그 SQL문을 parsing을 통해 문법검사를 하고 그 sql문에서 접근하는 테이블과 칼럼이 존재하는지, 사용자가 그 직업을 할 수 있는지 권한을 check하는 등의 정당성 검사
				(validotion check)를 한 후, 실행 계획을 세운다.
				2. data binding
					실행에 필요한 데이터를 공급해준다.
				3. execute
					실행 준비된 sql문의 실행을 DB서버에게 요청한다. 이 때 실행에 필요한 데이터도 함게 DB서버에게 전달된다.
			*/

			$pstmt = $this->db->prepare($sql);
			$pstmt->bindValue(":t" , $title, PDO::PARAM_STR);
			$pstmt->bindValue(":w" , $writer, PDO::PARAM_STR);
			$pstmt->bindValue(":c" , $content, PDO::PARAM_STR);
			$pstmt->bindValue(":n" , $num, PDO::PARAM_INT);
			
			$pstmt->execute();
		}catch(PDOException $e){
			exit($e->getMessage());
		}
	}

	// 페이지네이션 dao 
	function getPageMsgs($startRecord , $count){
		try{

			$sql = "select * from board order by num desc limit :startRecord, :count";
			$pstmt = $this->db->prepare($sql);
			$pstmt->bindValue(":startRecord" , $startRecord, PDO::PARAM_INT);
			$pstmt->bindValue(":count" , $count, PDO::PARAM_INT);
			$pstmt->execute();
			$msgs = $pstmt->fetchAll(PDO::FETCH_ASSOC);


		}catch(PDOException $e){
			exit($e->getMessage());
		}
		return $msgs;		

	}

	public function getTotalCount(){
		try{
			$sql = "select count(*) as totalCount from board";
			$pstmt = $this->db->prepare($sql);
			$pstmt->execute();
			$count = $pstmt->fetchColumn();


		}catch(PDOException $e){
			exit($e->getMessage());
		}
		return $count;
	}
	//select count(*) as totalCount form board limit 0,10 ;

}

?>