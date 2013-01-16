<?php
class IndexAction extends CommonAction{
    
    public function index(){
    	$this->display();
    }
    
   
    public function login(){
 
    	if($this->_post){
    		$username=$this->_post['username'];
    		$password=$this->_post['password'];
    		$result=M()->result_row("select * from blog_admin where username='$username' and passwd='$password'");
    	    if($result){
    	       	$this->setAdmin($result);
    	       	
    	       	$this->redirect(U('index'));
    	    }	
    	    else{
    	    	$this->showmsg('你的账号或密码错误，请确认后重新输入！');
    	    }
    	}
    	
    	$this->display();
    	
    }
    
    private function setAdmin($arruser){
    	$Cookie=new Cookie();
        $Cookie->setCookie('user_id',$arruser['aid']);
        $Cookie->setCookie('user_name',$arruser['username']);
    }
    
    
}