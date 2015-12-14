<?php

namespace root\Helpers;

class Hash{
	protected $config;

	public function __construct($config){
		$this->config = $config;
	}

	public function password($password){
		return password_hash(
			$password,
			$this->config->get('app.hash.algo'),
			['cost' => $this->config->get('app.hash.cost')]
		);
	}
	
	public function passwordCheck($password, $hash){
		return password_verify($password, $hash);
	}
	
	public function hash($input){
		return hash('sha256', $input);
	}
	
	public function hashCheck($known, $user){

		if(!function_exists('hash_equals')) {
			if(strlen($known) != strlen($user)) {
				return false;
			} else {
				$res = $known ^ $user;
				$ret = 0;
				for($i = strlen($res) - 1; $i >= 0; $i--) $ret |= ord($res[$i]);
				return !$ret;
			}
		} else {
			return hash_equals($known, $user);
		}

	}
}