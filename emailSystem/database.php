<?php 
class DB{
	private $pdo;
	public function getInstance(){
		if(!$this->pdo){
			$servername='localhost';
			$dbname='email';
			$username='root'; 
			$password='root';
			$this->pdo=new PDO("mysql:host=$servername;dbname=$dbname",	$username, $password);
		}
		return $this->pdo;
	}
    public function getAllRecipients(){
		$stmt = $this->getInstance()->query('SELECT * FROM recipients');
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}
	public function getRecipientByID($bid){
		$stmt = $this->getInstance()->prepare("SELECT * FROM recipients WHERE id=:bid");
		$stmt->execute(
			array(
				':bid'=>$bid
			)
		);
		return $stmt->fetch(PDO::FETCH_ASSOC);
	}
	public function addRecipient($name,$email){
		$stmt = $this->getInstance()->prepare("INSERT INTO recipients(name,email) VALUES (:name,:email)");
		$result=$stmt->execute(
			array(
				':name'=>$name,
				':email'=>$email
			)
		);
		return $result;
	}

}
$db=new DB();
// print_r($db->getAllRecipients());
// print_r($db->getRecipientByID(1));
// $db->addRecipient(123,321);

 ?>