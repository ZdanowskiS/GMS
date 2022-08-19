<?php

class GMSApiServer {

    private $GMS;

    private $login;
    private $password;
    private $token;

    private $method;
    private $uri;

    public function __construct($GMS)
    {
        $this->GMS=$GMS;

        $this->method=$_SERVER['REQUEST_METHOD'];
        $this->password=$_POST['password'];
        $this->token=$_SERVER['HTTP_AUTHORIZATION'];
        $this->parseURI();
    }

    public function parseURI()
    {
        $uri=ltrim($_SERVER['REQUEST_URI'],'/');
        $tmp=explode('/',$uri);
        if($tmp[0]=='api')
            $this->type='genieacs';


        $this->uri=preg_replace('/[^a-z]/', '',$tmp[1]);
        $this->id=intval($tmp[2]);
    }

    public function authenticate()
    {
        $result = $this->GMS->verifyGenieacs($this->token);

        return $result;
    }

    public function execute()
    {

        if($this->token)
		{
            $result =$this->authenticate();

			if(!$result)
				return '401 Unauthorized';
		}
        else
		    return '401 Unauthorized';


		switch($this->method) {
			 case 'GET':
                 return $this->GET();
              break;
			default:
				return '400 Bad Request';
		}
    }

	public function GET()
	{
        $input=json_decode(file_get_contents('php://input'));

        $nodeaction = $this->GMS->getNodeAction($input->{'serial'}, $this->uri);

        $result=$this->GMS->getNodeActionTasks($nodeaction['nodeid'],$nodeaction['actionid']);

        if(is_array($result))
            return json_encode($result);
        else
            return '400 Bad Request';

	}
}
?>
