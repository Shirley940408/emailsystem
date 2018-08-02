<?php 

class recipient{
	private $db;
	function __construct($db){
    $this->db = $db;  
	}
	public function DefaultMethod(){
		$result=$this->db->getAllRecipients();
		echo json_encode($result);
	}
	public function addMethod(){
		if(array_key_exists('name', $_POST)&&array_key_exists('email', $_POST)){
			$result=$this->db->addRecipient($_POST['name'],$_POST['email']);
			if($result){
				echo json_encode(array(
					'code'=>200,
					'message'=> 'Your message has added successfully!'
					)
				);
			}
		}else{
			echo json_encode(array(
				'code'=>400,
				'message'=> 'Your format is wrong.'
				)
			);
		}
	}
}


 ?>