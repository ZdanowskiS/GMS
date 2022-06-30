<?php

class GMSServer {

	private $db;
	private $token;
	private $name;

	public function __construct($db) { 
        
		$this->db=$db;
	}

	public function verifyGenieACS($token)
    {
		$result=$this->db->GetRow('SELECT 1 FROM genieacs WHERE name=? AND token=?',
								array($this->name,
										$this->token));

        if($result)
            return TRUE;
        else
            return FALSE;

    }

	public function execute($data)
	{
		$this->method=$data['method'];
		$this->uri=$data['uri'];
		$this->id=$data['id'];

		$this->token=$data['token'];
		$this->name=$data['name'];

		if($this->token)
		{
			$result =$this->verifyGenieACS();

			if(!$result){
				return '401 Unauthorized';
			}
		}
		elseif(($this->method!='POST' || $this->uri!='authenticate'))
		{
			return '401 Unauthorized';
		}

		switch($this->method) {
			 case 'GET':
                 return $this->GET();
              break;
			 case 'POST':
                 return $this->POST();
              break;
			 case 'PUT':
                 return $this->PUT();
              break;
			default:
				return '400 Bad Request';
		}
	}

}

?>
