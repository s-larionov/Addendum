<?php

class Annotation_Matcher_MoreValues extends Annotation_Matcher_Serial_Simple {
	protected function build() {
		$this->add(new Annotation_Matcher_Array_Value);
		$this->add(new Annotation_Matcher_Regex('\s*,\s*'));
		$this->add(new Annotation_Matcher_Array_Values);
	}


	protected function match($string, &$value) {
		$result = parent::match($string, $value);
		return $result;
	}


	public function process($parts) {
		return array_merge($parts[0], $parts[2]);
	}
}
