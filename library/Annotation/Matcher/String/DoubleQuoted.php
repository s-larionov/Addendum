<?php

class Annotation_Matcher_String_DoubleQuoted extends Annotation_Matcher_Regex {
	public function __construct() {
		parent::__construct('"([^"]*)"');
	}


	protected function process($matches) {
		return $matches[1];
	}
}
