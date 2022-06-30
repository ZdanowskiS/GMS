<?php

class GMSPostgres {

	public $link;
	public $result;

 	public function __construct() { 

		global $CONFIG;

        if (!extension_loaded('pgsql')) {
            trigger_error('PostgreSQL extension not loaded!', E_USER_WARNING);
            return;
        }
		$data=$CONFIG['database'];

		$this->connect($data['host'], $data['user'], $data['passwd'], $data['name']);
	} 

	public function connect($host, $user, $passwd, $name)
	{
       $data = implode(' ', array(
            ($host != '' ? 'host=' . $host : ''),
            ($port != '' ? 'port=' . $port : ''),
            ($user != '' ? 'user=' . $user : ''),
            ($passwd != '' ? 'password=' . $passwd : ''),
            ($name != '' ? 'dbname=' . $name : ''),
            'connect_timeout=10'
        ));

        $this->link = @pg_connect($data, PGSQL_CONNECT_FORCE_NEW);
	}

    public function getAffectedRows()
    {
    	return @pg_affected_rows($this->result);
    }

    public function _driver_fetchrow_num()
    {
    	return @pg_fetch_array($this->result, null, PGSQL_NUM);
    }

    public function GetOne($query = null, array $inputarray = null)
    {
        if ($query) {
            $this->execute($query, $inputarray);
        }

        $result = null;

        list($result) = $this->_driver_fetchrow_num();

        return $result;
    }

    public function getLastInsertId($table = null)
    {
        return $this->GetOne('SELECT currval(\'' . $table . '_id_seq\')');
    }

	public function parse($query, array $input=null)
	{
        if ($input) {

            $query = str_replace('%', '%%', $query); 

            $query = vsprintf(str_replace('?', '\'%s\'', $query), $input);
            $query = str_replace('%%', '%', $query);
        }

        return $query;
	}

	public function execute($query, array $input=null)
	{
		$this->result= @pg_query($this->link, $this->parse($query, $input));

		return $this->getAffectedRows();
	}

	public function getAll($query, array $input=null)
	{
		$this->result= @pg_query($this->link, $this->parse($query, $input));

        while ($row = @pg_fetch_array($this->result,null, PGSQL_ASSOC)) {
            $result[] = $row;
        }

		return $result;
	}

    public function getAllByKey($query = null, $key = null, array $inputarray = null)
    {
		$this->result= @pg_query($this->link, $this->parse($query, $input));

        while ($row = @pg_fetch_array($this->result,null, PGSQL_ASSOC)) {
            $result[$row[$key]] = $row;
        }

		return $result;
    }

    public function getRow($query = null, array $inputarray = null)
    {
        if ($query) {
            $this->Execute($query, $inputarray);
        }

        return $this->fetchrow_assoc();
    }

    public function fetchrow_assoc($result = null)
    {
		return @pg_fetch_array($result ? $result : $this->result, null, PGSQL_ASSOC);
    }
}
?>
