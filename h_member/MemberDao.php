<?php
class MemberDAO{
	private $db;

	public function __construct(){	//객체가 생성되면 자동으로 실행
		try{
			$this->db = new PDO("mysql:host=localhost;dbname=php3" , "root" , "a85263");	//port 기본은 3306로 되어있다.
			$this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		}catch(PDOException $e){
			exit($e->getMessege());
		}
	}

	public function getMember($id){
		try{
			// place holder
			$sql = "select * from member where id = :id";	//:은 플레이스 홀더
			/*prepare : 준비하다, 실행준비, DB서버가...
				1. 문법검사
				2. 유효성검사
				3. 실행계획 수립
			*/
			$pstmt = $this->db->prepare($sql);
			$pstmt->bindValue(":id", $id, PDO::PARAM_STR);
			$pstmt->execute();
			$result = $pstmt->fetch(PDO::FETCH_ASSOC);

		}catch(PDOException $e){
			exit($e->getMessege());
		}
		//sql 인젝션
		return $result;
	}

	public function insertMember($id, $pw , $name){
		try{	
			//$sql = "insert into member (id, pw, name) value(:id, :pw , :name)";
			// 위의 구문에서 순서가 같거나 모든 칼럼값을 쓰면 (id, pw, name) 부분은 생략이 가능하다.
			$sql = "insert into member (id, pw, name) value(:id, :pw , :name)";
			$pstmt = $this->db->prepare($sql);
			$pstmt->bindValue(":id" , $id , PDO::PARAM_STR);
			$pstmt->bindValue(":pw" , $pw , PDO::PARAM_STR);
			$pstmt->bindValue(":name" , $name , PDO::PARAM_STR);

			$pstmt->execute();
		}catch(PDOException $e){
			exit($e->getMessege());
		}
	}

	public function updateMember($id, $pw, $name){
		try{
			$sql = "update member set pw = :pw, name = :name where id=:id";
			$pstmt = $this->db->prepare($sql);	// ...문법검사, 정당검사...수립
			$pstmt->bindValue(":id",$id,PDO::PARAM_STR);
			$pstmt->bindValue(":pw",$pw,PDO::PARAM_STR);
			$pstmt->bindValue(":name",$name,PDO::PARAM_STR);

			$pstmt->execute();

		}catch(PDOException $e){
			exit($e->getMessege());
		}
	}
}

?>