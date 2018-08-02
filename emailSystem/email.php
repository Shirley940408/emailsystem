<?php 
class email{
	private $db;
	function __construct($db){
		$this->db=$db;
	}
	public function sendMethod($number){
		$info=$this->db->getRecipientByID($number);

	try {
	    $mandrill = new Mandrill('aSznWSiyxJ8Kv-JemSNvgQ');
	    $message = array(
	        'html' => '<p>吓你一跳</p>',
	        'text' => 'Example text content',
	        'subject' => 'example subject',
	        'from_email' => 'admin@sunnyfuture.ca',
	        'from_name' => 'Example Name',
	        'to' => array(
	            array(
	                'email' => $info['email'],
	                'name' => $info['name'],
	                'type' => 'to'
	            )
	        ),
	        'headers' => array('Reply-To' => 'message.reply@example.com'),
	        'important' => false,
	        'track_opens' => null,
	        'track_clicks' => null,
	    );
	    $async = false;
	    $ip_pool = 'Main Pool';
	    $result = $mandrill->messages->send($message, $async, $ip_pool);
	    /*
	    Array
	    (
	        [0] => Array
	            (
	                [email] => recipient.email@example.com
	                [status] => sent
	                [reject_reason] => hard-bounce
	                [_id] => abc123abc123abc123abc123abc123
	            )
	    
	    )
	    */
	} catch(Mandrill_Error $e) {
	    // Mandrill errors are thrown as exceptions
	    echo 'A mandrill error occurred: ' . get_class($e) . ' - ' . $e->getMessage();
	    // A mandrill error occurred: Mandrill_Unknown_Subaccount - No subaccount exists with the id 'customer-123'
	    throw $e;
	}


	}
}






 ?>