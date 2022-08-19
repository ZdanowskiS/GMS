<?php

class GMS {

	public $db;
	private $api;

 	public function __construct($db,$api) { 

		$this->db=$db;
		$this->api=$api;
	} 
//Customer
	public function existsCustomerId(int $id)
	{
		if($this->GetOne('SELECT 1 FROM customers WHERE id=?',array($id)))
			return TRUE;
		else
			return FALSE;
	}

	public function getCustomerList()
	{
		return $this->db->getAll('SELECT id, extid, name, lastname, address, ssn, ten FROM customers');
	}

	public function getCustomer(int $id)
	{
		$result =$this->db->getRow('SELECT id, extid, name, lastname, address, ssn, ten, note FROM customers WHERE id=?',
									array($id));
		return $result;
	}

	public function getCustomerNames()
	{
		$result = $this->db->getAll('SELECT id, name, lastname FROM customers');

		return $result;
	}

	public function addCustomer(array $data)
	{
		$this->db->Execute('INSERT INTO customers(name, extid, lastname, address, phone, ssn, ten, note) 
								VALUES(?, ?, ?, ?, ?, ?, ?, ?)',
							array($data['name'],
									($data['extid'] ? $data['extid'] :''),
									$data['lastname'],
									$data['address'],
                                    $data['phone'],
                                    $data['ssn'],
									$data['ten'],
									$data['note']));

		return $this->db->getLastInsertId('customers');
	}

	public function updateCustomer(array $data)
	{
		$this->db->Execute('UPDATE customers SET extid=?, name=?, lastname=?, address=?, ssn=?, ten=?, note=? WHERE id=?',
							array($data['name'],
									($data['extid'] ? $data['extid'] :''),
									$data['lastname'],
									$data['address'],
                                    ($data['ssn'] ? $data['ssn'] : ''),
									($data['ten'] ? $data['ten'] : ''),
									$data['note'],
									$data['id']));

		return;
	}

	public function delCustomer(int $id)
	{
		$this->db->Execute('DELETE FROM customers WHERE id=?',
							array($id));
		return;
	}

//Model
	public function existsModelId(int $id)
	{
		if($this->GetOne('SELECT 1 FROM models WHERE id=?',array($id)))
			return TRUE;
		else
			return FALSE;
	}

	public function getModelList()
	{
		return $this->db->getAll('SELECT id, name FROM models');
	}

	public function getModelNames()
	{
		return $this->db->getAll('SELECT id, name FROM models');
	}

	public function getModel(int $id)
	{
		$result =$this->db->getRow('SELECT id, name, description FROM models WHERE id=?',array($id));
		return $result;
	}

    public function getModelByName(string $name)
    {
        return $this->db->GetOne('SELECT id FROM models WHERE name LIKE \''.$name.'\'');
    }

	public function getModelActions(int $id)
	{
		$result= $this->db->getAll('SELECT id, name, description FROM actions WHERE modelid=?',
									array($id));

		return $result;
	}

	public function getModelTaskNames(int $id)
	{
		$result= $this->db->GetAll('SELECT t.id, t.name 
									FROM tasks t 
										JOIN actions a ON (a.id=t.actionid)
									WHERE a.modelid=?',
									array($id));

		return $result;
	}

	public function addModel(array $data)
	{
		$this->db->Execute('INSERT INTO models(name,description) values(?, ?)',
							array($data['name'],
									($data['description'] ? $data['description'] : '')));

		return $this->db->getLastInsertId('models');
	}

	public function updateModel(array $data)
	{
		$this->db->Execute('UPDATE models SET name=?, description=? WHERE id=?',
							array($data['name'],
									($data['description'] ? $data['description'] : ''),
									$data['id']));

		return;
	}

	public function delModel(int $id)
	{
		$this->db->Execute('DELETE FROM models WHERE id=?',
							array($id));
		return;
	}
//Action

	public function existsActionId(int $id)
	{
		if($this->db->GetOne('SELECT 1 FROM actions WHERE id=?',array($id)))
			return TRUE;
		else
			return FALSE;
	}

    public function existsModelActionName(int $modelid, string $name)
    {
		if($this->db->GetOne('SELECT 1 FROM actions WHERE modelid=? AND name LIKE \''.$name.'\'',array($modelid)))
			return TRUE;
		else
			return FALSE;
    }

	public function getActionList()
	{
		return $this->db->getAll('SELECT a.id, a.modelid, a.name,
									m.name as modelname 
								FROM actions a 
									JOIN models m ON (m.id=a.modelid)');
	}

	public function getActionNames(int $modelid=0)
	{
		return $this->db->getAll('SELECT id, name FROM actions WHERE 1=1 '
									.($modelid ? ' AND modelid='.$modelid : ''));
	}

	public function getAction(int $id)
	{
		$result =$this->db->getRow('SELECT a.id, a.modelid, a.name, a.description,
										m.name as modelname 
									FROM actions a 
										JOIN models m ON (m.id=a.modelid)
									WHERE a.id=?',
									array($id));
		return $result;
	}

	public function addAction(array $data)
	{
		$this->db->Execute('INSERT INTO actions(modelid, name, description) values(?, ?, ?)',
							array($data['modelid'],
									$data['name'],
									($data['description'] ? $data['description'] : '')));

		return $this->db->getLastInsertId('actions');
	}

	public function updateAction(array $data)
	{
		$this->db->Execute('UPDATE actions SET modelid=?, name=?, description=? WHERE id=?',
							array($data['modelid'],
									$data['name'],
									($data['description'] ? $data['description'] : ''),
									$data['id']));

		return;
	}

	public function delAction(int $id)
	{
		$this->db->Execute('DELETE FROM actions WHERE id=?',
							array($id));
		return;
	}
//Task

	public function getActionTasks(int $id)
	{
		return $this->db->getAll('SELECT t.id, t.name, t.defval, t.description, t.dataName, t.dataType, t.objectName,
									t.actionid
									FROM tasks t WHERE t.actionid=?',array($id));
	}

	public function existsTaskId(int $id)
	{
		if($this->GetOne('SELECT 1 FROM tasks WHERE id=?',array($id)))
			return TRUE;
		else
			return FALSE;
	}

	public function getTaskList()
	{
		return $this->db->getAll('SELECT t.id, t.name, t.description, t.dataName, t.dataType, t.objectName,
									t.actionid
									a.name as actionname
									FROM tasks t 
										JOIN actions a ON (a.id=t.actionid)');
	}

	public function getTaskNames(int $actionid=0)
	{
		return $this->db->getAll('SELECT id, name FROM tasks WHERE 1=1 '
									.($actionid ? ' AND actionid='.$actionid : ''));
	}


	public function getTaskNamesByKey(int $actionid=0)
	{
		return $this->db->getAllByKey('SELECT id, name FROM tasks WHERE 1=1 '
									.($actionid ? ' AND actionid='.$actionid : ''),'name');
	}

	public function getTask(int $id)
	{
		$result =$this->db->getRow('SELECT t.id, t.name, t.description, t.dataName, t.dataType, t.objectName,
									t.actionid,
										a.name as actionname 
									FROM tasks t
										JOIN actions a ON (a.id=t.actionid)
									WHERE t.id=?',
									array($id));
		return $result;
	}

	public function addTask(array $data)
	{
		$this->db->Execute('INSERT INTO tasks(name, defval, description, dataName, dataType, objectName, actionid) 
							values(?, ?, ?, ?, ?, ?, ?)',
							array($data['name'],
                                    $data['defval'],
									$data['description'],
									$data['dataname'],
									$data['datatype'],
									$data['objectname'],
									$data['actionid']));

		return $this->db->getLastInsertId('tasks');
	}

	public function updateTask(array $data)
	{
		$this->db->Execute('UPDATE tasks SET name=?, defval=? description=?, dataName=?, dataType=?, objectName=?, actionid=? 
							WHERE id=?',
							array($data['name'],
                                    $data['defval'],
									$data['description'],
									$data['dataname'],
									$data['datatype'],
									$data['objectname'],
									$data['actionid'],
									$data['id']));
		return;
	}

	public function delTask(int $id)
	{
		$this->db->Execute('DELETE FROM tasks WHERE id=?',
							array($id));
		return;
	}
//node
	public function existsNodeId(int $id)
	{
		if($this->db->GetOne('SELECT 1 FROM nodes WHERE id=?',array($id)))
			return TRUE;
		else
			return FALSE;
	}

	public function getNodeList()
	{
		return $this->db->getAll('SELECT n.id, n.name, n.serial, n.deviceid, n.address, n.customerid, n.modelid,
										c.lastname, m.name as modelname  
									FROM nodes n 
											JOIN customers c ON (c.id=n.customerid)
											JOIN models m ON (m.id=n.modelid)');
	}

	public function getNode(int $id)
	{
		$result = $this->db->getRow('SELECT n.id, n.name, n.serial, n.deviceid, n.address, n.customerid, n.modelid, n.genieacsid,
										c.id as customerid, c.lastname, 
										m.id as modelid, m.name as modelname,
                                        g.name as genieacsname
									FROM nodes n
										JOIN customers c ON (c.id=n.customerid)
										JOIN models m ON (m.id=n.modelid)
                                        JOIN genieacs g ON (g.id=n.genieacsid)	
									WHERE n.id=?',
									array($id));

		return $result;
	}

	public function getNodeNames(int $id=0)
	{
		return $this->db->getAll('SELECT id, name FROM nodes WHERE 1=1 '
									.($id ? ' AND id='.$id : ''));
	}

	public function getCustomerNodeList(int $id)
	{
		$result = $this->db->getAll('SELECT n.id, n.name, n.serial, n.deviceid, n.address, n.customerid, n.modelid, n.genieacsid,
										m.name as modelname,
                                        g.name as genieacsname 
											FROM nodes n
										JOIN models m ON (n.modelid=m.id)
                                        JOIN genieacs g ON (n.genieacsid=g.id) 
										WHERE n.customerid=?',
										array($id));
		return $result;
	}

	public function addNode(array $data)
	{
		$this->db->Execute('INSERT INTO nodes(name, serial, deviceid, address, customerid, modelid, genieacsid) 
								VALUES(?, ?, ?, ?, ?, ?, ?)',
							array($data['name'],
									$data['serial'],
									($data['deviceid'] ? $data['deviceid'] : ''),
									($data['address'] ? $data['address'] : ''),
									$data['customerid'],
									$data['modelid'],
									$data['genieacsid']));

		return $this->db->getLastInsertId('nodes');
	}

	public function updateNode(array $data)
	{
		$this->db->Execute('UPDATE nodes SET name=?, serial=?, deviceid=?, address=?, customerid=?, modelid=?, genieacsid=?  
								WHERE id=?',
							array($data['name'],
									$data['serial'],
									($data['deviceid'] ? $data['deviceid'] : ''),
									$data['serial'],
									($data['address'] ? $data['address'] : ''),
									$data['customerid'],
									$data['genieacsid'],
									$data['id']));
		return;
	}

	public function delNode(int $id)
	{
		$this->db->Execute('DELETE FROM nodes WHERE id=?',
							array($id));
		return;
	}

	public function existsNodeConfigId(int $id)
	{
		if($this->db->GetOne('SELECT 1 FROM nodeconfig WHERE id=?',array($id)))
			return TRUE;
		else
			return FALSE;
	}

	public function existsNodeConfig(int $id, string $name)
	{
		if($this->db->GetOne('SELECT 1 FROM nodeconfig WHERE nodeid=? AND name=?', 
							array($id,$name)))
			return TRUE;
		else
			return FALSE;
	}

	public function getNodeConfig(int $id)
	{
		$result = $this->db->getRow('SELECT nc.id, nc.name, nc.nodeid, nc.val, nc.datefrom, nc.dateto 
									FROM nodeconfig nc
										JOIN nodes n ON (n.id=nc.nodeid)
										JOIN models m ON (m.id=n.modelid)		
									WHERE nc.id=?',
									array($id));
		return $result;
	}

	public function getNodeConfigList(int $id)
	{
		$result = $this->db->getAll('SELECT nc.id, nc.name, nc.nodeid, nc.val, nc.datefrom, nc.dateto 
									FROM nodeconfig nc
										JOIN nodes n ON (n.id=nc.nodeid)
										JOIN models m ON (m.id=n.modelid)		
									WHERE n.id=?',
										array($id));
		return $result;
	}

	public function addNodeConfig(array $data)
	{
		$this->db->Execute('INSERT INTO nodeconfig(name, nodeid, val, datefrom, dateto) 
								VALUES(?, ?, ?, ?, ?)',
							array($data['name'],
									$data['nodeid'],
									$data['val'],
									$data['datefrom'],
									$data['dateto']));

		return $this->db->getLastInsertId('nodeconfig');
	}

	public function updateNodeConfig(array $data)
	{
		$this->db->Execute('UPDATE nodeconfig SET name=?, nodeid=?, val=?, datefrom=?, dateto=? 
								WHERE id=?',
							array($data['name'],
									$data['nodeid'],
									$data['val'],
									$data['datefrom'],
									$data['dateto'],
									$data['id']));
		return;
	}

	public function delNodeConfig(int $id)
	{
		$this->db->Execute('DELETE FROM nodeconfig WHERE id=?',
							array($id));
		return;
	}
///////////////////////////////////////////////////////////
//GenieACS
	public function existsGenieacsId(int $id)
	{
		if($this->db->GetOne('SELECT 1 FROM genieacs WHERE id=?',array($id)))
			return TRUE;
		else
			return FALSE;
	}

	public function getGenieacsByName(string $name)
	{
		return $this->db->GetOne('SELECT id FROM genieacs WHERE name LIKE '.$this->db->quote_value($name));
	}

	public function getGenieacsByUrl(string $url)
	{
		return $this->db->GetOne('SELECT id FROM genieacs WHERE url LIKE '.$this->db->quote_value($url));
	}

	public function getGenieacsList()
	{
		return $this->db->getAll('SELECT id, name, url FROM genieacs');
	}

	public function getGenieacsNames()
	{
		return $this->db->getAll('SELECT id, name FROM genieacs');
	}

	public function getGenieacs(int $id)
	{
		$result =$this->db->getRow('SELECT id, name, url, passwd FROM genieacs WHERE id=?',array($id));
		return $result;
	}

	public function addGenieacs(array $data)
	{
		$this->db->Execute('INSERT INTO genieacs(name, url, passwd) values(?, ?, ?)',
							array($data['name'],
									$data['url'],
									$data['passwd']));

		return $this->db->getLastInsertId('genieacs');
	}

	public function updateGenieacs(array $data)
	{
		$this->db->Execute('UPDATE genieacs SET name=?, url=?, passwd=? WHERE id=?',
							array($data['name'],
									$data['url'],
									$data['passwd'],
									$data['id']));

		return;
	}

	public function delGenieacs(int $id)
	{
		$this->db->Execute('DELETE FROM genieacs WHERE id=?',
							array($id));
		return;
	}
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function runAction(int $nodeid, int $actionid)
    {
        $tasks = $this->getNodeActionTasks($nodeid, $actionid);

		return $this->setParameters($nodeid,$tasks);
    }

	private function setParameters(int $nodeid, array $parameters)
	{
		$node=$this->getNode($nodeid);

        $genieacs=$this->getGenieacs($node['genieacsid']);

		if(is_array($parameters))foreach($parameters as $key => $param)
		{
			$param_array[$key][]=$param['objectname'];
			$param_array[$key][]=$param['value'];
			$param_array[$key][]=$param['datatype'];
		}

		$action='devices/'.urlencode($node['deviceid']).'/tasks?connection_request';

		$array=array('name' => 'setParameterValues',
						'parameterValues' =>
								$param_array
					);
		$data=json_encode($array);

		$this->api->setUrl($genieacs['url']);
		$result = $this->api->POST($action,$data);

		return $result;
	}


    public function executeTask(array $task)
    {
        if(array_key_exists('name', $task) && $task['name']=="addTag"){
            $result = $this->AddTag($task['param']);
        }
        elseif(array_key_exists('name', $task) && $task['name']=="getParameterValues")
        {
            $result = $this->GetParameter($task['param']);
        }
        else{
            $result=$this->SetParameter($task);
        }
        return $result;
    }

//
	public function parseTask(string $name, int $nodeid)
	{
        $date=time();
		$result=$this->db->GetRow('SELECT val FROM nodeconfig WHERE nodeid=? AND name=? 
                                    AND (datefrom=0 OR datefrom<?) 
                                    AND (dateto=0 OR dateto>?)',
									array($nodeid, 
                                            $name,
                                            $date,
                                            $date));

		return $result['val'];
	}
//

    public function getNodeAction(string $serial, string $action)
    {
        $action= $this->db->GetRow('SELECT a.id as actionid, n.id as nodeid FROM nodes n 
                                        JOIN actions a ON (n.modelid=a.modelid) 
                                        WHERE serial LIKE '.$this->db->quote_value($serial).' 
                                            AND a.name LIKE '.$this->db->quote_value($action),
                                     array($serial));

        return $action;
    }

    public function getNodeActionTasks(int $nodeid, int $actionid)
    {
        global $DATATYPE;

		$tasks = $this->getActionTasks($actionid);

		if(is_array($tasks))foreach($tasks as $task)
		{
            $val=$this->parseTask($task['name'], $nodeid);
			$result[]=array('name' => $task['name'],
                        'datatype' => $DATATYPE[1],
                        'objectname' => $task['objectname'],
                        'value' => ($val ? $val : $task['defval']));
		}

        return $result;
    }
//////
//user
	public function existsUserId(int $id)
	{
		if($this->GetOne('SELECT 1 FROM users WHERE id=?',array($id)))
			return TRUE;
		else
			return FALSE;
	}

	public function getUserList()
	{
		return $this->db->getAll('SELECT id, login FROM users');
	}

	public function getUser(int $id)
	{
		$result =$this->db->getRow('SELECT id, login, passwd FROM users WHERE id=?',
									array($id));
		return $result;
	}

	public function getUserNames()
	{
		$result = $this->db->getAll('SELECT id, name FROM users');

		return $result;
	}

	public function addUser(array $data)
	{
		$this->db->Execute('INSERT INTO users(login, passwd) 
								VALUES(?, ?)',
							array($data['login'],
									crypt($data['passwd'])));

		return $this->db->getLastInsertId('users');
	}

	public function updateUser(array $data)
	{
		$this->db->Execute('UPDATE users SET name=?, passwd=? WHERE id=?',
							array($data['name'],
									crypt($data['passwd']),
									$data['id']));

		return;
	}

	public function delUser(int $id)
	{
		$this->db->Execute('DELETE FROM users WHERE id=?',
							array($id));
		return;
	}

    public function verifyPassword(string $login, string $passwd)
    {

		$user=$this->db->GetRow('SELECT id, passwd FROM users WHERE login LIKE ?',array($login));

        if (crypt($passwd,  $user['passwd']) == $user['passwd']) {

            return $user;
        }

        $this->error = 'Wrong password or login';
        return false;
    }

    public function verifyGenieacs($token)
    {
		$result=$this->db->GetOne('SELECT id FROM genieacs WHERE passwd LIKE '.$this->db->quote_value($token));

        return $result;
    }

	public function addSession($userid)
	{
        $ctime=time();
		$id=$userid.time();

		$this->db->Execute('INSERT INTO sessions(id,ctime,userid)
								VALUES(?, ?, ?)',array($id, $ctime, $userid));

		return $id;
	}

	public function isLoged()
	{
        $id=$_COOKIE['SID'];

		$session=$this->db->getRow('SELECT id, ctime, userid FROM sessions WHERE id=?',array($id));
		return $session['id'];
	}

	public function logout($SID)
	{
		$this->db->Execute('DELETE FROM sessions WHERE id=?',array($SID));
	}

	public function isUserAdded()
	{
		$user=$this->db->getOne('SELECT 1 FROM users');
		if($user)
			return TRUE;
		else
			return FALSE;
	}

////
}
?>
