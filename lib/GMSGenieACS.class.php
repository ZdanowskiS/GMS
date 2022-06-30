<?php

class GMSGenieACS {

	private $url;

	public function _construct(string $url)
	{
		$this->url=$url;
	}

	public function setUrl(string $url)
	{
		$this->url=$url;
	}

	public function GET($action)
	{
		if(!$this->url)
			return;

		$curl = curl_init();

		curl_setopt($curl, CURLOPT_URL, $this->url.$action);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($curl, CURLOPT_HTTPHEADER, array(
			'Content-Type: application/json',
    		'Accept: application/json',
		));
		curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'GET');
		curl_setopt($curl, CURLOPT_TIMEOUT, 10);

		$result = curl_exec($curl);

		return json_decode($result,1);
	}

	public function POST($action,$data)
	{
		if(!$this->url)
			return;


		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, $this->url.$action);
		curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

		curl_setopt($curl, CURLOPT_HTTPHEADER, array(
			'Content-Type: application/json',
    		'Accept: application/json',
		));
		curl_setopt($curl, CURLOPT_POST, 1);

		curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

		$result = curl_exec($curl);

		return json_decode($result,1);
	}
}

?>
