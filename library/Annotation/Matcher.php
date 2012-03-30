<?php

class Annotation_Matcher extends Annotation_Matcher_Serial {
	protected function build() {
		$this->add(new Annotation_Matcher_Regex('@'));
		$this->add(new Annotation_Matcher_Regex('[A-Z][a-zA-Z0-9_\\\\]*'));
		$this->add(new Annotation_Matcher_Parameters);
	}


	protected function process($results) {
		return array($results[1], $results[2]);
	}
}
