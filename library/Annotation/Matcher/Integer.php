<?php

class Annotation_Matcher_Integer extends Annotation_Matcher_Regex {
	public function __construct() {
		parent::__construct("-?[0-9]*");
	}


	protected function process($matches) {
		return (int) $matches[0];
	}
}
