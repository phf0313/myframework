<?php
class Cookie {
	private $path, $time, $pre, $name;
	public function __construct($name = '') {
		$this->pre = C ( 'cookiepre' );
		$this->path = C ( 'cookiepath' );
		$this->time = C ( 'cookietime' );
		$this->name = $name;
	}
	public function setCookie($name = '', $value = '', $time = 0) {
		$name = $this->getRealName ( $name );
		
		$time = $time ? $time : (time () + intval ( $this->time ));
		
		setcookie ( $name, $value, $time, $this->path );
	}
	public function getCookie($name = '') {
		$name = $this->getRealName ( $name );
		
		return $_COOKIE [$name];
	}
	function delCookie($name='') {
		$name = $this->getRealName ( $name );
		setCookie ( $name, '', time () - 86400 );
	}
	private function getRealName($name = '') {
		if ($name)
			$name = $this->pre . $name;
		else {
			$name = $this->pre . $this->name;
		}
		
		return $name;
	}
}