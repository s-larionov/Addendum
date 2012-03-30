<?php

class Annotation_Matcher_MorePairs extends Annotation_Matcher_Serial {
	protected function build() {
		$this->add(new Annotation_Matcher_Pair);
		$this->add(new Annotation_Matcher_Regex('\s*,\s*'));
		$this->add(new Annotation_Matcher_Hash);
	}


	protected function match($string, &$value) {
		$result = parent::match($string, $value);
		return $result;
	}


	public function process($parts) {
		return array_merge($parts[0], $parts[2]);
	}
}
