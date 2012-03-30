<?php

class Annotation_Matcher_Constant extends Annotation_Matcher_Regex {
	private $constant;


	public function __construct($regex, $constant) {
		parent::__construct($regex);
		$this->constant = $constant;
	}


	protected function process($matches) {
		return $this->constant;
	}
}
