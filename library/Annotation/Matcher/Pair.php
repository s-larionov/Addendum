<?php

class Annotation_Matcher_Pair extends Annotation_Matcher_Serial {
	protected function build() {
		$this->add(new Annotation_Matcher_Key);
		$this->add(new Annotation_Matcher_Regex('\s*=\s*'));
		$this->add(new Annotation_Matcher_Value);
	}


	protected function process($parts) {
		return array($parts[0] => $parts[2]);
	}
}
