<?php

class TemplateTag {

	public $template;

	public function __construct($class){
		$this->template=$class;
	}

	public function purseBegin(){
		$content=$this->template->html;
		echo $content;
		$content=str_replace("{", "<?php", $content);
		echo $content;
		$this->template->html=str_replace('}', '?>', $this->template->html);
		
		echo $this->template->html;
	}

}