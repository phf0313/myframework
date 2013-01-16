<?php

abstract class Action{

	protected $view;
	
	protected $assign;
	
	public $_post,$_get;

	public function __construct(){
		if($_POST){
			$this->_post=laddslashes($_POST);
		}
		
		if($_GET){
			$this->_get=laddslashes($_GET);
		}
		
		
		
		
	}
	

	public function showmsg($msg='',$status=1,$url='',$isajax=false,$time=3){
		if($isajax){
			header("Content-Type:text/html; charset=utf-8");
			$result['status']=$status;
			$result['msg']=$msg;
			$result['url']=$url;
	
			echo json_encode($result);
		}
		else{
			$this->assign('status',$status);
			$this->assign('msg',$msg);
			$this->assign('url',$url);
			$this->assign('time',$time);
			
			$this->display('System.showmsg');
		}
		exit();
	}

	/**
	 * URL重定向
	 * @param string $url 重定向的URL地址
	 * @param integer $time 重定向的等待时间（秒）
	 * @param string $msg 重定向前的提示信息
	 * @return void
	 */
	public function redirect($url, $time=0, $msg='') {
		//多行URL地址支持
		$url        = str_replace(array("\n", "\r"), '', $url);
		if (empty($msg))
			$msg    = "系统将在{$time}秒之后自动跳转到{$url}！";
		if (!headers_sent()) {
			// redirect
			if (0 === $time) {
				header('Location: ' . $url);
			} else {
				header("refresh:{$time};url={$url}");
				echo($msg);
			}
			exit();
		} else {
			$str    = "<meta http-equiv='Refresh' content='{$time};URL={$url}'>";
			if ($time != 0)
				$str .= $msg;
			exit($str);
		}
	}
	
	public function assign($name,$value=''){
		$this->assign[$name]=$value;
	}

	public function display($template=''){
		import('Template','class');
		$this->view=new Template();
		
		if($this->assign){
			foreach($this->assign as $k=>$v){
				$this->view->assign($k,$v);
			}
		}
		
		$this->view->display($template);

	}



}