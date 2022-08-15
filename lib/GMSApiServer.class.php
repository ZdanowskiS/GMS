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
        $this->login=$_POST['login'];
        $this->token=$_SERVER['HTTP_AUTHORIZATION'];
    }

    public function parseURI()
    {
        $uri=ltrim($_SERVER['REQUEST_URI'],'/');
        $tmp=explode('/',$uri);
        if($tmp[0]=='api')
        {
            $this->type='genieacs';
        }
        $this->uri=preg_replace('/[^a-z]/', '',$tmp[1]);
        $this->id=intval($tmp[2]);
    }

    public function authenticate()
    {
        $result = $this->GMS->verifyPassword($this->login,$this->password);
        $this->token=$this->GMS->addSession($user['id']);
    }

    public function autorization()
    {
        $result=$this->GMS->isLoged($this->token);
        return $result;
    }

    public function execute()
    {
        if(!$this->token)
            $this->token=$this->authenticate();

        if($this->token)
		{
			$result =$this->autorization();

			if(!$result){
				return '401 Unauthorized';
			}
		}
        else
		    return '401 Unauthorized';

		if(($this->method!='POST' || $this->uri!='authenticate'))
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

	public function PUT()
	{
        $input=json_decode(file_get_contents('php://input'));

		switch($this->uri) {
			default:
				return '400 Bad Request';
		}
	}

	public function POST()
	{
		switch($this->uri) {
			default:
				return '400 Bad Request';
		}
	}

	public function GET()
	{
        $input=json_decode(file_get_contents('php://input'));

		switch($this->uri) {
			case 'cutomers':

			    return json_encode($result);
            break;
			case 'nodes':

			    return json_encode($result);
            break;
			case 'action':

			    return json_encode($result);
            break;
			case 'tasks':

			    return json_encode($result);
            break;
			default:
				return '400 Bad Request';
		}
	}
}
?>
