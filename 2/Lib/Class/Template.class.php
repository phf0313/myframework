<?php

class Template {

	public $vars=array();

	public $html;

	private $tag;

	public $mod,$ac;
	
	
	/**
	 * 注册变量
	 */
	public function assign($name,$value=''){
		if(empty($name))return;
		$this->vars=array_merge($this->vars,array($name=>$value));

	}
	
	//注册公共变量
	private function parseCommonVars(){
		if(!isset($this->vars['title']))
			$this->vars['title']=C('sitename');
	}

	private function parseTemplate($template='',$network=false){
		$filename=$network?C('siteurl'):BTEMPLATE.'/'.C('template').'/'.BGROUP.'/';
		if(empty($template)){
			$mod=BMOD;
			$ac=BAC;
		}
		else{
			list($mod,$ac)=explode('.', $template);
		}
		$this->mod=$mod;
		$this->ac=$ac;
		$filename.=$mod.'-'.$ac.'.php';

		return $filename;
	}


	public function display($template=''){
		$this->parseCommonVars();
		
		extract($this->vars);
		extract($this->regResourceVars());

		require $this->parseTemplate($template);



		// 		$this->html=$this->parseTags();
	}

	/**
	 * 注册模板资源变量
	 */
	private function regResourceVars(){
		$resvars=C('resourcevars');
		$url=C('siteurl');
		$path=$url.'Template/'.C('template').'/'.BGROUP.'/';
		
		foreach($resvars as $k=>$v){
			switch ($v){
				case '_self':
					$vars[$v]=$path;
					break;
				case '_js':
					$vars[$v]=$path.'Public/Js/';
					break;
				case '_css':
					$vars[$v]=$path.'Public/Css/';
					break;
				case '_images':
					$vars[$v]=$path.'Public/Images/';
					break;
				case 'images':
					$vars[$v]=$url.'Public/Images/';
					break;
				case 'js':
					$vars[$v]=$url.'Public/Js/';
					break;
				case 'css':
					$vars[$v]=$url.'Public/Css/';
					break;

			}
		}
		return $vars;
	}

	private function parseTags(){
		if(empty($tag)){
			import('TemplateTag','class');
			$this->tag=new TemplateTag($this);

		}

		//parseBegin
		$this->parseBegin();
	}


	private function parseBegin(){
		$this->html=$this->tag->purseBegin();
	}


}