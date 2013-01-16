<?php
function __autoload($classname) {
    require_once $classname . '.class.php';
}
function upFirstStr($str = 'blog') {
    $str {0} = strtoupper ( $str );
    return $str;
}

function getActionName($mod=''){
    $mod=upFirstStr($mod) . 'Action';
    return $mod;
}

function import($name, $type = '') {
    switch ($type) {
        case 'action' :
            require_once BAC . '/' . getActionName ( $name ) . '.class.php';
            break;
        case 'config' :
            return require_once BCONF . '/' . $name . '.conf.php';
            break;
        case 'db' :
            require_once BLIB . '/DB/' . ($name ? $name : 'DB') . '.class.php';
            break;
       
        default :
            require_once BCLS . '/' . $name .($type?('.'.$type):''). '.php';
    }
}

function U($var=''){
	if($var){
		if(strpos('.', $var)){
			list($mod,$ac)=explode('.', $var);
			
		}
		else{
			$mod=BMOD;
			$ac=$var;
		}
	}
	else{
		$mod=BMOD;
		$ac=BAC;
	}
	return strtolower(C('siteurl').BGROUP.'.php?mod='.$mod.'&ac='.$ac);
	
}



/**
 * 获取配置参数
 *
 * @param unknown_type $name            
 * @param unknown_type $filename            
 * @return unknown NULL
 */
function C($name='', $filename = 'common') {
    static $config;
    
    if (isset ( $config [$filename] )) {
        if($name)
            return $config [$filename] [$name];
        else
            return $config [$filename];
    } else {
        $theconfig = import ( $filename, 'config' );
        $config [$filename] = $theconfig;
        if($name){
             return $theconfig [$name];
        }else{
            return $theconfig;
        }
    }
    return null;
}

/**
 * 浏览器友好的变量输出
 *
 * @param mixed $var
 *            变量
 * @param boolean $echo
 *            是否输出 默认为True 如果为false 则返回输出字符串
 * @param string $label
 *            标签 默认为空
 * @param boolean $strict
 *            是否严谨 默认为true
 * @return void string
 */
function dump($var, $echo = true, $label = null, $strict = true) {
    $label = ($label === null) ? '' : rtrim ( $label ) . ' ';
    if (! $strict) {
        if (ini_get ( 'html_errors' )) {
            $output = print_r ( $var, true );
            $output = '<pre>' . $label . htmlspecialchars ( $output, ENT_QUOTES ) . '</pre>';
        } else {
            $output = $label . print_r ( $var, true );
        }
    } else {
        ob_start ();
        var_dump ( $var );
        $output = ob_get_clean ();
        if (! extension_loaded ( 'xdebug' )) {
            $output = preg_replace ( '/\]\=\>\n(\s+)/m', '] => ', $output );
            $output = '<pre>' . $label . htmlspecialchars ( $output, ENT_QUOTES ) . '</pre>';
        }
    }
    if ($echo) {
        echo ($output);
        return null;
    } else
        return $output;
}

function laddslashes($vars){
	if(is_array($vars)){
		$result=array();
		foreach($vars as $k=>$var){
			$result[$k]=laddslashes($var);
		}
		return $result;
	}
	else{
		return addslashes($vars);
	}
	
	
}



/**
 * 是否AJAX请求
 * @access protected
 * @return bool
 */
function isAjax() {
	if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) ) {
		if('xmlhttprequest' == strtolower($_SERVER['HTTP_X_REQUESTED_WITH']))
			return true;
	}
	
	return false;
}


function M($name=''){
	static $model=array();
	
	if(!$name)$name='Model';
	
	$model[$name]=new $name();
	
	return $model[$name];
	
}










