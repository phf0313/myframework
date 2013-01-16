<?php
/**
 * core
 */

define('BCLS', BLIB . '/Class');

define('BCONF', BROOT . '/Config');
define('BFUNC', BLIB . '/Function');
define('BTEMPLATE', BROOT . '/Template');
define('BSOURCE', BROOT . '/Public');
include BFUNC . '/Function.php';

class Core
{

	function __construct(){
		if(strpos($_SERVER['PHP_SELF'],'index.php')!==false){
		    define('BGROUP','Home');
		    $modindex='blog';
		}elseif(strpos($_SERVER['PHP_SELF'],'admin.php')!==false){
		    define('BGROUP','Admin');
		    $modindex='index';
		}
		else 
		    exit('error!');
		
		define('BACTION', BROOT . '/'.BGROUP.'/Action');
		define('BMODEL', BROOT . '/'.BGROUP.'/Model');
		
		$ac=isset($_GET['ac'])?htmlspecialchars($_GET['ac']):'index';
		
		$mod=upFirstStr(isset($_GET['mod'])?htmlspecialchars($_GET['mod']):$modindex);
		
		define('BMOD',$mod);
		define('BAC',$ac);
		$arrpath=array(get_include_path(),BLIB,BACTION,BMODEL,BCLS);
		$strpath=implode(PATH_SEPARATOR, $arrpath);
		
		set_include_path($strpath);
		
        $classname=getActionName($mod);
		$Action=new $classname;
		$Action->$ac();
		
	}
	
	public function error ($msg, $url = '')
	{
		echo $msg;
		exit();
	}
}