<?php

class Annotation_Matcher_StaticConstant extends Annotation_Matcher_Regex {
	public function __construct() {
		parent::__construct('(\w+::\w+)');
	}


	protected function process($matches) {
		$name = $matches[1];
		if(!defined($name)) {
			trigger_error("Constant '$name' used in annotation was not defined.");
			return false;
		}
		return constant($name);
	}

}
