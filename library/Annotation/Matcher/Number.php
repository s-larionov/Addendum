<?php

class Annotation_Matcher_Number extends Annotation_Matcher_Regex {
	public function __construct() {
		parent::__construct("-?[0-9]*\\.?[0-9]*");
	}


	protected function process($matches) {
		$isFloat = strpos($matches[0], '.') !== false;
		return $isFloat ? (float) $matches[0] : (int) $matches[0];
	}
}
